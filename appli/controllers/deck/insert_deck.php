<?php
//charger les données
$oDeck = new \appli\Entity\Deck();
$aUsers = \appli\Repository\UserRepository::findAll();
$classError = array(
    'title' => null
);
$oDeck->setTitle( '' );

//Appeler la fonction de requête
if (!empty ( $_POST ) ){

    $oDeck->setTitle( $_POST['title'] );
    $oDeck->setUser( \appli\Repository\UserRepository::find((int) $_GET['id'] ));

    // Vérifier les champs requis
    if (
        
        !in_array('is-invalid',$classError)) {
        $id = \appli\Repository\DeckRepository::insert($oDeck);
        // header('Location:index.php?action=deck&id='.$id);
        header('Location:index.php?action=user&id='.$_SESSION['id']);
        exit;

    }   
}
//inclure la vue
$insertEditDeck = 'Créer un deck';
$content = 'edit_deck';
$title = 'Créer un deck';
include ROOT .'/views/template.phtml';