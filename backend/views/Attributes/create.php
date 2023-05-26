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
    <form action="<?=BACKENDROOT?>AttributesController/create" method="POST">
        <fieldset class="margin-bottom-md">
            <legend class="form-legend">Create Attribute</legend>
            <div class="grid gap-sm">
                <div class="col-6@md">
                    <label class="form-label margin-bottom-xxs" for="input-name">Main Name</label>
                    <div class="select">
                        <select class="select__input form-control" name="attributeMainId" id="attributeMainId">
                            <option disabled selected>Select Main</option>
                            <?php foreach ($data['mains'] as $results) {
                                echo '<option value="' . $results->mainId  . '">' . $results->mainName . '</option>';
                            } ?>
                        </select>
                        <svg class="icon select__icon" aria-hidden="true" viewBox="0 0 16 16"><polyline points="1 5 8 12 15 5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                    </div>
                </div>
            </div>
            <div class="grid gap-sm">
                <div class="col-6@md">
                    <label class="form-label margin-bottom-xxs" for="input-name">Attribute Name</label>
                    <input class="form-control width-100%" type="text" name="attributeName" id="attributeName" required>
                </div>
            </div>
            <div class="grid gap-sm">
                <div class="col-6@md">
                    <label class="form-label margin-bottom-xxs" for="input-name">Attribute Value</label>
                    <input class="form-control width-100%" type="text" name="attributeValue" id="attributeValue" required>
                </div>
            </div>
        </fieldset>
        <div>
            <input value="submit" name="submit" class="btn btn--primary" type="submit">
            <a  role="button" class="btn btn--primary" href="<?=BACKENDROOT?>AttributesController/index">Back</a>
        </div>
    </form>
</div>
<script src="/js/scripts.js"></script>
</body>
</html>