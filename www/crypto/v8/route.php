<?php

	$version= "v8";

	require "class_configuration.php";
	$oConfig= new Class_configuration();
	$GLOBALS_INI= $oConfig->getGlobalsINI();
	//error_log("chemin : ". $GLOBALS_INI["PATH_HOME"] . $GLOBALS_INI["PATH_CLASS"] . $version . "/" . "database_v4.php");
	
	require $GLOBALS_INI["PATH_HOME"] . $GLOBALS_INI["PATH_CLASS"] . $version . "/" . "database_v4.php";
	$oBdd= new Class_database_v4();

	require $GLOBALS_INI["PATH_HOME"] . $GLOBALS_INI["PATH_CLASS"] . $version . "/" . "securite.php";
	$oForms= new Securite();
	$VARS_HTML= $oForms->getFormsAndSessionsVariables();

	$numero_de_connexion= $oBdd->connectBDD($GLOBALS_INI["DB_HOST"], $GLOBALS_INI["DB_NAME"], $GLOBALS_INI["DB_LOGIN"], $GLOBALS_INI["DB_PSW"]);
	
	$monPHP= $VARS_HTML["page"];
	$myClass= ucfirst($monPHP);

	require $GLOBALS_INI["PATH_HOME"] . $GLOBALS_INI["PATH_CLASS"] .  $version . "/" . $monPHP . ".php";
	$oMain= new $myClass();
	$resultat= $oMain->getAllResultats($numero_de_connexion, $oBdd, $GLOBALS_INI, $VARS_HTML);
	/*
	require $GLOBALS_INI["PATH_HOME"] . $GLOBALS_INI["PATH_CLASS"] .  $version . "/" . $monPHP . ".php";
	$resultat= getAllResultats($numero_de_connexion, $GLOBALS_INI, $VARS_HTML);
	*/
	$oBdd->disconnectBDD($numero_de_connexion);
	
	require $GLOBALS_INI["PATH_HOME"] . $GLOBALS_INI["PATH_FILES"] . $version . "/route.html";

?>




