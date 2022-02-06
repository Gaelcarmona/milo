<?php

$id = $_GET['id'];
$oResult = \appli\Repository\ResultRepository::find($id);
// $aMatchs = appli\Repository\MatchRepository::findByResultId($id);
// $aResults = appli\Repository\ResultRepository::findByResultId($id);
//ou :
// $oResult = Post::find( $_GET['id'] );



if (!array_key_exists ('id',$_GET)
OR (filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT)=== false)) {
    // echo 'Il faut séléctionner un post';
    //TODO : rediriger l'internaute (on le fera dans le tp)
    //Arreter le script
    header('Location:?action=admin');
    
    exit;
}





//Chargement de la vue
$title = $oResult->getId();
$content = 'result';
include ROOT .'/views/template.phtml';