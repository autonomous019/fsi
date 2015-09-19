<?php

require_once("../config.inc.php");

$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
if(!empty($_REQUEST['uid'])){
	$uid = $_REQUEST['uid'];
	
	
}
$mode = $_REQUEST['mode'];

print_r($_REQUEST);
if($mode === "reports"){
	
	$r = new Reports('member', BASE_DOMAIN);
	$delete = $r->delete($uid);
	
} elseif ($mode === "users") {
	
	$u = new Users('member', BASE_DOMAIN);
	$delete = $u->deleteUser($uid);
	
} elseif ($mode === "projects") {
	
	$uid = $_REQUEST['proj_delete_uid'];
	$p = new Projects('member', BASE_DOMAIN);
	$delete = $p->deleteProject($uid);
	
} elseif ($mode === "categories") {
	
	$uid = $_REQUEST['cat_delete_uid'];
	$p = new Projects('member', BASE_DOMAIN);
	$delete = $p->deleteCategory($uid);
	
}else {
	
	//nothing
}




	

		

?>