<?php

require_once("../config.inc.php");

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
$u = new Users('member', BASE_DOMAIN);


print_r($_FILES);
print_r($_REQUEST);

$first = $_REQUEST['first'];
$last = $_REQUEST['last'];
$email = $_REQUEST['email'];
$my_id = $_REQUEST['my_id'];
$avatar_name = $_REQUEST['avatar_name'];
//echo "settings uid is ".$my_id;

$password = $_REQUEST['password'];
if($password === ""){
	$password = NULL;
	//echo "i'm null!";
} else {
	$password = $_REQUEST['password'];
	//echo "i'm something not null";
}

$active = 1;

$token = bin2hex(openssl_random_pseudo_bytes(3));
$file = $_FILES['file']['name'];
$temp_file = $_FILES['file']['tmp_name'];
//$data['id'] = $my_id;
$data['first'] = $first;
$data['last'] = $last;
$data['email'] = $email;
$data['active'] = $active;
$data['hasher'] = $token;


if(is_null($password)){
	//do nothing
} else {
	//echo "i'm setting the password ".$password." ";
	$data['password'] = $u->setPassword($password); //otherwise don't touch password
	$data['pwd_reset_code'] = "";
	$u->update_password($data, $my_id);
	
	
}

if($file === ""){
	//do nothing
	$data['avatar'] = $avatar_name;
	$update = $u->update_setting($data, $my_id);
} else {
	$data['avatar'] = $file;
	echo "adding new avatar";
	$update = $u->update_setting($data, $my_id);
	$upload_dir = '/avatars/';
	$upload_file = $u->uploader($file, $temp_file, $upload_dir);
}

	

?>