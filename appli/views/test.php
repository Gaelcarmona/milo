<?php
$oDeveloper = new \appli\Entity\Developer();
$oYourCompany = \appli\Repository\CompanyRepository::find($id);
$oDeveloper->setJob( '' );

    if (  isHiring($oYourCompany->GetId())  == true) 
    {
        $oDeveloper->setJob( $oYourCompany );
        appli\Repository\DeveloperRepository::hiring($oDeveloper);
        header('Location:index.php?action=hired');
        exit;
    }   
$content = 'find_job';
$title = 'Trouver un travail';
include ROOT .'/views/template.phtml';


