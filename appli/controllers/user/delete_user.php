<?php

//Récupération de mon objet
$oUser = \appli\Repository\UserRepository::find( $_GET['id'] );

//Suppression de l'objet
\appli\Repository\UserRepository::delete($oUser);

//Redirection
if (isset($_SESSION['id'])) {
    # code...
    header('Location:index.php?action=user&id='.$_SESSION['id']);
}else {

    header('Location:index.php');
}
exit();