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
    <form action="<?=APPROOT?>AttributesController/update" method="POST">
        <fieldset class="margin-bottom-md">
            <legend class="form-legend">Update Attribute</legend>
            <div class="grid gap-sm">
                <div class="col-6@md">
                    <label class="form-label margin-bottom-xxs" for="input-name">Attribute Main</label>
                    <input hidden="hidden" name="attributeId" value="<?= $data['result']->attributeId?>">
                    <div class="select">
                        <select class="select__input form-control" name="mainId" id="mainId">
                            <?php foreach ($data['mains'] as $results) {
                                echo '<option value="' . $results->mainId  . '">' . $results->mainName . '</option>';
                            } ?>
                        </select>
                        <svg class="icon select__icon" aria-hidden="true" viewBox="0 0 16 16"><polyline points="1 5 8 12 15 5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                    </div>
                </div>
                <div class="grid gap-sm">
                    <div class="col-6@md">
                        <label class="form-label margin-bottom-xxs" for="input-name">Attribute Name</label>
                        <input class="form-control width-100%" type="text" name="attributeName" id="attributeName" value="<?= $data['result']->attributeName?>" required>
                    </div>
                </div>
                <div class="grid gap-sm">
                    <div class="col-6@md">
                        <label class="form-label margin-bottom-xxs" for="input-name">Attribute Value</label>
                        <input class="form-control width-100%" type="text" name="attributeValue" id="attributeValue" value="<?= $data['result']->attributeValue?>" required>
                    </div>
                </div>
            </div>
        </fieldset>
        <div>
            <input value="submit" name="submit" class="btn btn--primary" type="submit">
            <a  role="button" class="btn btn--primary" href="<?=APPROOT?>AttributesController/index">Back</a>
        </div>
    </form>
</div>
<script src="/js/scripts.js"></script>
</body>
</html>