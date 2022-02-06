<?php

//Récupération de mon objet
$oMatch = \appli\Repository\MatchRepository::find( $_GET['id'] );

//Suppression de l'objet
\appli\Repository\MatchRepository::delete($oMatch);

//Redirection
header('Location:?action=admin');
exit();