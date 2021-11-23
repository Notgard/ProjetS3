<?php declare(strict_types = 1);
require_once "autoload.php";
$authentication = new SecureUserAuthentication();
$user = $authentication->getUser();
echo "fuck";
if (isset($_POST["commentaire"]))
{
	$stmt = MyPDO::getInstance()->prepare(<<<SQL
    SELECT MAX(idPublication) as "id"
    FROM Publication
SQL);
    $stmt->execute();
    $NextId = $stmt->fetch()['id']+1;

	$commentaire = nl2br(htmlspecialchars($_POST["commentaire"]));

	$newPublication = MyPDO::getInstance()->prepare(<<<SQL
INSERT INTO commentaire VALUES (:idPublication, :message)
SQL);
	$newPublication->execute([
		':idPublication'=>$NextId,
		':message'=>$commentaire
	]);
	
    echo true;
}
