<?php

//Récupération de mon objet
$oKill = \appli\Repository\KillRepository::find($_GET['resultId'], $_GET['playerId'] );

// $oKill->setResult(\appli\Repository\ResultRepository::find((int)$_GET['resultId']));
// $oKill->setPlayer( \appli\Repository\PlayerRepository::find((int) $_GET['playerId'] ));
// var_dump($oKill);
//Suppression de l'objet
\appli\Repository\KillRepository::delete($oKill);

//Redirection
// header('Location:?action=admin');
header('Location:index.php?action=match&id='.$_GET['matchId']);
exit();