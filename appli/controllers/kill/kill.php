<?php

$id = $_GET['id'];
$oKill = \appli\Repository\KillRepository::find($id);
// $aMatchs = appli\Repository\MatchRepository::findByKillId($id);
// $aKills = appli\Repository\KillRepository::findByKillId($id);
//ou :
// $oKill = Post::find( $_GET['id'] );



if (!array_key_exists ('id',$_GET)
OR (filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT)=== false)) {
    // echo 'Il faut séléctionner un post';
    //TODO : rediriger l'internaute (on le fera dans le tp)
    //Arreter le script
    header('Location:?action=admin');
    exit;
}





//Chargement de la vue
$title = $oKill->getResult();
$content = 'kill';
include ROOT .'/views/template.phtml';