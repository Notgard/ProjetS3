<?php declare(strict_types = 1);
require_once "autoload.php";
$authentication = new SecureUserAuthentication();
$user = $authentication->getUser();

if (isset($_POST["selection"]) && isset($_POST["nomConv"]) && !empty($_POST["nomConv"])) {
    $stmt = MyPDO::getInstance()->prepare(<<<SQL
    SELECT MAX(idConversation) as "id"
    FROM Conversation
SQL);
    $stmt->execute();
    $NextId = $stmt->fetch()['id']+1;

    $newConv = MyPDO::getInstance()->prepare(<<<SQL
            INSERT INTO conversation (idConversation, nomConversation) VALUES (:idConversation, :texte)
SQL);
	$texte = nl2br(htmlspecialchars($_POST["nomConv"]));
    $newConv->execute([':texte'=>$texte,':idConversation'=>$NextId]);

    $add = MyPDO::getInstance()->prepare(<<<SQL
    INSERT INTO Tchatter (idUser, idConversation) VALUES (:idUser, :idConversation)
SQL);
	$add->execute([':idUser'=>$user->getIdUser(),':idConversation'=>$NextId]);
	
    foreach(explode(",",$_POST['selection']) as $k => $v){
        $add->execute([':idUser'=>$v,':idConversation'=>$NextId]);
    }
}
else {
	$recupFriend = MyPDO::getInstance()->prepare(<<<SQL
    SELECT use_idUser as "id"
    FROM avoir_en_ami
    WHERE idUser = :id
    SQL);
    $recupFriend->execute([":id" => $user->getIdUser()]);
$Friends = "";
foreach($recupFriend->fetchAll() as $k){
$Friend = User::createFromId($k['id']);
$image = $Friend->getIdImage();
$nom = $Friend->getName();
$Friends .= <<<HTML
    <div class="flex-fill p-2 border mx-1 my-1" onclick="addFriend(this);" id="{$Friend->getIdUser() }">
        <img src="getImage.php?id=$image" width="70" height="70" title="$nom"> $nom
    </div>
HTML;
}

$Friends .= <<<HTML
    <input id="nomConv" type="text" placeholder="Nom de la conversation">
    <button type="submit" onclick="validerConv();">Valider</button>
    <button type="submit" onclick="window.location.href = 'message.php';">Annuler</button>
HTML;

echo $Friends;
}
