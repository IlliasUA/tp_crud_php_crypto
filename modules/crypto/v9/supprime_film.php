<?php
	class supprime_film {

	function getAllResultats($oBdd, $GLOBALS_INI, $VARS_HTML)	{
		$spathSQL= $GLOBALS_INI["PATH_HOME"] . $GLOBALS_INI["PATH_SQL"] . "delete_film.sql";
		$resultat= $oBdd->treatDatas($spathSQL, array(
																	"id_film" => $VARS_HTML["id_film"]
																	));
		return $resultat;
	}
}
?>
