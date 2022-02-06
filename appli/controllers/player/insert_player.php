<?php
//charger les données
$oUser = new \appli\Entity\User();
$classError = array(
    'pseudo' => null
);
$oUser->setPseudo( '' );



//Appeler la fonction de requête
if (!empty ( $_POST ) ){

    $oUser->setPseudo( $_POST['pseudo'] );
    $oUser->setStatut( 0 );
    $oUser->setPass( '' );
    $oUser->setCreatorId( $_SESSION['id'] );


    // Vérifier les champs requis
    if (
        
        !in_array('is-invalid',$classError)) {
        $id = \appli\Repository\UserRepository::insert($oUser);
        // header('Location:index.php?action=user&id='.$id);
        header('Location:index.php?action=user&id='.$_SESSION['id']);
        exit;

    }   
}
//inclure la vue
$insertEditPlayer = 'Créer un joueur';
$content = 'edit_player';
$title = 'Créer un joueur';
include ROOT .'/views/template.phtml';