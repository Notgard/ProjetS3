<?php declare(strict_types = 1);
require_once "autoload.php";
$authentication = new SecureUserAuthentication();
if (!$authentication->isUserConnected()) {
	http_response_code(401);
    header("Location: connexion.php");
    die();
}

$authentication = new SecureUserAuthentication();
$user = $authentication->getUser();
$idUser = $user->getIdUser();
$firstName = $user->getFirstName();
$lastName = $user->getLastName();
$header = SportUtilities::getHeaderPage($user);

//Requêtes SQL
$recupUser = MyPDO::getInstance()->prepare(<<<SQL
            SELECT c.idConversation as "idConversation"
            FROM conversation c
            JOIN tchatter t ON (c.idConversation = t.idConversation)
            WHERE t.idUser = $idUser;
SQL);
$recupUser->execute();
$conversations = "";
foreach($recupUser->fetchAll() as $k){
    $conversation = new Conversation($k['idConversation']);
    $image = $conversation->getIdImage();
    $nom = $conversation->getNomConversation();
    $conversations .= <<<HTML
        <div class="flex-fill p-2 border mx-1 my-1 z-index-1" onclick="clickConversation(this);" id="{$conversation->getIdConversation()}">
            <img src="getImage.php?id=$image" width="70" height="70" title="$nom"> $nom
            <img src="img/icons/close.png" width="15" height="15" class="z-index-2 close" onclick="closeConversation(this);">
        </div>
HTML;
}
//Fin Requêtes SQL




//Création de la page
$page = new WebPage("Messages Privés");
$page->appendJsUrl("https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js");
$page->appendJsUrl("js/ajaxrequest.js");
$page->appendJsUrl("js/message.js");
$page->appendCssUrl("css/main.css");
$page->appendCssUrl("css/message.css");
$page->appendToHead(<<<HTML
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
HTML);

$page->appendContent(<<<HTML

$header



<div class="d-flex justify-content-center flex-row">
	<div class="d-flex flex-row w-75 h-100">
		<div class="d-flex flex-column h-25 w-25">
			<div class="d-flex border p-2 mx-1 my-1 flex-row">
				<div class="flex-fill p-2 mx-1 my-1">
					<p class="text-center">$firstName $lastName</p>
				</div>
				<div class="flex-fill p-2 mx-1 my-1" style="text-align: center;" onclick="nouvelleConversation();">
					<img src="img/editMessage.png" width="20" height="20" title="Nouveau message">
				</div>
			</div>

			<div class="d-flex flex-column h-100">
$conversations
            </div>
        </div>

        <div class="d-flex border flex-grow-1">
            <div id="div1" class="d-flex flex-grow-1 flex-column flex-fill p-2 border mx-1 my-1">
                <section id="section" class="container"></section>
				<div id="sendMessage">
					<form method="POST" id="messageForm" style="display:inline;">
						<input type="text" name="message" id="inputText" style="visibility: hidden;">
						<input type="submit" id="mySubmit" style="visibility: hidden;">
					</form>
				</div>
            </div>
        </div>
    </div>
</div>
HTML);

echo $page->toHTML();
