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
<div class="container max-width-sm padding-y-lg">
    <form action="<?=APPROOT?>MainsHasCatsController/update" method="POST">
        <input hidden="hidden" value="<?= $data['result']->mainId ?>" name="mainHasCatMainId">
        <input hidden="hidden" value="<?= $data['result']->categoryId ?>" name="mainHasCatCategoryId">
        <fieldset class="margin-bottom-md">
            <legend class="form-legend">Update MainsHasCats</legend>
            <div class="grid gap-sm">
                <div class="col-6@md">
                    <label class="form-label margin-bottom-xxs" for="input-name">Main Name</label>
                    <div class="select">

                        <select class="select__input form-control" name="mainId" id="mainId">
                            <option value="<?= $data['result']->mainId ?>"><?= $data['result']->mainName ?></option>
                            <?php foreach ($data['main'] as $results) {
                                if ($data['result']->mainId != $results->mainId) { ?>
                                    <option value="<?= $results->mainId  ?>"><?= $results->mainName ?></option>
                            <?php } } ?>
                        </select>
                        <svg class="icon select__icon" aria-hidden="true" viewBox="0 0 16 16"><polyline points="1 5 8 12 15 5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                    </div>
                </div>
            </div>
            <div class="grid gap-sm">
                <div class="col-6@md">
                <label class="form-label margin-bottom-xxs" for="input-name">Category Name</label>
                <div class="select">
                        <select class="select__input form-control" name="categoryId" id="categoryId">
                                <option value="<?= $data['result']->categoryId ?>"><?= $data['result']->categoryName ?></option>
                            <?php foreach ($data['category'] as $results) {
                                if ($data['result']->categoryId != $results->categoryId) { ?>
                                    <option value="<?= $results->categoryId  ?>"><?= $results->categoryName ?></option>
                                <?php } } ?>
                        </select>
                        <svg class="icon select__icon" aria-hidden="true" viewBox="0 0 16 16"><polyline points="1 5 8 12 15 5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                    </div>
                </div>
            </div>
        </fieldset>
        <div>
            <input value="submit" name="submit" class="btn btn--primary" type="submit">
            <a  role="button" class="btn btn--primary" href="<?=APPROOT?>MainsHasCatsController/index">Back</a>
        </div>
    </form>
</div>
<script src="/js/scripts.js"></script>
</body>
</html>
