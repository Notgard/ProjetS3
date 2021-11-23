<?php

declare(strict_types=1);

$id = empty($_GET['id']) ? null : $_GET['id'];
$stmt = MyPDO::getInstance()->prepare(<<<SQL
    SELECT content
    FROM image
    WHERE idImage = :id
SQL
    );
$stmt->execute(array(":id"=>$id));
if($stmt->rowCount() < 0){
    throw new PDOException("Il n'y a pas d'images avec cet ID dans la base de donnée");
}
echo $stmt->fetch();