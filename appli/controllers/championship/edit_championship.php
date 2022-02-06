<?php
//charger les données

$id= array_key_exists('id', $_POST) ? $_POST['id']: $_GET['id'] ;
$oChampionship = appli\Repository\ChampionshipRepository::find((int) $id);
$oUser = appli\Repository\UserRepository::find($_SESSION['id']);

$aUsers = appli\Repository\UserRepository::findByCreatorId($_SESSION['id']);
// $aUsers = \appli\Repository\UserRepository::findAll();

$classError = array();

//Appeler la fonction de requête
if (!empty ( $_POST ) ){


    $oChampionship->setTitle( $_POST['title'] );
    // $oChampionship->setUser( \appli\Repository\UserRepository::find((int) $_POST['user']) );
    // Vérifier les champs requis

    if (!in_array('is-invalid',$classError)) 
    {
        appli\Repository\ChampionshipRepository::update($oChampionship);
        header('Location:index.php?action=admin');
        exit;
    } 
}

$content = 'edit_championship';
$insertEditChampionship = 'Modifier un championnat';
$title = 'Modifier un championnat';
include ROOT .'/views/template.phtml';