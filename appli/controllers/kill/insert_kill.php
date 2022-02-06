<?php
//charger les données

$oKill = new \appli\Entity\Kill();

// $aUsers = appli\Repository\User_in_championshipRepository::findByChampionshipId($_GET['championshipId']);
// $aUsers = appli\Repository\UserRepository::findByUserAndMatch($_POST['email'], $_POST['pseudo'])
$aUsers = appli\Repository\ResultRepository::findbyMatchId($_GET['matchId']);

$classError = array(
    'resultId' => null
);
$oKill->setResult(\appli\Repository\ResultRepository::find((int)$_GET['resultId']));
$oKill->setUser( \appli\Repository\UserRepository::find((int) $_GET['userId'] ));
// $oKill->setResult('');

//Appeler la fonction de requête
// var_dump($oKill);
if (!empty ( $_POST ) ){
    
    $oKill->setUser( \appli\Repository\UserRepository::find((int) $_POST['userKilled']) );
    // $oKill->setResult( \appli\Repository\ResultRepository::find((int) $_POST['id']) );
    
    // Vérifier les champs requis
    $id = \appli\Repository\KillRepository::insert($oKill);


    // header('Location:index.php?action=admin');
    header('Location:index.php?action=match&id='.$_GET['matchId']);
    
    exit;

  
}
//inclure la vue
$insertEditKill = 'Ajouter un joueur éliminé';
$content = 'edit_kill';
$title = 'Ajouter un joueur éliminé';
include ROOT .'/views/template.phtml';