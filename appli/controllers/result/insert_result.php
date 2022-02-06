<?php
//charger les données
$oResult = new \appli\Entity\Result();
// $aUsers = appli\Repository\UserRepository::findByCreatorId($_SESSION['id']);
$aUsers = appli\Repository\User_in_championshipRepository::findByChampionshipId($_GET['championshipId']);
$aDecks = appli\Repository\DeckRepository::findAll();
// $aUsers = appli\Repository\UserRepository::findAll();
// $aChampionships = appli\Repository\ChampionshipRepository::findAll();
$aMatchs = appli\Repository\MatchRepository::findAll();
$classError = array(
    'title' => null
);
$oResult->setPlace( '' );

//Appeler la fonction de requête
if (!empty ( $_POST ) ){

    $oResult->setPlace( $_POST['place'] );
    $oResult->setUser( \appli\Repository\UserRepository::find((int) $_POST['user']) );
    $oResult->setDeck( \appli\Repository\DeckRepository::find((int) $_POST['deck']) );
    $oResult->setMatch( \appli\Repository\MatchRepository::find((int) $_GET['matchId']) );

    if ($_POST['place'] == 1) {
        $oResult->setScore( 7 );
    }elseif ($_POST['place'] == 2) {
        $oResult->setScore( 5 );
    }elseif ($_POST['place'] == 3) {
        $oResult->setScore( 3 );
    }elseif ($_POST['place'] == 4) {
        $oResult->setScore( 2 );
    }elseif ($_POST['place'] == 5) {
        $oResult->setScore( 1 );
    }elseif ($_POST['place'] == 6) {
        $oResult->setScore( 0 );
    }

    $id = \appli\Repository\ResultRepository::insert($oResult);

    header('Location:index.php?action=match&id='.$_GET['matchId']);
    exit;

  
}
//inclure la vue
$insertEditResult = 'Créer un résultat';
$content = 'edit_result';
$title = 'Créer un résultat';
include ROOT .'/views/template.phtml';