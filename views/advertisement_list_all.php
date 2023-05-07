<?php
include basedir."/views/layout/header.php";
?>


<div class="container">

    <h4 class="my-4">All advertisement with usernames</h4>
    <div class="list-group">
        <?php
        foreach ($param["data"] AS $item)
        {
            ?>
            <div class="margin-list-a" href="#">Title: <?=$item["title"]?> - Username: <?=$item["name"];?></div>
            <?php
        }
        ?>
    </div>
</div>


<?php
include basedir."/views/layout/footer.php";
?>
