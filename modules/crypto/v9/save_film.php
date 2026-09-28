<?php
	class save_film {

	function getAllResultats($oBdd, $GLOBALS_INI, $VARS_HTML)	{
		$spathSQL= $GLOBALS_INI["PATH_HOME"] . $GLOBALS_INI["PATH_SQL"] . "insert_film.sql";
		$resultat= $oBdd->treatDatas($spathSQL, array(
																	"titre_film" => $VARS_HTML["titre_film"], 
																	"date_film" => $VARS_HTML["date_film"], 
																	"duree_film" => $VARS_HTML["duree_film"]
																	));
		return $resultat;
	}
}
?>
