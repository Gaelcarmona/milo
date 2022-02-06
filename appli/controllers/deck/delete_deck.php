<?php

//Récupération de mon objet
$oDeck = \appli\Repository\DeckRepository::find( $_GET['id'] );

//Suppression de l'objet
\appli\Repository\DeckRepository::delete($oDeck);

//Redirection
header('Location:?action=admin');
exit();