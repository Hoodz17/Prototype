<div class="bg-dark min-height-100vh flex flex-center padding-md">
    <form class="bg radius-md shadow-sm padding-lg max-width-xx" action="<?= BACKENDROOT ?>MainsHasCatsController/delete/<?= $data["mainId"] ?>+<?= $data["categoryId"] ?>" method="post">
        <div class="text-center margin-bottom-md">
            <h1><?= $data['title'] ?></h1>
        </div>
        <div class="margin-bottom-sm">
            <input type="hidden" value="<?= $data["mainId"] ?>" name="mainId">
            <input type="hidden" value="<?= $data["categoryId"] ?>" name="categoryId">
            <button type="submit" class="btn btn--primary btn--md width-100%">Yes</button>
        </div>
        <div class="text-center">
            <p class="text-sm"><a href="<?= BACKENDROOT ?>MainsHasCatsController/index">&larr; Back to index</a></p>
        </div>
    </form>
</div>