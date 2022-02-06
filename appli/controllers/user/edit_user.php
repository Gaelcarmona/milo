<?php
//charger les données

$id= array_key_exists('id', $_POST) ? $_POST['id']: $_GET['id'] ;
$oUser = appli\Repository\UserRepository::find((int) $id);



//Appeler la fonction de requête


if (!empty ( $_POST ) ) {
    
    if ($_POST['password'] == $_POST['confirmpassword'])
     {
        
        
        $oUser->setPseudo( $_POST['pseudo'] );
        $oUser->setEmail( $_POST['email'] );
        $oUser->setPass(  password_hash($_POST['password'], PASSWORD_DEFAULT)   );  

        appli\Repository\UserRepository::update($oUser);
        // header('Location:index.php?action=connexion');
        header('Location:index.php?action=user&id='.$_SESSION['id']);
        exit;
 
    }
}




$content = 'edit_user';
$insertEditUser = 'Modifier un compte';
$title = 'Modifier un compte';
include ROOT .'/views/template.phtml';