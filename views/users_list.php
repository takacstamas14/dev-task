<?php
include basedir."/views/layout/header.php";
?>

<div class="container">
    <h4 class="my-4">Users with link to their advertisements</h4>
    <div class="list-group">
    <?php
    foreach ($param["data"] AS $item)
    {
    ?>
        <a class="margin-list-a" href="<?=baseurl."/user/".$item->getId();?>"><?=$item->getName();?></a>
    <?php
    }
    ?>
    </div>
</div>


<?php
include basedir."/views/layout/footer.php";
?>
