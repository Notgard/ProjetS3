<?php

declare(strict_types = 1);
$filesUrl = empty($_POST['images']) ? null : $_POST['images'];


foreach ($filesUrl as $image) {
    $stat = MyPDO::getInstance()->prepare(<<<SQL
    INSERT INTO image VALUES(:id, :content);
SQL);
    $stat->execute([':content'=>$image, ':id'=>$id]);
}

