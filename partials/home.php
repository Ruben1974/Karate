<?php
    $GET = $filter->sanitizeArray(INPUT_GET);
    
    $pageContent = $page->getPageContent($GET['p']);

?>
<div class="banner">
    <img src="./media/<?=$pageContent->filePath?>">
    <div class="bannerText center-align">
        <h2><?=$pageContent->pageTitle?></h2>
        <hr>
        <p><?=$pageContent->pageText?></p>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col s6 m4">
            <a href="./index.php?p=instructors">
                <div class="card hoverable">
                    <div class="card-image">
                    <img src="http://placehold.it/300x300">
                    <span class="card-title black-text">Instruktører</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col s6 m4">
            <a href="./index.php?p=styles/index">
                <div class="card hoverable">
                    <div class="card-image">
                    <img src="http://placehold.it/300x300">
                    <span class="card-title black-text">Stilarter</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col s6 m4">
            <a href="./index.php?p=registration">
                <div class="card hoverable">
                    <div class="card-image">
                    <img src="http://placehold.it/300x300">
                    <span class="card-title black-text">Tilmelding</span>
                    </div>
                </div>
            </a>
        </div>
      </div>
</div>
