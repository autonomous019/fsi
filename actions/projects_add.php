<?php

require_once("../config.inc.php");

session_start();

$name = $_REQUEST['name'];
$other = $_REQUEST['other'];
$description = $_REQUEST['description'];
$active = 1;
$cat_id = $_REQUEST['cat_id'];
print_r($_FILES);
print_r($_REQUEST);

$vert_file = $_FILES['file']['name'];
$vert_file_tmp = $_FILES['file']['tmp_name'];

$bg_file = $_FILES['bg_file']['name'];
$bg_file_tmp = $_FILES['bg_file']['tmp_name'];


$data['name'] = $name;
$data['other'] = $other;
$data['active'] = $active;
$data['description'] = $description;
$data['vertical_img'] = $vert_file;
$data['bg_img'] = $bg_file;
$data['project_category_id'] = $cat_id;

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
$r = new Projects('member', BASE_DOMAIN);	
$update = $r->addProject($data);

$upload_dir = '/projects_img/';
$upload_vert_file = $r->uploader($vert_file, $vert_file_tmp, $upload_dir);
$upload_bg_file = $r->uploader($bg_file, $bg_file_tmp, $upload_dir);	

?>