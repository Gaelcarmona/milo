<?php

//Récupération de mon objet
$oResult = \appli\Repository\ResultRepository::find( $_GET['id'] );

//Suppression de l'objet
\appli\Repository\ResultRepository::delete($oResult);

//Redirection
// header('Location:?action=admin');
header('Location:index.php?action=match&id='.$_GET['matchId']);
exit();