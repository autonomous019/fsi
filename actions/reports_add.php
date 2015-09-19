<?php

require_once("../config.inc.php");

session_start();

$name = $_REQUEST['name'];
$location = $_REQUEST['location'];
$client_id = $_REQUEST['client_id'];
$creator_id = $_REQUEST['creator_id'];
$description = $_REQUEST['description'];
$active = 1;
print_r($_FILES);
print_r($_REQUEST);

$file = $_FILES['file']['name'];
$temp_file = $_FILES['file']['tmp_name'];

$data['creator_id'] = $creator_id;
$data['client_id'] = $client_id;
$data['name'] = $name;
$data['location'] = $location;
$data['active'] = $active;
$data['description'] = $description;
$data['file_info'] = $file;

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
$r = new Reports('member', BASE_DOMAIN);	
$update = $r->addReport($data);

$upload_dir = '/reports/';
$upload_file = $r->uploader($file, $temp_file, $upload_dir);
	

?>