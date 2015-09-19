<?php

require_once("../config.inc.php");

session_start();
print_r($_REQUEST);
print_r($_FILES);

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();


$mode = $_REQUEST['mode'];


if($mode === "reports"){
	$file = $_FILES['file']['name'];
	$temp_file = $_FILES['file']['tmp_name'];
	$uid = $_REQUEST['uid'];
	$upload_dir = '/reports/';
	$r = new Reports('member', BASE_DOMAIN);
	$upload_file = $r->uploader($file, $temp_file, $upload_dir);
	$update = $r->updateReportField($uid, $file, 'file_info');
	
} elseif ($mode === "users") {
	$file = $_FILES['file']['name'];
	$temp_file = $_FILES['file']['tmp_name'];
	$uid = $_REQUEST['uid'];
	$upload_dir = '/avatars/';
	$u = new Users('member', BASE_DOMAIN);
	$upload_file = $u->uploader($file, $temp_file, $upload_dir);
	$update = $u->updateUserField($uid, $file, 'avatar');
	
} elseif ($mode === "projects") {
	

	
	$uid = $_REQUEST['uid'];
	
	if(!empty($_FILES['vertical_img']['name'])){
		$vertical_file = $_FILES['vertical_img']['name'];
		$vertical_temp_file = $_FILES['vertical_img']['tmp_name'];
	} else {
		$vertical_file = "";
	}
	
	if(!empty($_FILES['bg_img']['name'])){
		$bg_file = $_FILES['bg_img']['name'];
		$bg_temp_file = $_FILES['bg_img']['tmp_name'];
	} else {
		$bg_file = "";
	}
	
	
	
	
	$upload_dir = '/projects_img/';
	
	if(!empty($bg_file)){
		//process bg
		$p = new Projects('member', BASE_DOMAIN);
		$upload_file = $p->uploader($bg_file, $bg_temp_file, $upload_dir);
		$update = $p->updateProjectField($uid, $bg_file, 'bg_img');
		
	}
	
	if(!empty($vertical_file)){
		//process vertical
		$p = new Projects('member', BASE_DOMAIN);
		$upload_file = $p->uploader($vertical_file, $vertical_temp_file, $upload_dir);
		$update = $p->updateProjectField($uid, $vertical_file, 'vertical_img');
		
	}
	
	

} elseif ($mode === "categories") {

	$file = $_FILES['cat_file']['name'];
	$temp_file = $_FILES['cat_file']['tmp_name'];
	$uid = $_REQUEST['cat_uid'];
	
	$upload_dir = '/projects_img/';
	$p = new Projects('member', BASE_DOMAIN);
	$upload_file = $p->uploader($file, $temp_file, $upload_dir);
	$update = $p->updateCategoryField($uid, $file, 'icon');
	
} else {
	
	//nothing
}




	

		

?>