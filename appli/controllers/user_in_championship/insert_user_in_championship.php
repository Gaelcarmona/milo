<?php


$aUsers = appli\Repository\UserRepository::findByCreatorId($_SESSION['id']);
$oUser = appli\Repository\UserRepository::find($_SESSION['id']);
// var_dump($aUsers);
//ou :
// $oUser = Post::find( $_GET['id'] );
// $oChampionship = appli\Repository\ChampionshipRepository::findByUserId($id);
// $aChampionships = appli\Repository\ChampionshipRepository::findByUserId($id);



if (!empty ( $_POST ) ) {

    // var_dump($_POST);
    foreach ($_POST['joueur'] as $joueurId) {
       $oUser = \appli\Repository\UserRepository::find($joueurId);
       $oChampionship = \appli\Repository\ChampionshipRepository::find($_GET['championshipId']);
        $oUser_in_championship = new \appli\Entity\User_in_championship();
        $oUser_in_championship->setUser($oUser );
        $oUser_in_championship->setChampionship($oChampionship);
        
        \appli\Repository\User_in_championshipRepository::insert($oUser_in_championship);
    }
    header('Location:index.php?action=user&id='.$_SESSION['id']);
    exit; 
}





//Chargement de la vue
// $title = $oUser->getPseudo();
$content = 'edit_user_in_championship';
include ROOT .'/views/template.phtml';