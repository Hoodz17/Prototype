<div>
    <section class="adv-filter padding-y-lg js-adv-filter">
        <div class="container max-width-adaptive-lg" style="background-color: white; padding: 1em; height: 100%;">
            <div class="margin-bottom-md hide@md no-js:is-hidden">
                <button class="btn btn--subtle width-100%" aria-controls="filter-panel">Show filters</button>
            </div>

            <div class="flex@md">
                <aside id="filter-panel" class="sidebar sidebar--static@md js-sidebar" aria-labelledby="filter-panel-title">
                    <div class="sidebar__panel max-width-100% width-100%">
                        <header class="sidebar__header bg padding-y-sm padding-x-md border-bottom z-index-2">
                            <h1 class="text-md text-truncate" id="filter-panel-title">Filters</h1>

                            <button class="reset sidebar__close-btn js-sidebar__close-btn js-tab-focus">
                                <svg class="icon icon--xs" viewBox="0 0 16 16">
                                    <title>Close panel</title>
                                    <g stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
                                        <line x1="13.5" y1="2.5" x2="2.5" y2="13.5"></line>
                                        <line x1="2.5" y1="2.5" x2="13.5" y2="13.5"></line>
                                    </g>
                                </svg>
                            </button>
                        </header>

                        <form class="position-relative z-index-1 js-adv-filter__form">
                            <input type="hidden" name="page" value="<?= $data['recordsPerpage'] ?>">

                            <div class="padding-md padding-0@md margin-bottom-sm@md">
                                <a href="<?= URLROOT ?>" class="reset text-sm color-contrast-high text-underline cursor-pointer margin-bottom-sm text-xs@md" type="reset">Reset all filters</a>

                                <div class="search-input search-input--icon-left text-sm@md">
                                    <input class="search-input__input form-control" type="search" name="search-index" id="search-index" value="<?= (isset($data['params']['search-index']) && !empty($data['params']['search-index'])) ?$data['params']['search-index'] : "" ?>">

                                    <button class="search-input__btn">
                                        <svg class="icon" viewBox="0 0 20 20">
                                            <title>Submit</title>
                                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                <circle cx="8" cy="8" r="6" />
                                                <line x1="12.242" y1="12.242" x2="18" y2="18" />
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <ul class="accordion js-accordion" data-animation="on" data-multi-items="on">
                                <li class="accordion__item accordion__item--is-open js-accordion__item js-adv-filter__item" data-default-text="All" data-multi-select-text="{n} filters selected">
                                    <button class="reset accordion__header padding-y-sm padding-x-md padding-x-xs@md js-tab-focus" type="button">
                                        <div>
                                            <div class="text-sm@md">Categories</div>
                                            <div class="text-sm color-contrast-low"><i class="sr-only">Active filters: </i><span class="js-adv-filter__selection">All</span></div>
                                        </div>

                                        <svg class="icon accordion__icon-arrow-v2 no-js:is-hidden" viewBox="0 0 20 20">
                                            <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="3" y1="3" x2="17" y2="17" />
                                                <line x1="17" y1="3" x2="3" y2="17" />
                                            </g>
                                        </svg>
                                    </button>

                                    <div class="accordion__panel js-accordion__panel">
                                        <div class="padding-top-xxxs padding-x-md padding-bottom-md padding-x-xs@md">
                                            <div class="adv-filter__checkbox-list flex flex-column gap-xxxs js-read-more" aria-controls="adv-filter-gallery" data-btn-labels="Show More, Show Less" data-ellipsis="off" data-btn-class="reset text-sm text-underline cursor-pointer margin-top-xs js-tab-focus">
                                                <?php
                                                foreach ($data['mainsHasCats'] as $key => $mainHasCat) {
                                                    if ($key > 3) continue; ?>
                                                    <div>
                                                        <input class="checkbox" type="checkbox"  name="category-checkbox[]" id="categories-<?= $mainHasCat->categoryId ?>" value="<?= $mainHasCat->categoryId ?>" <?= (isset($data['params']['category-checkbox']) && in_array($mainHasCat->categoryId, $data['params']['category-checkbox'])) ? "checked" : "" ?>>
                                                        <label for="categories-<?= $mainHasCat->categoryId ?>"><?= $mainHasCat->categoryName ?></label>
                                                    </div>
                                                <?php } ?>

                                                <div class="js-read-more__content">
                                                    <div class="flex flex-column gap-xxxs">
                                                        <?php
                                                        foreach ($data['mainsHasCats'] as $key => $mainHasCat) {
                                                            if ($key < 4) continue;
                                                        ?>
                                                            <div>
                                                                <input class="checkbox" type="checkbox" name="category-checkbox[]" id="categories-<?= $mainHasCat->categoryId ?>" value="<?= $mainHasCat->categoryId ?>" <?= (isset($data['params']['category-checkbox']) && in_array($mainHasCat->categoryId, $data['params']['category-checkbox'])) ? "checked" : "" ?>>
                                                                <label for="categories-<?= $mainHasCat->categoryId ?>"><?= $mainHasCat->categoryName ?></label>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="accordion__item accordion__item--is-open js-accordion__item js-adv-filter__item" data-default-text="All" data-multi-select-text="{n} filters selected">
                                    <button class="reset accordion__header padding-y-sm padding-x-md padding-x-xs@md js-tab-focus" type="button">
                                        <div>
                                            <div class="text-sm@md">Collections</div>
                                            <div class="text-sm color-contrast-low"><i class="sr-only">Active filters: </i><span class="js-adv-filter__selection">All</span></div>
                                        </div>

                                        <svg class="icon accordion__icon-arrow-v2 no-js:is-hidden" viewBox="0 0 20 20">
                                            <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="3" y1="3" x2="17" y2="17" />
                                                <line x1="17" y1="3" x2="3" y2="17" />
                                            </g>
                                        </svg>
                                    </button>

                                    <div class="accordion__panel js-accordion__panel">
                                        <div class="padding-top-xxxs padding-x-md padding-bottom-md padding-x-xs@md">
                                            <div class="adv-filter__checkbox-list flex flex-column gap-xxxs js-read-more" aria-controls="adv-filter-gallery" data-btn-labels="Show More, Show Less" data-ellipsis="off" data-btn-class="reset text-sm text-underline cursor-pointer margin-top-xs js-tab-focus">
                                                <?php
                                                foreach ($data['collections'] as $key => $collection) {
                                                    if ($key > 3) continue; ?>
                                                    <div>
                                                        <input class="checkbox" type="checkbox" name="collection-checkbox[]" id="collections-<?= $collection->collectionId ?>" value="<?= $collection->collectionId ?>" <?= (isset($data['params']['collection-checkbox']) && in_array($collection->collectionId, $data['params']['collection-checkbox'])) ? "checked" : "" ?>>
                                                        <label for="collections-<?= $collection->collectionId ?>"><?= $collection->collectionName ?></label>
                                                    </div>
                                                <?php } ?>

                                                <div class="js-read-more__content">
                                                    <div class="flex flex-column gap-xxxs">
                                                        <?php
                                                        foreach ($data['collections'] as $key => $collection) {
                                                            if ($key < 4) continue;
                                                        ?>
                                                            <div>
                                                                <input class="checkbox" type="checkbox" name="collection-checkbox[]" id="collections-<?= $collection->collectionId ?>" value="<?= $collection->collectionId ?>" <?= (isset($data['params']['collection-checkbox']) && in_array($collection->collectionId, $data['params']['collection-checkbox'])) ? "checked" : "" ?>>
                                                                <label for="collections-<?= $collection->collectionId ?>"><?= $collection->collectionName ?></label>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="accordion__item js-accordion__item js-adv-filter__item" data-default-text="All">
                                    <button class="reset accordion__header padding-y-sm padding-x-md padding-x-xs@md js-tab-focus" type="button">
                                        <div>
                                            <div class="text-sm@md">Is Spotlight</div>
                                            <div class="text-sm color-contrast-low"><i class="sr-only">Active filters: </i><span class="js-adv-filter__selection">All</span></div>
                                        </div>

                                        <svg class="icon accordion__icon-arrow-v2 no-js:is-hidden" viewBox="0 0 20 20">
                                            <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="3" y1="3" x2="17" y2="17" />
                                                <line x1="17" y1="3" x2="3" y2="17" />
                                            </g>
                                        </svg>
                                    </button>

                                    <div class="accordion__panel js-accordion__panel">
                                        <div class="padding-top-xxxs padding-x-md padding-bottom-md padding-x-xs@md">
                                            <ul class="adv-filter__radio-list flex flex-column gap-xxxs" aria-controls="adv-filter-gallery">
                                                <li>
                                                    <input class="radio" type="radio" name="radio-filter" value="2" id="radio2" <?= (isset($data['params']['radio-filter']) && $data['params']['radio-filter'] == 2) ? "checked" : "" ?>>
                                                    <label for="radio2">All</label>
                                                </li>
                                                <li>
                                                    <input class="radio" type="radio" name="radio-filter" value="1" id="radio1" <?= (isset($data['params']['radio-filter']) && $data['params']['radio-filter'] == 1) ? "checked" : "" ?>>
                                                    <label for="radio1">Yes</label>
                                                </li>
                                                <li>
                                                    <input class="radio" type="radio" name="radio-filter" value="0" id="radio0" <?= (isset($data['params']['radio-filter']) && $data['params']['radio-filter'] == 0) ? "checked" : "" ?>>
                                                    <label for="radio0">No</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div style="margin-top: 1em;">
                                <button type="submit" class="btn btn--primary width-100%">Filter</button>
                            </div>
                        </form>
                    </div>
                </aside>

                <main class="flex-grow padding-left-xl@md sidebar-loaded:show">
                    <div class="flex items-center justify-between margin-bottom-sm">
                        <p class="text-sm"><?= $data['totalRecords']; ?> results</p>

                        <div class="flex items-baseline">
                            <label class="text-sm color-contrast-medium margin-right-xs" for="select-sorting">Sort:</label>

                            <div class="select inline-block js-select" data-trigger-class="reset text-sm color-contrast-high text-underline inline-flex items-center cursor-pointer js-tab-focus">
                                <!-- data-trigger-class -> custom select component 👆 -->
                                <select name="select-sorting" id="select-sorting" aria-controls="adv-filter-gallery" data-sort="true">
                                    <option value="*" selected>No sorting</option>
                                    <option value="index" data-sort-number="true">Index</option>
                                    <option value="index" data-sort-order="desc" data-sort-number="true">Index Desc</option>
                                </select>

                                <svg class="icon icon--xxxs margin-left-xxs" viewBox="0 0 8 8">
                                    <path d="M7.934,1.251A.5.5,0,0,0,7.5,1H.5a.5.5,0,0,0-.432.752l3.5,6a.5.5,0,0,0,.864,0l3.5-6A.5.5,0,0,0,7.934,1.251Z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="margin-bottom-sm">
                        <?php if (!empty($data['cards'])) { ?>
                            <ul class="grid gap-sm js-adv-filter__gallery" id="adv-filter-gallery">
                                <?= $data['cards'] ?>
                            </ul>
                        <?php } else { ?>
                            <div class="margin-top-md" data-fallback-gallery-id="adv-filter-gallery">
                                <p class="color-contrast-medium text-center">No results</p>
                            </div>
                        <?php } ?>
                    </div>

                    <div>
                        <nav class="pagination pagination--split" aria-label="Pagination">
                            <ol class="pagination__list flex flex-wrap gap-xxxs justify-center">
                                <li>
                                    <a href="<?= URLROOT ?>HomepageController/?page=<?= $data['prevPage'] ?>" class="pagination__item <?= ($data['prevPage'] <= 0) ? "pagination__item--disabled" : "" ?>" aria-label="Go to previous page">
                                        <svg class="icon icon--xs margin-right-xxxs flip-x" viewBox="0 0 16 16">
                                            <polyline points="6 2 12 8 6 14" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                        </svg>
                                        <span>Prev</span>
                                    </a>
                                </li>

                                <li class="display@sm">
                                    <a href="<?= URLROOT ?>HomepageController/?page=<?= $data['pageNumber'] ?>" class="pagination__item pagination__item--selected"><?= $data['paginationNumber'] ?></a>
                                </li>
                                <?php
                                $secondPage = $data['paginationNumber'] + 1;
                                $thirdPage = $data['paginationNumber'] + 2;
                                $fourthPage = $data['paginationNumber'] + 3;

                                if ($secondPage < $data['lastPagePagination']) { ?>
                                    <li class="display@sm">
                                        <a href="<?= URLROOT ?>HomepageController/?page=<?= $secondPage ?>" class="pagination__item"><?= $secondPage ?></a>
                                    </li>
                                <?php } ?> <?php
                                            if ($thirdPage < $data['lastPagePagination']) { ?>
                                    <li class="display@sm">
                                        <a href="<?= URLROOT ?>HomepageController/?page=<?= $thirdPage ?>" class="pagination__item"><?= $thirdPage ?></a>
                                    </li>
                                <?php } ?> <?php
                                            if ($fourthPage < $data['lastPagePagination']) { ?>
                                    <li class="display@sm">
                                        <a href="<?= URLROOT ?>HomepageController/?page=<?= $fourthPage ?>" class="pagination__item"><?= $fourthPage ?></a>
                                    </li>
                                <?php } ?>

                                <li class="display@sm" aria-hidden="true">
                                    <span class="pagination__item pagination__item--ellipsis">...</span>
                                </li>

                                <li class="display@sm">
                                    <a href="<?= URLROOT ?>HomepageController/?page=<?= $data['lastPage'] ?>" class="pagination__item"><?= $data['lastPagePagination'] ?></a>
                                </li>

                                <li>
                                    <a href="<?= URLROOT ?>HomepageController/?page=<?= $data['nextPage'] ?>" class="pagination__item <?= ($data['nextPage'] > $data['lastPage']) ? "pagination__item--disabled" : "" ?>" aria-label="Go to next page">
                                        <span>Next</span>
                                        <svg class="icon icon--xs margin-left-xxxs" viewBox="0 0 16 16">
                                            <polyline points="6 2 12 8 6 14" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                        </svg>
                                    </a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </main>
            </div>
        </div>
    </section>
</div>