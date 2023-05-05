<h1><?=$data['title']?></h1>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="bg-light radius-md padding-md inner-glow shadow-xs">
    <div id="table-id" class="int-table text-sm js-int-table">
        <div class="int-table__inner">
            <table class="int-table__table" aria-label="Interactive table example">
                <thead class="int-table__header js-int-table__header">
                <tr class="int-table__row">
                    <th class="int-table__cell int-table__cell--th text-left">
                        collectionName
                    </th>

                    <th class="int-table__cell int-table__cell--th text-left">
                        collectionCreateDate
                    </th>

                    <th class="int-table__cell int-table__cell--th text-left">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody class="int-table__body js-int-table__body">
                <?php foreach ($data['result'] as $results):?>
                <tr class='int-table__row'>
                    <td class='int-table__cell'><?=$results->collectionName?></td>
                    <td class='int-table__cell'><?=date("d-m-Y",$results->collectionCreateDate);?></td>
                    <td><a class="btn btn--primary" href="<?=APPROOT?>CollectionsController/update/<?=$results->collectionId?>">✏</a>
                    <a class="btn btn--primary" href="<?=APPROOT?>CollectionsController/delete/<?=$results->collectionId?>">❌</a></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex items-center justify-between padding-top-sm">
        <p class="text-sm"><?= count($data['result']) ?> results</p>
        <nav class="pagination text-sm" aria-label="Pagination">
            <ul class="pagination__list flex flex-wrap gap-xxxs">
                <li>
                    <a href="<?=APPROOT?>CollectionsController/index/?page=<?=$data['prevPage']?>" <?= ($data['prevPage'] <= 0) ?'style="pointer-events: none"' : ''?> class="pagination__item">
                        <svg class="icon" viewBox="0 0 16 16">
                            <title>Go to previous page</title>
                            <g stroke-width="2" stroke="currentColor">
                                <polyline fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="9.5,3.5 5,8 9.5,12.5 "></polyline>
                            </g>
                        </svg>
                    </a>
                </li>
                <li>
          <span class="pagination__jumper flex items-center">
            <input aria-label="Page number" class="form-control" type="text" id="pageNumber" name="pageNumber" value="1">
            <em>of 3</em>
          </span>
                </li>

                <li>
                    <a href="<?=APPROOT?>CollectionsController/index/?page=<?=$data['nextPage']?>" class="pagination__item">
                        <svg class="icon" viewBox="0 0 16 16">
                            <title>Go to next page</title>
                            <g stroke-width="2" stroke="currentColor">
                                <polyline fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline>
                            </g>
                        </svg>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<a  role="button" class="btn btn--primary" href="<?=APPROOT?>CollectionsController/create">Create New Collection</a>
</body>
</html>