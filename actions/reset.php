<?php
//reset password 
require_once("../config.inc.php");

$email = $_REQUEST['email'];
$my_id = $_REQUEST['my_id'];

print_r($_REQUEST);

//create token to send this is initial password
$token = bin2hex(openssl_random_pseudo_bytes(3));



$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();




$u = new Users('member', BASE_DOMAIN);	

$data['id'] = $my_id;
$data['email'] = $email;
$data['pwd_reset_code'] = $token;
$data['password'] = $u->setPassword($token);
$reset = $u->reset_password($data, $my_id);


?>