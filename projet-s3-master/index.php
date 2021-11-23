<?php declare(strict_types=1);
require_once "autoload.php";
$authentication = new SecureUserAuthentication();
if (!$authentication->isUserConnected()) {
	http_response_code(401);
    header("Location: connexion.php");
    die();
}
$p = new WebPage("Page d'accueil");
$p->appendJsUrl("js/ajaxrequest.js");
$p->appendJsUrl("https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js");
$p->appendJsUrl("js/main.js");
$p->appendCssUrl("css/main.css");
$p->appendToHead(<<<HTML
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&display=swap" rel="stylesheet" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="./css/main.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
HTML);

$user = $authentication->getUser();
$header = SportUtilities::getHeaderPage($user);

$p->appendContent(<<<HTML
<div class="overlay" id="overlay">
		<button class="btn close-overlay"><img src="./img/icons/close.png"></button>
</div>
$header
<div class="d-flex flex-row main-categories">
	<div class="d-flex flex-column scroll-item m-3">
		<img src="img/Volley-ball.png" class="scroll-item-img" alt="Icon catégorie">
		<div class="scroll-item-title">Volleyball</div>
	</div>
	<div class="d-flex flex-column scroll-item m-3">
		<img src="img/basket.jpg" class="scroll-item-img" alt="Icon catégorie">
		<div class="scroll-item-title">Basketballl</div>
	</div>
	<div class="d-flex flex-column scroll-item m-3">
		<img src="img/soccer.jpg" class="scroll-item-img" alt="Icon catégorie">
		<div class="scroll-item-title">Soccer</div>
	</div>
	<div class="d-flex flex-column scroll-item m-3">
		<img src="img/bowling.jpg" class="scroll-item-img" alt="Icon catégorie">
		<div class="scroll-item-title">Bowling</div>
	</div>
	<div class="d-flex flex-column scroll-item m-3">
		<img src="img/badminton.png" class="scroll-item-img" alt="Icon catégorie">
		<div class="scroll-item-title">Badminton</div>
	</div>
	<div class="d-flex flex-column scroll-item m-3">
		<img src="img/run.jpg" class="scroll-item-img" alt="Icon catégorie">
		<div class="scroll-item-title">Course à pied</div>
	</div>
	<div class="d-flex flex-column scroll-item m-3">
		<img src="img/muscle.jpg" class="scroll-item-img" alt="Icon catégorie">
		<div class="scroll-item-title">Musculation</div>
	</div>
	<div class="d-flex flex-column scroll-item m-3">
		<img src="img/dance.jfif" class="scroll-item-img" alt="Icon catégorie">
		<div class="scroll-item-title">Danse</div>
	</div>
	<div class="d-flex flex-column scroll-item m-3">
		<img src="img/lutte.jpg" class="scroll-item-img" alt="Icon catégorie">
		<div class="scroll-item-title">Lutte</div>
	</div>
	<div class="d-flex flex-column scroll-item m-3">
		<img src="img/Boxe.png" class="scroll-item-img" alt="Icon catégorie">
		<div class="scroll-item-title">Boxe</div>
	</div>
	<div class="d-flex flex-column scroll-item m-3">
		<img src="img/rugby.jfif" class="scroll-item-img" alt="Icon catégorie">
		<div class="scroll-item-title">Rugby</div>
	</div>
	<div class="d-flex flex-column scroll-item m-3">
		<img src="img/climb.png" class="scroll-item-img" alt="Icon catégorie">
		<div class="scroll-item-title">Escalade</div>
	</div>
</div>
<div class="d-flex flex-row m-3 main-content-wrapper">
	<div class="d-flex flex-column mt-5 addPost">
		<div class="collaped-container fixed-bottom m-5 p-2">
			<div id="collapse1" class="collapse dropped">
				<ul>
					<li><a class="drop-item" onclick="newPost();" id="drop-item-newPost">New Post</a></li>
					<hr class="sep">
					<li><a class="drop-item" onclick="" id="drop-item-newMessage">Send a message</a></li>
				</ul>
			</div>
			<button class="dropped-button collapsed" id="new-post" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve" width="90px" height="90px">
					<g><path d="M984.1,122.3C946.5,84.5,911.4,42.1,867.8,11c-40-8.3-59.2,34.9-86.7,55.1c46.4,53.9,100.5,101.5,150.4,152.5C954.1,191.7,1007.7,164.1,984.1,122.3z M959.3,325.9c-31.7,31.8-64.5,62.8-95.1,95.8c-0.8,127.5,0.3,255-0.4,382.6c-0.6,47-41.8,88.7-88.8,90.3c-193.4,0.8-387,0.8-580.4,0.1c-52.2-1.4-94-51.4-89.9-102.7c-0.1-184.6-0.1-369.1,0-553.5c-4-51.1,38-100.3,89.6-102.1c128.1-1.7,256.3,0.1,384.3-0.9c33.2-30,63.9-62.9,95.7-94.5c-170.6,0-341-0.9-511.6,0.5c-79.6,1.4-151,71-152.4,151C10.1,407.7,9.5,622.8,10.7,838c0.3,77.5,66.1,144.7,142.4,152h670.2c72.3-12.7,134.3-75.8,135.2-150.9C960.7,668.1,959,496.9,959.3,325.9z M908.2,242.2C858,191.7,807.4,141.5,756.6,91.5C645.4,201.9,534,312,423.4,423c50.1,50.4,100.4,100.6,151.3,150.3C686,463.1,797.2,352.6,908.2,242.2z M341.2,654.6c68.1-18.5,104.4-30.2,172.5-48.5c18.2-5.8,30.3-9.3,39.7-13c-48.2-45.9-103.6-102.5-151.7-148.8C381.4,514.4,361.4,584.5,341.2,654.6z" /></g>
				</svg>
			</button>
		</div>
	</div>
HTML);

$search = "";
if (isset($_GET["search"])) {
	$search = $_GET["search"];
}
$users = "";
if ($search != "")
	$users = SportUtilities::getUsers($search);
$posts = SportUtilities::getPublications($search);

$p->appendContent(<<<HTML
<div class="main-post" id="listePublications">
$users
$posts
	<div class="post-user">
		Plus aucune publication
	</div>
</div>
<div class="d-flex flex-column m-3 mt-5 recommended">
	<p>
		Les utilisateurs qui veulent participer à votre activité de <span class="recommendation-name">Bowling</span>
	</p>
	<hr class="sep">
	<div class="recommended-user">
		<div class="invite-wrapper">
			<img src="img/pfp/default-avatar.png" class="recommended-user-img">
			Fabrice51
			<a href="#" class="friend-accept p-3">Accepter</a>
		</div>
	</div>
	<div class="recommended-user">
		<div class="invite-wrapper">
			<img src="img/pfp/default-avatar.png" class="recommended-user-img">
			Fabrice51
			<a href="#" class="friend-accept p-3">Accepter</a>
		</div>
	</div>
	<div class="recommended-user">
		<div class="invite-wrapper">
			<img src="img/pfp/default-avatar.png" class="recommended-user-img">
			Fabrice51
			<a href="#" class="friend-accept p-3">Accepter</a>
		</div>
	</div>
	<div class="recommended-user">
		<div class="invite-wrapper">
			<img src="img/pfp/default-avatar.png" class="recommended-user-img">
			Fabrice51
			<a href="#" class="friend-accept p-3">Accepter</a>
		</div>
	</div>
</div>
HTML);

echo $p->toHTML();
