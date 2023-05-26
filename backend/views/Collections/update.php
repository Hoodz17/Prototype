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
    <form action="<?=BACKENDROOT?>CollectionsController/update" method="POST">
        <fieldset class="margin-bottom-md">
            <legend class="form-legend">Update Collection</legend>
            <div class="grid gap-sm">
                <div class="col-6@md">
                    <input class="form-control width-100%"  type="text" name="collectionId" hidden="hidden"  id="input-name" value="<?= $data['result']->collectionId?>" required>
                </div>
            </div>
            <div class="grid gap-sm">
                <div class="col-6@md">
                    <label class="form-label margin-bottom-xxs" for="input-name">ColletionName</label>
                    <input class="form-control width-100%" type="text" name="collectionName" id="input-name" value="<?= $data['result']->collectionName?>" required>
                </div>
            </div>
        </fieldset>
        <div>
            <input value="submit" name="submit" class="btn btn--primary" type="submit">
            <a  role="button" class="btn btn--primary" href="<?=BACKENDROOT?>CollectionsController/index">Back</a>
        </div>
    </form>
</div>
<script src="/js/scripts.js"></script>
</body>
</html>