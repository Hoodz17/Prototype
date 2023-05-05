<?php
interface SQLQueryBuilder
{
    public function select(string $table, array $fields): SQLQueryBuilder;

    public function where(string $field, string $value, string $operator = '='): SQLQueryBuilder;

    public function limit(int $start, int $offset): SQLQueryBuilder;

    public function innerJoin(array $innerJoins): SQLQueryBuilder;

    public function leftJoin(string $table, string $fromColumn, string $toColumn): SQLQueryBuilder;

    public function rightJoin(string $table, string $fromColumn, string $toColumn): SQLQueryBuilder;

    // +100 other SQL syntax methods...

    public function getParams(): array;

    public function getSQL(): string;
}

class MysqlQueryBuilder implements SQLQueryBuilder
{
    protected $query;
    protected $table;
    protected $paramNumber;

    protected function reset(): void
    {
        $this->query = new \stdClass();
        $this->table = NULL;
        $this->paramNumber = 0;
    }

    /**
     * Build a base SELECT query.
     */
    public function select(string $table, array $fields): SQLQueryBuilder
    {
        $this->reset();
        $this->table = $table;
        $this->query->base = "SELECT " . implode(", ", $fields) . " FROM " . $table;
        $this->query->type = 'select';

        return $this;
    }

    /**
     * Add a INNER JOIN condition.
     */
    public function innerJoin(array $innerJoins): SQLQueryBuilder
    {
        if (!in_array($this->query->type, ['select'])) {
            throw new \Exception("INNER JOIN can only be added to SELECT");
        }
        foreach ($innerJoins as $innerJoin) {
            $this->query->join[] = " INNER JOIN " . $innerJoin[0] . " ON " . $innerJoin[1] . " = " . $innerJoin[2];
        }
        return $this;
    }

    /**
     * Add a LEFT JOIN condition.
     */
    public function leftJoin(string $table, string $fromColumn, string $toColumn): SQLQueryBuilder
    {
        if (!in_array($this->query->type, ['select'])) {
            throw new \Exception("LEFT JOIN can only be added to SELECT");
        }
        $this->query->join[] = " LEFT JOIN " . $table . " ON " . $fromColumn . " = " . $toColumn;

        return $this;
    }

    /**
     * Add a RIGHT JOIN condition.
     */
    public function rightJoin(string $table, string $fromColumn, string $toColumn): SQLQueryBuilder
    {
        if (!in_array($this->query->type, ['select'])) {
            throw new \Exception("RIGHT JOIN can only be added to SELECT");
        }
        $this->query->join[] = " RIGHT JOIN " . $table . " ON " . $fromColumn . " = " . $toColumn;

        return $this;
    }

    /**
     * Add a WHERE condition.
     */
    public function where(string $field, string $value, string $operator = '='): SQLQueryBuilder
    {
        if (!in_array($this->query->type, ['select', 'update', 'delete'])) {
            throw new \Exception("WHERE can only be added to SELECT, UPDATE OR DELETE");
        }

        if (ctype_alnum($field)) {
            $paramName = ":param" . ucfirst($field) . $this->paramNumber;
        } else {
            $paramName = ":param" . preg_replace("/[^A-Za-z0-9 ]/", '', ucfirst($field)) . $this->paramNumber;
        }

        $this->query->params[$paramName] = $value;

        $this->query->where[] = "$field $operator $paramName";
        $this->paramNumber++;
        
        return $this;
    }

    /**
     * Add a LIMIT constraint.
     */
    public function limit(int $start, int $offset): SQLQueryBuilder
    {
        if (!in_array($this->query->type, ['select'])) {
            throw new \Exception("LIMIT can only be added to SELECT");
        }
        $this->query->limit = " LIMIT " . $start . ", " . $offset;

        return $this;
    }

    /**
     * Get the final query string.
     */
    public function getSQL(): string
    {
        $query = $this->query;
        $sql = $query->base;
        if (isset($query->join)) {
            foreach($query->join as $join) {
                $sql .= $join;
            }
        }
        if (!empty($query->where)) {
            $sql .= " WHERE " . implode(' AND ', $query->where);
        }
        if (isset($query->limit)) {
            $sql .= $query->limit;
        }
        $sql .= ";";

        return $sql;
    }

    public function getParams(): array
    {
        return $this->query->params;
    }
}
