<?php
//charger les données

$id= array_key_exists('id', $_POST) ? $_POST['id']: $_GET['id'] ;
$oResult = appli\Repository\ResultRepository::find((int) $id);
$aUsers = \appli\Repository\UserRepository::findAll();

$classError = array();

//Appeler la fonction de requête
if (!empty ( $_POST ) ){


    $oResult->setTitle( $_POST['title'] );
    // $oResult->setUser( \appli\Repository\UserRepository::find((int) $_POST['user']) );
    // Vérifier les champs requis

    if (!in_array('is-invalid',$classError)) 
    {
        appli\Repository\ResultRepository::update($oResult);
        header('Location:index.php?action=admin');
        exit;
    } 
}

$content = 'edit_championship';
$insertEditResult = 'Modifier un championnat';
$title = 'Modifier un championnat';
include ROOT .'/views/template.phtml';