<?php
class liste_crypto {
	function getAllResultats($numero_de_connexion, $oBdd, $GLOBALS_INI, $VARS_HTML)	{
		$spathSQL= $GLOBALS_INI["PATH_HOME"] . $GLOBALS_INI["PATH_SQL"] . "select_crypto.sql";
		$resultat= $oBdd->getSelectDatas($numero_de_connexion, $spathSQL, array());
		return $resultat;
	}
}

?>
