<?php
$sub_dir = "/review/fsi_beta/"; 

define("CONFIG_PATH", $_SERVER['DOCUMENT_ROOT'].$sub_dir."config.inc.php");
require(CONFIG_PATH);

//put in if view = admin go to /template/admin.php else /template/main.php

$session_name = session_name("fsi_web");
ini_set('session.cookie_domain', '.afxcreates.com');
session_start();

if(isset($_SESSION['my_id'])){
    $my_id = $_SESSION['my_id'];
} else {
    $my_id = '';
}

if(isset($_SESSION['role'])){
    $my_role = $_SESSION['role'];
} else {
    $my_role = '';
}

$my_user_id = $my_id;

if(isset($_SESSION['initialized'])){
    $initialized = $_SESSION['initialized'];
} else {
    $initialized = 'no';
}

if(isset($_SESSION['email'])){
    $reg_email = $_SESSION['email'];
} else {
    $reg_email = '';
}

if(isset($_REQUEST['story_id'])){
    $story_id = $_REQUEST['story_id'];
} else {
    $story_id = '0';
}

if(isset($_REQUEST['view'])){
    $view = $_REQUEST['view'];
} else {
    $view = 'main';
}


if($view === 'admin' || $view ==='reports' || $view === 'detail'){
	$view_template = 'admin';
	
} else {
	$view_template = 'main';
}

?>

<?php 
/*
	$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
    $db->connect();
	$u = new Users('member', BASE_DOMAIN, '' );
    $info = $u->getRegisterations();
    
    print_r($info);
    
*/


include_once("templates/".$view_template.".php");


?>





