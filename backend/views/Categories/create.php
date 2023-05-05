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
    <form action="<?=APPROOT?>CategoriesController/create" method="POST">
        <fieldset class="margin-bottom-md">
            <legend class="form-legend">Create Category</legend>
            <div class="grid gap-sm">
                <div class="col-6@md">
                    <label class="form-label margin-bottom-xxs" for="input-name">Category Name</label>
                    <input class="form-control width-100%" type="text" name="categoryName" id="categoryName" required>
                </div>
            </div>
        </fieldset>
        <div>
            <input value="submit" name="submit" class="btn btn--primary" type="submit">
            <a  role="button" class="btn btn--primary" href="<?=APPROOT?>CategoriesController/index">Back</a>
        </div>
    </form>
</div>
<script src="/js/scripts.js"></script>
</body>
</html>