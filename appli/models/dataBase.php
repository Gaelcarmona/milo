<?php
require_once __DIR__.'/../../config/config.php';
function connect(){
    try {
        $pdo = new \PDO(
            'mysql:host=localhost;dbname='.DB_BASE.';charset=UTF8;port=3306',
            DB_USER,
            DB_PASS
        );
    }
    catch(PDOException $exception) {
        throw new Exception('Problème d\'acces à la base', 99);
    }
    $pdo -> setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_ASSOC);
    //On préférera masquer l'existence de la constante en PROD : on test si elle existe
    if (defined('DB_SQL_DEBUG')) {
        //Afficher les erreurs de requêtes : UNIQUEMENT EN DEV
        $pdo -> setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    return $pdo;
};