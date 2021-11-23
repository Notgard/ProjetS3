<?php declare(strict_types = 1);
require_once "autoload.php";
$authentication = new SecureUserAuthentication();
$user = $authentication->getUser();

if (isset($_POST["message"]))
{
	$stmt = MyPDO::getInstance()->prepare(<<<SQL
    SELECT MAX(idPublication) as "id"
    FROM Publication
SQL);
    $stmt->execute();
    $NextId = $stmt->fetch()['id']+1;

	$idUser = $user->getIdUser();
	$NextIdImage = null;
	if (isset($_POST["image"])) {
		$image = explode(",",$_POST["image"])[1];
		$stmt = MyPDO::getInstance()->prepare(<<<SQL
		SELECT MAX(idImage) as "id"
		FROM image
	SQL);
		$stmt->execute();
		$NextIdImage = $stmt->fetch()['id']+1;
		$newImage = MyPDO::getInstance()->prepare(<<<SQL
	INSERT INTO image VALUES (:NextIdImage, :content)
	SQL);
		$newImage->execute([':NextIdImage'=>$NextIdImage,':content'=>$image]);
	
	}
	$message = nl2br(htmlspecialchars($_POST["message"]));
	$isEvent = 1;

	$newPublication = MyPDO::getInstance()->prepare(<<<SQL
INSERT INTO publication VALUES (:idPublication, :idImage, :idUser, SYSDATE(), :message, :isEvent)
SQL);
	$newPublication->execute([
		':idPublication'=>$NextId,
		':idImage'=>$NextIdImage,
		':idUser'=>$idUser,
		':message'=>$message,
		':isEvent'=>$isEvent
	]);

	if ($isEvent == 1 && isset($_POST["nom"]) && isset($_POST["dateEvent"]) && !empty($_POST["dateEvent"]) && isset($_POST["lieuEvent"]) && !empty($_POST["lieuEvent"])) {
		$nbParticipantsMax = 16;
		$nom = nl2br(htmlspecialchars($_POST["nom"]));
		$lieuEvent = nl2br(htmlspecialchars($_POST["lieuEvent"]));
		$dateEvent = $_POST["dateEvent"];
		$typeSport = 0;

		$stmt = MyPDO::getInstance()->prepare(<<<SQL
		SELECT MAX(idEvenement) as "id"
		FROM Evenement
	SQL);
		$stmt->execute();
		$NextIdEvent = $stmt->fetch()['id']+1;
	
		$newEvenenement = MyPDO::getInstance()->prepare(<<<SQL
	INSERT INTO evenement (idEvenement, idPublication, nbParticipantsMax, nom, lieu, dateEvenement, typeSport)
	VALUES (:idEvent, :idPublication, :nbParticipantsMax, :nom, :lieuEvent, STR_TO_DATE(:dateEvent,'%Y-%m-%d'),:typeSport)
SQL);
		$newEvenenement->execute([
			':idEvent'=>$NextIdEvent,
			':idPublication'=>$NextId,
			':nbParticipantsMax'=>$nbParticipantsMax,
			':nom'=>$nom,
			':lieuEvent'=>$lieuEvent,
			':dateEvent'=>$dateEvent,
			':typeSport'=>$typeSport
		]);
	}

    echo json_encode([
		':idEvent'=>$NextIdEvent,
		':idPublication'=>$NextId,
		':nbParticipantsMax'=>$nbParticipantsMax,
		':nom'=>$nom,
		':lieuEvent'=>$lieuEvent,
		':dateEvent'=>$dateEvent,
		':typeSport'=>$typeSport
	])
}
