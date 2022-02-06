<?php
//Auto-chargement de nos classes (autoload)
// on passe en parametre dite anonyme, (souvent appelée "callback")
spl_autoload_register(function (string $sClass){
        
        $sFilename = str_replace('\\','/', $sClass).'.php';
	require $sFilename;
        
        
});
// session_set_cookie_params([
//         ''=>,
// ]);
// starter la session

// caca
// caca2
session_start();

require_once __DIR__ . '/appli/models/dataBase.php';
$action = array_key_exists('action' , $_GET) ? $_GET['action'] : '' ;
// le switch case
try {
switch ($action) {
        case 'admin':
                include __DIR__ . '/appli/admin.php';
                break;
        case 'user':

                if(
                        !array_key_exists('id',$_GET) 
                        OR filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT) === false
                ){
                        //header('Location:admin.php');
                        //exit;

                        throw new Exception('Problème avec ID' , 8);
                }
                        include __DIR__ . '/appli/controllers/user/user.php';
                        break;
        case 'insert_user' :
                include __DIR__ . '/appli/controllers/user/insert_user.php';
                break;

        case 'edit_user' :
                //Vérifier les $id -> edit-post
                if( 
                        (!array_key_exists('id', $_GET) && !array_key_exists('id', $_POST) )
                        OR filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) === false 
                        OR filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) === false 
                ) {

                        throw new Exception('Problème avec ID' , 9);
                }
                include __DIR__ . '/appli/controllers/user/edit_user.php';
                break;
        case 'delete_user' :
                if(
                        !array_key_exists('id', $_GET)
                        OR filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT) === false
                ){
                        throw new Exception('Problème avec ID' , 10);
                }
                include __DIR__ . '/appli/controllers/user/delete_user.php';
                break;

        case 'deck':

                if(
                        !array_key_exists('id',$_GET) 
                        OR filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT) === false
                ){
                        //header('Location:admin.php');
                        //exit;

                        throw new Exception('Problème avec ID' , 11);
                }
                        include __DIR__ . '/appli/controllers/deck/deck.php';
                        break;
        case 'insert_deck' :
                include __DIR__ . '/appli/controllers/deck/insert_deck.php';
                break;

        case 'edit_deck' :
                //Vérifier les $id -> edit-post
                if( 
                        (!array_key_exists('id', $_GET) && !array_key_exists('id', $_POST) )
                        OR filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) === false 
                        OR filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) === false 
                ) {

                        throw new Exception('Problème avec ID' , 12);
                }
                include __DIR__ . '/appli/controllers/deck/edit_deck.php';
                break;
        case 'delete_deck' :
                if(
                        !array_key_exists('id', $_GET)
                        OR filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT) === false
                ){
                        throw new Exception('Problème avec ID' , 13);
                }
                include __DIR__ . '/appli/controllers/deck/delete_deck.php';
                break;

        case 'player':

                if(
                        !array_key_exists('id',$_GET) 
                        OR filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT) === false
                ){
                        //header('Location:admin.php');
                        //exit;

                        throw new Exception('Problème avec ID' , 14);
                }
                        include __DIR__ . '/appli/controllers/player/player.php';
                        break;
        case 'insert_player' :
                include __DIR__ . '/appli/controllers/player/insert_player.php';
                break;

        case 'edit_player' :
                //Vérifier les $id -> edit-post
                if( 
                        (!array_key_exists('id', $_GET) && !array_key_exists('id', $_POST) )
                        OR filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) === false 
                        OR filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) === false 
                ) {

                        throw new Exception('Problème avec ID' , 15);
                }
                include __DIR__ . '/appli/controllers/player/edit_player.php';
                break;
        case 'delete_player' :
                if(
                        !array_key_exists('id', $_GET)
                        OR filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT) === false
                ){
                        throw new Exception('Problème avec ID' , 16);
                }
                include __DIR__ . '/appli/controllers/player/delete_player.php';
                break;

        case 'championship':

                if(
                        !array_key_exists('championshipId',$_GET) 
                        OR filter_input(INPUT_GET,'championshipId',FILTER_VALIDATE_INT) === false
                ){
                        //header('Location:admin.php');
                        //exit;

                        throw new Exception('Problème avec ID' , 17);
                }
                        include __DIR__ . '/appli/controllers/championship/championship.php';
                        break;
        case 'insert_championship' :
                include __DIR__ . '/appli/controllers/championship/insert_championship.php';
                break;

        case 'edit_championship' :
                //Vérifier les $id -> edit-post
                if( 
                        (!array_key_exists('id', $_GET) && !array_key_exists('id', $_POST) )
                        OR filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) === false 
                        OR filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) === false 
                ) {

                        throw new Exception('Problème avec ID' , 18);
                }
                include __DIR__ . '/appli/controllers/championship/edit_championship.php';
                break;
        case 'delete_championship' :
                if(
                        !array_key_exists('id', $_GET)
                        OR filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT) === false
                ){
                        throw new Exception('Problème avec ID' , 19);
                }
                include __DIR__ . '/appli/controllers/championship/delete_championship.php';
                break;

        case 'match':

                if(
                        !array_key_exists('id',$_GET) 
                        OR filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT) === false
                ){
                        //header('Location:admin.php');
                        //exit;

                        throw new Exception('Problème avec ID' , 20);
                }
                        include __DIR__ . '/appli/controllers/match/match.php';
                        break;
        case 'insert_match' :
                include __DIR__ . '/appli/controllers/match/insert_match.php';
                break;

        case 'edit_match' :
                //Vérifier les $id -> edit-post
                if( 
                        (!array_key_exists('id', $_GET) && !array_key_exists('id', $_POST) )
                        OR filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) === false 
                        OR filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) === false 
                ) {

                        throw new Exception('Problème avec ID' , 21);
                }
                include __DIR__ . '/appli/controllers/match/edit_match.php';
                break;
        case 'delete_match' :
                if(
                        !array_key_exists('id', $_GET)
                        OR filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT) === false
                ){
                        throw new Exception('Problème avec ID' , 22);
                }
                include __DIR__ . '/appli/controllers/match/delete_match.php';
                break;


        case 'result':

                if(
                        !array_key_exists('id',$_GET) 
                        OR filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT) === false
                ){
                        //header('Location:admin.php');
                        //exit;

                        throw new Exception('Problème avec ID' , 23);
                }
                        include __DIR__ . '/appli/controllers/result/result.php';
                        break;
        case 'insert_result' :
                include __DIR__ . '/appli/controllers/result/insert_result.php';
                break;

        case 'edit_result' :
                //Vérifier les $id -> edit-post
                if( 
                        (!array_key_exists('matchId', $_GET) && !array_key_exists('id', $_POST) )
                        OR filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) === false 
                        OR filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) === false 
                ) {

                        throw new Exception('Problème avec ID' , 24);
                }
                include __DIR__ . '/appli/controllers/result/edit_result.php';
                break;
        case 'delete_result' :
                if(
                        !array_key_exists('id', $_GET)
                        OR filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT) === false
                ){
                        throw new Exception('Problème avec ID' , 25);
                }
                include __DIR__ . '/appli/controllers/result/delete_result.php';
                break;


        case 'kill':

                if(
                        !array_key_exists('id',$_GET) 
                        OR filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT) === false
                ){
                        //header('Location:admin.php');
                        //exit;

                        throw new Exception('Problème avec ID' , 26);
                }
                        include __DIR__ . '/appli/controllers/kill/kill.php';
                        break;
        case 'insert_kill' :
                include __DIR__ . '/appli/controllers/kill/insert_kill.php';
                break;

        case 'edit_kill' :
                //Vérifier les $id -> edit-post
                if( 
                        (!array_key_exists('id', $_GET) && !array_key_exists('id', $_POST) )
                        OR filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) === false 
                        OR filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) === false 
                ) {

                        throw new Exception('Problème avec ID' , 27);
                }
                include __DIR__ . '/appli/controllers/kill/edit_kill.php';
                break;
        case 'delete_kill' :
                if(
                        !array_key_exists('resultId', $_GET)
                        OR filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT) === false
                ){
                        throw new Exception('Problème avec ID' , 28);
                }
                include __DIR__ . '/appli/controllers/kill/delete_kill.php';
                break;
        case 'connexion' :
                include __DIR__ . '/appli/connexion.php';
                break;

        case 'user_in_championship':

                if(
                        !array_key_exists('id',$_GET) 
                        OR filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT) === false
                ){
                        //header('Location:admin.php');
                        //exit;

                        throw new Exception('Problème avec ID' , 29);
                }
                        include __DIR__ . '/appli/controllers/user_in_championship/user_in_championship.php';
                        break;
        case 'insert_user_in_championship' :
                include __DIR__ . '/appli/controllers/user_in_championship/insert_user_in_championship.php';
                break;

        case 'edit_user_in_championship' :
                //Vérifier les $id -> edit-post
                if( 
                        (!array_key_exists('id', $_GET) && !array_key_exists('id', $_POST) )
                        OR filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) === false 
                        OR filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) === false 
                ) {

                        throw new Exception('Problème avec ID' , 30);
                }
                include __DIR__ . '/appli/controllers/user_in_championship/edit_user_in_championship.php';
                break;
        case 'delete_user_in_championship' :
                if(
                        !array_key_exists('id', $_GET)
                        OR filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT) === false
                ){
                        throw new Exception('Problème avec ID' , 31);
                }
                include __DIR__ . '/appli/controllers/user_in_championship/delete_user_in_championship.php';
                break;

        case 'disconnect':
                session_destroy();
                $_SESSION = [];
                include __DIR__ . '/appli/home.php';
                break;













        // case '404' :
        //         include __DIR__ . '/appli/404.php';
        //         break;

        default:
                include __DIR__ . '/appli/home.php';
                break;
        }

        
}

catch(Exception $exception){
        echo $exception -> getMessage();
        echo $exception -> getCode();
        $code = $exception -> getCode();

        switch($code){
                case 10 :
                        require __DIR__  . '/appli/home.php';
                        break;
                case 11 :
                        header('Location:?action=404');
                        break;
                case 15 : 
                        require __DIR__ . '/appli/admin.php';
                        break;
                        
                // case 99 :
                //         header('Location:?action=404&code=503');
                //         break;
        }
}
// include ROOT .'/views/template.phtml';
