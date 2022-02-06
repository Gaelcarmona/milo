<?php

$id = $_GET['championshipId'];
$oChampionship = \appli\Repository\ChampionshipRepository::find($id);
$aMatchs = appli\Repository\MatchRepository::findByChampionshipId($id);
$aUser_in_championships = appli\Repository\User_in_championshipRepository::findByChampionshipId($id);
// $as = appli\Repository\Repository::findByChampionshipId($id);

//ou :
// $oChampionship = Post::find( $_GET['id'] );








//Chargement de la vue
$title = $oChampionship->getTitle();
$content = 'championship';
include ROOT .'/views/template.phtml';