<div class="position-relative z-index-1 padding-y-xl">
    <div class="container max-width-adaptive-lg" style="background-color: white; padding: 1em; height: 100%;">
        <div class="grid gap-lg">
            <article class="story story--featured">
                <a class="story__img radius-md" href="#0">
                    <figure class=" media-wrapper-4:3">
                        <img src="<?=URLROOT . $data['result']->screenPath?>" alt="Image description">
                    </figure>
                </a>

                <div class="story__content">
                    <div class="text-component">
                        <h2 class="story__title"><?= $data['result']->mainName;  ?></h2>
                        <p class="col-6"><?= $data['result']->mainDescription  ?></p>
                    </div>
                </div>
            </article>
            <article class="story col-4@md">
                <a class="story__img radius-md" href="#0">
                    <figure class="aspect-ratio-4:3">
                        <img src="../../../app/assets/img/article-gallery-img-2.jpg" alt="Image description">
                    </figure>
                </a>

                <div class="story__content">
                    <div class="margin-bottom-xs">
                        <a class="story__img radius-md" href="#0">
                            <figure class=" media-wrapper-4:3">
                                <img src="<?=URLROOT . $data['result']->screenPath?>" alt="Image description">
                            </figure>
                        </a>
                    </div>

                    <div class="text-component">
                        <h2 class="story__title"><a href="#0">Lorem ipsum dolor sit amet consectetur adipisicing elit</a></h2>

                    </div>

                    <div class="story__author margin-top-sm">
                        <a class="block" href="#0">
                            <img src="../../../app/assets/img/article-gallery-img-author-2.svg" alt="Author picture">
                        </a>

                        <div class="line-height-xs">
                            <address class="story__author-name"><a href="#0" rel="author">James Powell</a></address>
                            <p class="story__meta"><time>May 12</time> &mdash; 5 min read</p>
                        </div>
                    </div>
                </div>
            </article>

            <article class="story col-4@md">
                <a class="story__img radius-md" href="#0">
                    <figure class="aspect-ratio-4:3">
                        <img src="../../../app/assets/img/article-gallery-img-3.jpg" alt="Image description">
                    </figure>
                </a>

                <div class="story__content">
                    <div class="margin-bottom-xs">

                        <a class="story__img radius-md" href="#0">
                            <figure class=" media-wrapper-4:3">
                                <img src="<?=URLROOT . $data['result']->screenPath?>" alt="Image description">
                            </figure>
                        </a>
                    </div>

                    <div class="text-component">
                        <h2 class="story__title"><a href="#0">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quis hic veniam harum?</a></h2>

                    </div>

                    <div class="story__author margin-top-sm">
                        <a class="block" href="#0">
                            <img src="../../../app/assets/img/article-gallery-img-author-2.svg" alt="Author picture">
                        </a>

                        <div class="line-height-xs">
                            <address class="story__author-name"><a href="#0" rel="author">James Powell</a></address>
                            <p class="story__meta"><time>May 8</time> &mdash; 5 min read</p>
                        </div>
                    </div>
                </div>
            </article>

            <article class="story col-4@md">
                <a class="story__img radius-md" href="#0">
                    <figure class="aspect-ratio-4:3">
                        <img src="../../../app/assets/img/article-gallery-img-4.jpg" alt="Image description">
                    </figure>
                </a>

                <div class="story__content">
                    <div class="margin-bottom-xs">
                        <a class="story__category" href="#0">
                            <svg class="icon margin-right-xxxs" aria-hidden="true" viewBox="0 0 16 16"><g stroke-width='1' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><circle cx='8' cy='7' r='1.5'></circle><path d='M12.121,14.263a7.5,7.5,0,1,0-8.242,0'></path><path d='M12.377,11.32a5.5,5.5,0,1,0-8.754,0'></path><path d='M6.605,10.5H9.4a1,1,0,0,1,1,1.1L10,15.5H6l-.39-3.9A1,1,0,0,1,6.605,10.5Z'></path></g></svg>
                            <i>Podcast</i>
                        </a>
                    </div>

                    <div class="text-component">
                        <h2 class="story__title"><a href="#0">Lorem ipsum dolor sit amet consectetur</a></h2>

                    </div>

                    <div class="story__author margin-top-sm">
                        <a class="block" href="#0">
                            <img src="../../../app/assets/img/article-gallery-img-author-1.svg" alt="Author picture">
                        </a>

                        <div class="line-height-xs">
                            <address class="story__author-name"><a href="#0" rel="author">Olivia Gribben</a></address>
                            <p class="story__meta"><time>May 5</time> &mdash; 5 min read</p>
                        </div>
                    </div>
                </div>
            </article>
        </div>

        <nav class="pagination margin-top-xxl" aria-label="Pagination">
            <ol class="pagination__list flex flex-wrap gap-xxxs justify-center">
                <li>
                    <a href="#0" class="pagination__item pagination__item--disabled" aria-label="Go to previous page">
                        <svg class="icon icon--xs margin-right-xxxs flip-x" viewBox="0 0 16 16"><polyline points="6 2 12 8 6 14" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                        <span>Prev</span>
                    </a>
                </li>

                <li class="display@sm">
                    <a href="#0" class="pagination__item" aria-label="Go to page 1">1</a>
                </li>

                <li class="display@sm">
                    <a href="#0" class="pagination__item" aria-label="Go to page 2">2</a>
                </li>

                <li class="display@sm">
                    <a href="#0" class="pagination__item pagination__item--selected" aria-label="Current Page, page 3" aria-current="page">3</a>
                </li>

                <li class="display@sm">
                    <a href="#0" class="pagination__item" aria-label="Go to page 4">4</a>
                </li>

                <li class="display@sm" aria-hidden="true">
                    <span class="pagination__item pagination__item--ellipsis">...</span>
                </li>

                <li class="display@sm">
                    <a href="#0" class="pagination__item" aria-label="Go to page 20">20</a>
                </li>

                <li>
                    <a href="#0" class="pagination__item" aria-label="Go to next page">
                        <span>Next</span>
                        <svg class="icon icon--xs margin-left-xxxs" viewBox="0 0 16 16"><polyline points="6 2 12 8 6 14" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                    </a>
                </li>
            </ol>
        </nav>
    </div>
    <a  role="button" class="btn btn--primary" href="<?=URLROOT?>HomePageController/read">Back</a>

</div>
