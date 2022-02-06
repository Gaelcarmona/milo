<?php

$id = $_GET['id'];
$oDeck = \appli\Repository\DeckRepository::find($id);
$aResults = appli\Repository\ResultRepository::findByDeckId($id);
//ou :
// $oDeck = Post::find( $_GET['id'] );



if (!array_key_exists ('id',$_GET)
OR (filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT)=== false)) {
    // echo 'Il faut séléctionner un post';
    //TODO : rediriger l'internaute (on le fera dans le tp)
    //Arreter le script
    header('Location:?action=admin');
    exit;
}





//Chargement de la vue
$title = $oDeck->getTitle();
$content = 'deck';
include ROOT .'/views/template.phtml';