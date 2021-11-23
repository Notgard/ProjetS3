<?php declare(strict_types = 1);
require_once "autoload.php";

$authentication = new SecureUserAuthentication();
$user = $authentication->getUser();

if(isset($_POST["idConversation"])){
    $conversation = new Conversation($_POST["idConversation"]);
    $messages = $conversation->getMessages();
	$page = "";
    foreach($messages as $k => $v){
        $texte = $v['texte'];
        $newtext = wordwrap($texte, 50, "<br />\r\n", true);
        $dateEnvoi = $v['dateEnvoi'];
        $userMessage = $v['user'];
		
        if($userMessage == $user) {
            $page .= <<<HTML
                <div class="border myMessage p-2 w-50">
                    <p>$newtext</p>
                    <p>$dateEnvoi</p>
                </div>
HTML;
        }
		else {
            $page .= <<<HTML
            <div class="border otherMessage p-2 w-50">
                <p>{$userMessage->getName()}</p>
                <p>$newtext</p>
                <p>$dateEnvoi</p>
            </div>
HTML;
        }
    }
	echo $page;
}