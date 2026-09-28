<?php
class liste_crypto {
	function getAllResultats($numero_de_connexion, $oBdd, $GLOBALS_INI, $VARS_HTML)	{
		$spathSQL= $GLOBALS_INI["PATH_HOME"] . $GLOBALS_INI["PATH_SQL"] . "select_crypto.sql";
		$resultat= $oBdd->getSelectDatas($numero_de_connexion, $spathSQL, array());
		foreach ($resultat as &$crypto) {
			$crypto["id_strategies"] = $crypto["id_strategies"] === null
				? []
				: array_map("intval", explode(",", $crypto["id_strategies"]));
			$crypto["id_notifications"] = $crypto["id_notifications"] === null
				? []
				: array_map("intval", explode(",", $crypto["id_notifications"]));
		}
		unset($crypto);
		return $resultat;
	}
}

?>
