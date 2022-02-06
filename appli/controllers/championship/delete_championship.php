<?php

//Récupération de mon objet
$oChampionship = \appli\Repository\ChampionshipRepository::find( $_GET['id'] );

//Suppression de l'objet
\appli\Repository\ChampionshipRepository::delete($oChampionship);

//Redirection

header('Location:index.php?action=user&id='.$_SESSION['id']);
exit();