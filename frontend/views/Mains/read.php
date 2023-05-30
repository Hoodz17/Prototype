<div class="position-relative z-index-1 padding-y-xl">
    <div class="container max-width-adaptive-lg" style="background-color: white; padding: 1em; height: 100%;">
        <div class="grid gap-lg">
            <h1 class="story__title" style="text-align:center"><?= $data['result']->mainName;  ?></h1>
            <article class="story story--featured">
                <a class="story__img radius-md" href="#0">
                    <figure class=" media-wrapper-4:3">
                        <img src="<?=URLROOT . $data['singleScreen']->screenPath?>" alt="Image description">
                    </figure>
                </a>
            </article>
            <?php foreach ($data['screen'] as $screen): ?>
            <article class="story col-4@md">
                <div class="story__content">
                    <div class="margin-bottom-xs">
                        <a class="story__img radius-md" href="#0">
                            <figure class=" media-wrapper-4:3">
                                <img src="<?=URLROOT . $screen->screenPath?>" alt="Image description" height="300">
                            </figure>
                        </a>
                    </div
                </div>
            </article>
            <?php endforeach; ?>
        </div>

        <article class="story story--featured">
            <div class="story__content" style="text-align: center; margin-left: 10em; margin-right: 10em">
                <div class="text-component">
                    <p class="col-6" style="font-size: 1.3em"><?= $data['result']->mainDescription  ?></p>
                </div>
            </div>
        </article>
        <a  role="button" class="btn btn--primary" href="<?=URLROOT?>HomePageController/read">Back</a>

    </div>

</div>
