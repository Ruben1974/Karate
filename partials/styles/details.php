<?php
    $GET = $filter->sanitizeArray(INPUT_GET);
    if(isset($GET['id']) && !empty($GET['id'])){
        $styleId = $GET['id'];
    }else{
        header('Location: ./index.php?p=Styles/Index');
        exit;
    }
    $style = $content->getStyleById($styleId);
    $teams = $teams->getTeamByStyleId($styleId);

?>
<div class="container">
    <div class="row">
        <div class="col s12">
            <h2>Stilart - <?=$style->stylesName?></h2>
            <p class="flow-text">
                <?=$style->stylesDescription?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <h3>Hold</h3>
            <table class="bordered highlight striped responsive-table">
            <thead>
            <tr>
                <th>Hold navn</th>
                <th>Stilart</th>
                <th>Aldersgruppe</th>
                <th>Niveau</th>
                <th>Instruktør</th>
                <th>Pris</th>
                <th>Tilmeld</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($teams as $team){
                ?>
                <tr>
                    <td><?=$team->teamName?></td>
                    <td><?=$team->stylesName?></td>
                    <td><?=$team->ageGrpName?></td>
                    <td><?=$team->levelName?></td>
                    <td><?=$team->firstname . ' ' . $team->lastname?></td>
                    <td><?=$team->teamPrice?> kr.</td>
                    <td>
                        <?php
                            if($user->checkSession()){
                            ?>
                                <a class="btn btn-md" href="./index.php?p=Teams/Register&id=<?=$team->teamId?>">Tilmeld</a>
                            <?php
                            }else{
                            ?>
                                <a class="btn btn-md disabled" href="./index.php?p=Teams/Register&id=<?=$team->teamId?>">Tilmeld</a>
                                <br>
                                <em>Du skal være logget ind</em>
                            <?php
                            }
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        </div>
    </div>
</div>