<?php
include basedir."/views/layout/header.php";
?>

<div class="container">
    <h4 class="my-4">All advertisement by <?=$param["userData"][0]->getName();?></h4>
    <div class="list-group">
        <?php
        foreach ($param["data"] AS $item)
        {
            ?>
            <div class="margin-list-a"><?=$item->getTitle();?></div>
            <?php
        }
        ?>
    </div>
</div>


<?php
include basedir."/views/layout/footer.php";
?>
