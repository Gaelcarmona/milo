<?php
//charger les données
$oChampionship = new \appli\Entity\Championship();
$oUser = appli\Repository\UserRepository::find($_SESSION['id']);

$aUsers = appli\Repository\UserRepository::findByCreatorId($_SESSION['id']);
$classError = array(
    'title' => null
);
$oChampionship->setTitle( '' );

//Appeler la fonction de requête
if (!empty ( $_POST ) ){

    $oChampionship->setTitle( $_POST['title'] );
    $oChampionship->setUser( \appli\Repository\UserRepository::find((int) $_SESSION['id']) );
    $championshipId = appli\Repository\ChampionshipRepository::insert($oChampionship);
    var_dump($championshipId);


    foreach ($_POST['joueur'] as $joueurId) {
        $oUser = \appli\Repository\UserRepository::find($joueurId);

        $oUser_in_championship = new \appli\Entity\User_in_championship();
        $oUser_in_championship->setUser($oUser );

        $oUser_in_championship->setChampionship(\appli\Repository\ChampionshipRepository::find($championshipId));
        
        \appli\Repository\User_in_championshipRepository::insert($oUser_in_championship);
     }

        // header('Location:index.php?action=user&id='.$_SESSION['id']);
        header('Location:index.php?action=championship&championshipId='.$championshipId);
        
        exit;

 
}
//inclure la vue
$insertEditChampionship = 'Créer un championnat';
$content = 'edit_championship';
$title = 'Créer un championnat';
include ROOT .'/views/template.phtml';