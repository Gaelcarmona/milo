<?php

$id = $_GET['id'];
$oUser = \appli\Repository\UserRepository::find($id);
$aUsers = appli\Repository\UserRepository::findByCreatorId($id);
$aDecks = appli\Repository\DeckRepository::findByUserId($id);
//ou :
// $oUser = Post::find( $_GET['id'] );
// $oChampionship = appli\Repository\ChampionshipRepository::findByUserId($id);
$aChampionships = appli\Repository\ChampionshipRepository::findByUserId($id);









//Chargement de la vue
echo $oUser->averagePointsByMatchByChampionship(4);
echo $oUser->averagePointsByMatch();
$title = $oUser->getPseudo();
$content = 'user';
include ROOT .'/views/template.phtml';