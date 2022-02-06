<?php
//charger les données
$oUser = new \appli\Entity\User();

$classError = array(

'user' => null,
'mail' => null,
'password' => null
);

//Appeler la fonction de requête
if (!empty ( $_POST ) ) {
    // var_dump($_POST);

    if (($_POST['password'] == $_POST['confirmpassword'])
    && appli\Repository\UserRepository::findByEmailAndUsername($_POST['email'], $_POST['pseudo']) == NULL) {

        $oUser->setPseudo( $_POST['pseudo'] );
        $oUser->setEmail( $_POST['email'] );
        $oUser->setPass(  password_hash($_POST['password'], PASSWORD_DEFAULT)   );
        $oUser->setStatut( 1 );  
        // Vérifier les champs requis   
        appli\Repository\UserRepository::insert($oUser);
        header('Location:index.php?action=connexion');
        exit;
 
    }
}




//inclure la vue
$insertEditUser = 'Créer un compte';
$content = 'edit_user';
$title = 'Créer un compte';
include ROOT .'/views/template.phtml';