<?php
//reset password 
require_once("../config.inc.php");

$email = $_REQUEST['email'];

//create token to send this is initial password
$token = bin2hex(openssl_random_pseudo_bytes(3));
$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();


//lookup user id by email address
$sql="SELECT `id`,`email` FROM `users` WHERE `email`='".$db->escape($email)."'";	
$result = $db->query_first($sql);
if(!empty($result['id'])){

    echo "Password Reset sent to your inbox.";
	$my_id = $result['id'];
  
	$u = new Users('member', BASE_DOMAIN);	
	$data['email'] = $email;
	$data['pwd_reset_code'] = $token;
	$data['password'] = $u->setPassword($token);
	$reset = $u->reset_password($data, $my_id);
	
	
	
} else {
	echo "Data Error, Email not found, you may not have ever registered or your email was changed in the system. Contact Support. ";
}





?>