<?php

/* Debugging */

ini_set("display_errors",true);

/* Timezone */

date_default_timezone_set("America/Montreal");

/* Defines */

define("DB","mysql:host=localhost,dbname=derpcms");
define("DB_USERNAME","root");
define("DB_PASSWORD","sephiroth");
define("CLASS_PATH","classes");
define("TEMPLATE_PATH","template");
define("HOMEPAGE_NUM_ARTICLES",5);
define("ADMIN_USERNAME","admin");
define("ADMIN_PASSWORD",readfile("adminhash"));

/* Include Classes */

require(CLASS_PATH."/Article.php");

/* Define Exception Handler */

function handleException($exception){
	echo "Sorry, a problem has occured, try again later!";
	error_log($exception->getMessage());
}

/* Set Exception Handler */
/* Incase a try block is missed  */
set_exception_handler('handleException');
