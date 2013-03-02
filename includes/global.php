<?php
	session_start();
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	ini_set('display_errors', 'On');
	ini_set('html_errors', 'On');

	//Global Variables
	$PRODUCTTITLE = "FuseBox";
	$PRODUCTVERSION = "1.0";
	$BASEPATH = "/Applications/MAMP/htdocs/fusebox/";
	$BASEURL = "http://localhost:8888/fusebox/";
	
	//Setup MySQL
	include($BASEPATH."includes/sfql.class.php");
	$DB = new SFQL("localhost","root","root","fusebox");
	
	//Setup Router
	include($BASEPATH."includes/router.class.php");
	$ROUTER = new Router();

	//Include User class
	include($BASEPATH."includes/user.class.php");
	$USER = new User();
	$USER->getSession();

?>
