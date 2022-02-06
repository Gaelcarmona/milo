<?php

$id = $_GET['id'];
$oUser = \appli\Repository\UserRepository::find($id);
$aDecks = appli\Repository\DeckRepository::findByUserId($id);
// $aResults = appli\Repository\ResultRepository::findByUserId($id);
//ou :
// $oUser = Post::find( $_GET['id'] );



if (!array_key_exists ('id',$_GET)
OR (filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT)=== false)) {
    // echo 'Il faut séléctionner un post';
    //TODO : rediriger l'internaute (on le fera dans le tp)
    //Arreter le script
    header('Location:?action=admin');
    exit;
}





//Chargement de la vue
$title = $oUser->getPseudo();
$content = 'player';
include ROOT .'/views/template.phtml';