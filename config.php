<?php

/* Debugging */

ini_set("display_errors",true);

/* Timezone */

date_default_timezone_set("America/Montreal");

/* Defines */

define("DB","mysql:host=localhost;dbname=derpcms");
define("DB_USERNAME","root");
define("DB_PASSWORD","sephiroth");
define("MODELS_PATH","classes");
define("TEMPLATE_PATH","templates");
define("HOMEPAGE_NUM_ARTICLES",5);
define("ADMIN_USERNAME","admin");
define("ADMIN_PASSWORD",
"b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86");

/* Include Models */

require(MODELS_PATH."/Project.model.php");

/* Define Exception Handler */

function handleException($exception){
	echo "Sorry, a problem has occured, try again later!";
	error_log($exception->getMessage());
}

/* Set Exception Handler */
/* Incase a try block is missed  */
set_exception_handler('handleException');
