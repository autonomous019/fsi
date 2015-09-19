<?php

require_once("../config.inc.php");

session_start();

$uid = $_REQUEST['id'];
$info = $_REQUEST['info'];
$field_name = $_REQUEST['field_name'];


	$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
    $db->connect();
	$r = new Reports('member', BASE_DOMAIN);
	
	$update = $r->updateReportField($uid, $info, $field_name);
	
	
	
	
	
?>