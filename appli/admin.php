<?php

//Appeler la fonction de requête
if ($_SESSION['username'] == 'admin') {

    $aUsers = appli\Repository\UserRepository::findAll();
    
    $aChampionships = appli\Repository\ChampionshipRepository::findAll();
    $aMatchs = appli\Repository\MatchRepository::findAll();
    
    //Vue
    
    $content = 'admin';
    $title = 'Tableau de bord';
    include __DIR__.'./views/template.phtml';
}else {
    header('Location:index.php?action=connexion');
}
