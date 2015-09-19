<?php 
	
require_once("../config.inc.php");



if(!empty($_REQUEST['keyword'])){
	$keyword = $_REQUEST['keyword'];
} else {
	$keyword = "";
	
}

if(!empty($_REQUEST['field'])){
	$field = $_REQUEST['field'];
} else {
	$field = "";
}

if(!empty($_REQUEST['page_start'])){
	$page_start = $_REQUEST['page_start'];
} else {
	$page_start = "0";
	
}

if(!empty($_REQUEST['page_end'])){
	$page_end = $_REQUEST['page_end'];
} else {
	$page_end = "10";
}

if(!empty($_REQUEST['client_id'])){
	$keyword = $_REQUEST['client_id'];
	$field = 'client_id';
} else {
	$client_id = "";
}

	$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
    $db->connect();
	$r = new Reports('member', BASE_DOMAIN);

    $results = $r->search($keyword, $field, $page_start, $page_end);

print_r($results);  
//[{"id":"57","name":"dsdf","description":"sdf","location":"sdf","file_info":"mc_fsi_web_db_sow.pdf","active":"1","client_id":"86","creator_id":"0","created":"2015-09-03 14:44:56","modified":"2015-09-03 14:44:56"}


for ($x = 0; $x < count($results); $x++) {
    //echo "Name: ".$results[$x]['name']. " | Location: ".$results[$x]['location']. " | View: <a href=\"\" id=\"open_view\" >".$results[$x]['id']. "</a> <br /><br />";
	
	//craete string and parse with js in templates/search.php
	
	echo " ||| ".$results[$x]['name']."^".$results[$x]['location']."^".$results[$x]['id']." " ;
} 


	?>
