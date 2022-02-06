<?php

//charger les données

//Appler la fonction de requête


if (!empty ( $_POST ) )  {
   $oUser =  appli\Repository\UserRepository::findByUserPseudo($_POST['pseudo']);
   if ($oUser == NULL) {
   
       header('Location:index.php?action=connexion');
       exit;
   }

//    if ($_SESSION['username'] == 'admin') {
//        # code...
//    }

   if (password_verify($_POST['password'], $oUser->getPass())) {
    $_SESSION['username'] = $oUser->getPseudo();
    $_SESSION['id'] = $oUser->getId();
    header('Location:index.php?action=user&id='.$oUser->getId());
   }
}




//inclure la vue
$connexion = 'Accedez à votre compte';
$content = 'connexion';
$title = 'Accedez à votre compte';
include ROOT .'/views/template.phtml';