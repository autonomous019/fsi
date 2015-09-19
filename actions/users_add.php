<?php

require_once("../config.inc.php");

session_start();

$first = $_REQUEST['first'];
$last = $_REQUEST['last'];
$email = $_REQUEST['email'];
$creator_id = $_REQUEST['creator_id'];
$user_type_id = $_REQUEST['user_type_id'];


$active = 0;
print_r($_FILES);
print_r($_REQUEST);

$file = $_FILES['file']['name'];
$temp_file = $_FILES['file']['tmp_name'];

$token = bin2hex(openssl_random_pseudo_bytes(3));

$data['creator_id'] = $creator_id;
$data['user_type_id'] = $user_type_id;
$data['first'] = $first;
$data['last'] = $last;
$data['email'] = $email;
$data['active'] = $active;
$data['avatar'] = $file;
$data['hasher'] = $token;



$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
$u = new Users('member', BASE_DOMAIN);	

$data['password'] = $u->setPassword($token);
//setPassword($password)

$update = $u->addUser($data);

$upload_dir = '/avatars/';
$upload_file = $u->uploader($file, $temp_file, $upload_dir);
	

?>