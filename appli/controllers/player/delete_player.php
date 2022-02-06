<?php

//Récupération de mon objet
$oPlayer = \appli\Repository\PlayerRepository::find( $_GET['id'] );

//Suppression de l'objet
\appli\Repository\PlayerRepository::delete($oPlayer);

//Redirection
header('Location:?action=admin');
exit();