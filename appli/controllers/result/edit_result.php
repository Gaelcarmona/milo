<?php
//charger les données

$id= array_key_exists('id', $_POST) ? $_POST['id']: $_GET['matchId'] ;
$oResult = appli\Repository\ResultRepository::find((int) $_GET['resultId']);
$aUsers = \appli\Repository\UserRepository::findAll();
$aPlayers = appli\Repository\PlayerRepository::findAll();
$aDecks = appli\Repository\DeckRepository::findAll();

$classError = array();

//Appeler la fonction de requête
if (!empty ( $_POST ) ){

    $oResult->setId( $_GET['resultId'] );
    $oResult->setPlace( $_POST['place'] );
    $oResult->setPlayer( \appli\Repository\PlayerRepository::find((int) $_POST['player']) );
    $oResult->setDeck( \appli\Repository\DeckRepository::find((int) $_POST['deck']) );
    $oResult->setChampionship( \appli\Repository\ChampionshipRepository::find((int) $_GET['championshipId']) );
    $oResult->setMatch( \appli\Repository\MatchRepository::find((int) $_GET['matchId']) );

    if (!in_array('is-invalid',$classError)) 
    {
        appli\Repository\ResultRepository::update($oResult);
        // header('Location:index.php?action=admin');
        header('Location:index.php?action=match&id='.$_GET['matchId']);
        exit;
    } 
}

$content = 'edit_result';
$insertEditResult = 'Modifier un résultat';
$title = 'Modifier un résultat';
include ROOT .'/views/template.phtml';