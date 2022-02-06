<?php
//charger les données
$id = $_GET['championshipId'];
$oMatch = new \appli\Entity\Match();
$aChampionships = \appli\Repository\ChampionshipRepository::findAll();
$oUser = appli\Repository\UserRepository::find($_SESSION['id']);

// $aUsers = appli\Repository\User_in_championshipRepository::findByCreatorId($_SESSION['id']);

$aUser_in_championships = appli\Repository\User_in_championshipRepository::findByChampionshipId($id);
$classError = array(
    'title' => null
);
$oMatch->setTitle( '' );

//Appeler la fonction de requête
if (!empty ( $_POST ) ){

    $oMatch->setTitle( $_POST['title'] );
    $oMatch->setChampionship( \appli\Repository\ChampionshipRepository::find((int) $id) );

    $id = \appli\Repository\MatchRepository::insert($oMatch);



    // header('Location:index.php?action=match&id='.$id);
    header('Location:index.php?action=championship&championshipId='.$_GET['championshipId']);
    // header('Location:index.php?action=admin');
    exit;

   
}
//inclure la vue
$insertEditMatch = 'Créer un match';
$content = 'edit_match';
$title = 'Créer un match';
include ROOT .'/views/template.phtml';