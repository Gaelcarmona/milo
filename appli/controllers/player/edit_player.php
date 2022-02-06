<?php
//charger les données

$id= array_key_exists('id', $_POST) ? $_POST['id']: $_GET['id'] ;
$oPlayer = appli\Repository\PlayerRepository::find((int) $id);
$aUsers = \appli\Repository\UserRepository::findAll();

$classError = array();

//Appeler la fonction de requête
if (!empty ( $_POST ) ){


    $oPlayer->setPseudo( $_POST['pseudo'] );
    // $oPlayer->setUser( \appli\Repository\UserRepository::find((int) $_POST['user']) );
    // Vérifier les champs requis

    if (!in_array('is-invalid',$classError)) 
    {
        appli\Repository\PlayerRepository::update($oPlayer);
        header('Location:index.php?action=admin');
        exit;
    } 
}

$content = 'edit_player';
$insertEditPlayer = 'Modifier un joueur';
$title = 'Modifier un joueur';
include ROOT .'/views/template.phtml';