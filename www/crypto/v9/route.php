<?php

	$version= "v9";

	require "class_configuration.php";
	$oConfig= new Class_configuration();
	$GLOBALS_INI= $oConfig->getGlobalsINI();
	
	require $GLOBALS_INI["PATH_HOME"] . $GLOBALS_INI["PATH_CLASS"] . $version . "/" . "database_v4.php";
	$oBdd= new Class_database_v4($GLOBALS_INI["DB_HOST"], $GLOBALS_INI["DB_NAME"], $GLOBALS_INI["DB_LOGIN"], $GLOBALS_INI["DB_PSW"]);

	require $GLOBALS_INI["PATH_HOME"] . $GLOBALS_INI["PATH_CLASS"] . $version . "/" . "securite.php";
	$oForms= new Securite();
	
	$monPHP= $oForms->VARS_HTML["page"];
	$myClass= ucfirst($monPHP);

	require $GLOBALS_INI["PATH_HOME"] . $GLOBALS_INI["PATH_CLASS"] .  $version . "/" . $monPHP . ".php";
	$oMain= new $myClass();
	$resultat= $oMain->getAllResultats($oBdd, $GLOBALS_INI, $oForms->VARS_HTML);

	unset($oBdd);
	
	require $GLOBALS_INI["PATH_HOME"] . $GLOBALS_INI["PATH_FILES"] . $version . "/route.html";

	unset($oForms);
	
	unset($oConfig);
	
	unset($oMain);
?>




