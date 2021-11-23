<?php declare(strict_types=1);

require 'autoload.php';

$id = isset($_POST['id']) ? $_POST['id'] : null;

$stmt = MyPDO::getInstance()->prepare(<<<SQL
    SELECT contenu
    FROM commentaire
    WHERE idPublication = :idPub
SQL);

$stmt->execute(array("idPub"=>$id));

$comments = $stmt->fetchAll();

echo $comments;