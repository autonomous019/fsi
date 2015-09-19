<?php

error_reporting(E_ALL);


define('BASE_DOMAIN', $_SERVER['HTTP_HOST']);

//database server
define('DB_SERVER', "fsi.afxcreates.com");


//database login name
define('DB_USER', "fsi_webuser");

//database login password
define('DB_PASS', "JBtzqt0VGWEkG!!");

//database name
define('DB_DATABASE', "fsi_production");

//paging settings
define('PAGING_RANGE', '10'); //sets number of records to display as default

//path to error logs
define('ERROR_LOGS', $_SERVER['DOCUMENT_ROOT']."actions/log/my-errors.log");

//path to stop logs
define('STOP_LOGS', getcwd()."log/error.log");

//site base
define('SITE_DOMAIN', 'http://www.afxcreates.com');
define('SITE_BASE',  "index.php");
define('BASE_DIR', "/");
define('PATH_TO_SITE', '/review/fsi_beta/');



//automation hash
define('AUTO_HASH', '4630e57ad5e4c8e59a5c9a0e9af7c34e');

//facebook settings
define('FB_APP_ID', '');
define('FB_APP_SECRET', '');
define('FB_NEXT_OUT', '');

//twitter settings
define('CONSUMER_KEY', '');
define('CONSUMER_SECRET', '');
define('OAUTH_CALLBACK', '');

//linkedin settings
define("LINKEDIN_CONSUMER_KEY", "");
define("LINKEDIN_SECRET", "");

//Google Analytics
//define("ANALYTICS_ID", "UA-33981194-1");

//Sendgrid Settings
/*
	    $user = 'fsi_dev';
	    $pass = 'Druid019!'; 
*/
define("SENDGRID_USER", 'fsi_dev'); //username for sendgrid API
define("SENDGRID_PASS", 'Druid019!'); //password for sendgrid API

/********** CLASSES ***************************************/
//required application classes
require("engine/classes/funcs.general.php");  //helper functions used by database class
require("engine/classes/Database.singleton.php");  //database class
require("engine/classes/class.booter.php"); //main application initialize booter and sys wide helper class

//modular classes
require("engine/classes/class.users.php"); //all things dealing with users
require("engine/classes/class.reports.php"); //all things dealing with reports
require("engine/classes/class.projects.php"); //all things dealing with reports



?>