<?php
//charger les données

$id= array_key_exists('id', $_POST) ? $_POST['id']: $_GET['id'] ;
$oMatch = appli\Repository\MatchRepository::find((int) $id);
$aChampionships = \appli\Repository\ChampionshipRepository::findAll();

$classError = array();

//Appeler la fonction de requête
if (!empty ( $_POST ) ){


    $oMatch->setTitle( $_POST['title'] );
    // $oMatch->setChampionship( \appli\Repository\ChampionshipRepository::find((int) $_POST['championship']) );
    // Vérifier les champs requis

    if (!in_array('is-invalid',$classError)) 
    {
        appli\Repository\MatchRepository::update($oMatch);
        header('Location:index.php?action=admin');
        exit;
    } 
}

$content = 'edit_match';
$insertEditMatch = 'Modifier un match';
$title = 'Modifier un match';
include ROOT .'/views/template.phtml';