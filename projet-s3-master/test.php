<?php
require_once "autoload.php";

$image = base64_encode(file_get_contents($_FILES["image"]["tmp_name"]));
$stat = MyPDO::getInstance()->prepare(<<<SQL
UPDATE image SET CONTENT = :content WHERE idImage = 1
SQL);
echo $stat->execute([':content'=>$image]);
