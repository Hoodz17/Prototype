<?php
class Model
{
    public $db;
    public $dbColumns;
    public $params;

    public function __construct($db = NULL)
    {
        if (isset($db)) {
            $this->db = $db;
        } else {
            $this->db = new Database;
        }
    }

    public function select($data)
    {
        $query = 'SELECT ' . $data['select'] . ' FROM ' . $data['db'];
        if (isset($data['innerJoin'])) {
            foreach ($data['innerJoin'] as $innerJoin)
                $query .= ' INNER JOIN ' . $innerJoin;
        }
        if (isset($data['leftJoin'])) {
            foreach ($data['leftJoin'] as $leftJoin)
                $query .= ' LEFT JOIN ' . $leftJoin;
        }
        if (isset($data['rightJoin'])) {
            foreach ($data['rightJoin'] as $rightJoin)
                $query .= ' RIGHT JOIN ' . $rightJoin;
        }
        if (isset($data['where'])) {
            $query .= ' WHERE ' . $data['where'];
        }
        if (isset($data['where']) && isset($data['and'])) {
            foreach ($data['and'] as $and) {
                if (!empty($and)) {
                    $query .= ' AND ' . $and;
                }
            }
        }
        if (isset($data['in'])) {
            if (isset($data['where'])) {
                foreach ($data['in'] as $in) {
                    if (!empty($in)) {
                        $query .= ' AND ' . $in;
                    }
                }
            } else {
                foreach ($data['in'] as $in) {
                    if (!empty($in)) {
                        $query .= ' WHERE ' . $in;
                    }
                }
            }
        }
        if (isset($data['where']) && isset($data['or'])) {
            if (isset($data['or'][0])) {
                $query .= ' AND ' . $data['or'][0];
            }
            foreach (array_slice($data['or'], 1) as $or) {
                if (!empty($or)) {
                    $query .= ' OR ' . $or;
                }
            }
        }
        if (isset($data['where']) && isset($data['like'])) {
            foreach ($data['like'] as $like) {
                if (!empty($like)) {
                    $query .= ' AND LIKE ' . $like;
                }
            }
        }
        if (isset($data['groupBy'])) {
            $query .= ' GROUP BY ' . $data['groupBy'];
        }
        if (isset($data['limit'])) {
            $query .= ' LIMIT ' . $data['limit'];
        }
        if (isset($data['offset'])) {
            $query .= ' OFFSET ' . $data['offset'];
        }

        $this->db->query($query);

        if (isset($data['binds'])) {
            foreach ($data['binds'] as $key => $bind) {
                if (is_array($bind)) {
                    foreach ($data['binds'][$key] as $bind) {
                        $this->db->bind($key, $bind);
                    }
                } else {
                    $this->db->bind($key, $bind);
                }
            }
        }

        if (isset($data['single'])) {
            return $this->db->single();
        } elseif (isset($data['rowCount'])) {
            return $this->db->rowCount();
        } else {
            return $this->db->resultSet();
        }
    }

    public function create($data)
    {
        foreach ($data['dbColumns'] as $dbColumn) {
            $this->dbColumns .= "," . $dbColumn;
            $this->params .= ",:" . $dbColumn;
        }
        $this->dbColumns = substr($this->dbColumns, 1);
        $this->params = substr($this->params, 1);
        $query = "INSERT INTO " . $data['db'] . "(" . $this->dbColumns . ") VALUE(" . $this->params . ")";

        return $this->excecuteQuery($query, $data);
    }

    public function update($data)
    {
        foreach ($data['dbColumns'] as $dbColumn) {
            $this->dbColumns .= ", " . $dbColumn . " = :" . $dbColumn;
        }
        $this->dbColumns = substr($this->dbColumns, 2);
        $query = "UPDATE " . $data['db'] . " SET " . $this->dbColumns;
        return $this->excecuteQuery($query, $data);
    }

    public function delete($data)
    {
        $query = "DELETE FROM " . $data['db'];
        return $this->excecuteQuery($query, $data);
    }

    public function excecuteQuery($query, $data)
    {
        if (isset($data['where'])) {
            $query .= ' WHERE ' . $data['where'];
        }
        if (isset($data['where']) && isset($data['and'])) {
            $query .= ' AND ' . $data['and'];
        }
        if (isset($data['where']) && isset($data['or'])) {
            $query .= ' OR ' . $data['or'];
        }

        $this->db->query($query);

        foreach ($data['binds'] as $key => $bind) {
            $param = ":" . $key;
            $this->db->bind($param, $bind);
        }

        return $this->db->execute();
    }
}
