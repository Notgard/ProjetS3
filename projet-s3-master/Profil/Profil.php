<?php 
declare(strict_types=1);
require_once"autoload.php";

//if (!$authentication->isUserConnected()) {
   // http_response_code(401);
   // header("Location: connexion.php");
    //die();
//}

$p = new WebPage("Page de profil");
//$p->appendJsUrl("js/ajaxrequest.js");
$p->appendCssUrl("css/Profil.css");
$p->appendJsUrl("js/Profil.js");

$p->appendToHead(<<<HTML

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
HTML
);

//$user = $authentication->getUser();
//$header = SportUtilities::getHeaderPage($user);


$p->appendContent(<<<HTML
<!-- Haut de page (recherche) -->
<div class="d-flex flex-row"> 
    <h1>Comming soon</h1>
</div>


<div class="d-flex flex-column">

    <!-- première partie de la page de profil (photo bio... -->
    <div class="d-flex flex-row flex-grow-1 p-2 ">
        <div class="profile d-flex flex-column m-5 flex-grow-1">
            <img src="https://images.rtl.fr/~c/770v513/rtl/www/1455487-l-essayiste-et-journaliste-politique-eric-zemmour-assiste-a-la-table-ronde-publicite-et-famille-lors-du-quatrieme-sommet-demographique-a-budapest-le-24-septembre-2021.jpg">
        </div>

        <div class="d-flex flex-column m-2 flex-grow-1">
            <div class="d-flex flex-row m-2 ">
                <div class="Pseudo d-flex flex-row m-2 ">
                    <p>Zemour<p>
                </div>
                <div class="Statut-e d-flex flex-row m-3 border p-1">
                    <p>Coach<p>
                </div>
                <div class="Modif-pro d-flex flex-row m-3 border p-1">
                    <p>Modifier le profil<p>
                </div>
                <div class="Settings d-flex flex-row m-2">
                    <img src="img/settings.png" >
                </div>
            </div>

            <div class="d-flex flex-row m-2">
                <div class="Publication d-flex flex-row m-2 ">
                    <p> 3 publications<p>
                </div>
                <div class="Amies d-flex flex-row m-2 ">
                    <p>666 Amies<p>
                </div>
            </div>

            <div class="Bio d-flex flex-row m-2">
                <p>Je suis quelqu’un de très sportif , j’aime l’équipe de France.<p>
            </div>
        </div> 
    </div>
    <!-- barre de pagination -->
    <hr>
    <div class="d-flex flex-grow-1 p-2 justify-content-center">
        <nav>
            <a href="#" class="nav-item" data-active-color="grey" data-target="Publication">Publication</a>
            <a href="#" class="nav-item" data-active-color="blue" data-target="Vidéos">Vidéos</a>
            <a href="#" class="nav-item" data-active-color="red" data-target="Amies">Amies</a>
            <span class="nav-indicator"></span>
        </nav>
    </div>
</div>

HTML);


echo $p->toHTML();