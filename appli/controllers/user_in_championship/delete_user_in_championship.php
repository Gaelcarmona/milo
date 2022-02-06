<?php

//Récupération de mon objet
$oUser = \appli\Repository\User_in_championshipRepository::find( $_GET['id'] );

//Suppression de l'objet
\appli\Repository\User_in_championshipRepository::delete($oUser);

//Redirection
header('Location:?action=admin');
exit();