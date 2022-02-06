<?php

$id = $_GET['id'];
$oMatch = \appli\Repository\MatchRepository::find($id);
$aResults = appli\Repository\ResultRepository::findByMatchId($id);









//Chargement de la vue
$title = $oMatch->getTitle();
$content = 'match';
include ROOT .'/views/template.phtml';