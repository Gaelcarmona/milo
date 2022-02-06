<?php
//charger les données

$id= array_key_exists('id', $_POST) ? $_POST['id']: $_GET['id'] ;
$oDeck = appli\Repository\DeckRepository::find((int) $id);
$aUsers = \appli\Repository\UserRepository::findAll();

$classError = array();

//Appeler la fonction de requête
if (!empty ( $_POST ) ){


    $oDeck->setTitle( $_POST['title'] );
    // $oDeck->setPlayer( \appli\Repository\PlayerRepository::find((int) $_POST['player']) );
    // Vérifier les champs requis

    if (!in_array('is-invalid',$classError)) 
    {
        appli\Repository\DeckRepository::update($oDeck);
        header('Location:index.php?action=user&id='.$_SESSION['id']);
        exit;
    } 
}

$content = 'edit_deck';
$insertEditDeck = 'Modifier un deck';
$title = 'Modifier un deck';
include ROOT .'/views/template.phtml';