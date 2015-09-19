<?php

require_once("../config.inc.php");

session_start();

print_r($_FILES);
print_r($_REQUEST);


$name = $_REQUEST['cat_name'];
$slug = $_REQUEST['cat_slug'];
$file = $_FILES['cat_file']['name'];
$file_tmp = $_FILES['cat_file']['tmp_name'];


$data['name'] = $name;
$data['slug'] = $slug;
$data['icon'] = $file;


$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
$p = new Projects('member', BASE_DOMAIN);	
$update = $p->addCategory($data);

$upload_dir = '/projects_img/';
$upload_file = $p->uploader($file, $file_tmp, $upload_dir);


?>