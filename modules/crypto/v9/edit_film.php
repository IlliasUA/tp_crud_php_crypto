<?php
	class edit_film {
		function getAllResultats($oBdd, $GLOBALS_INI, $VARS_HTML)	{
			$spathSQL= $GLOBALS_INI["PATH_HOME"] . $GLOBALS_INI["PATH_SQL"] . "select_film_single.sql";
			$resultat= $oBdd->getSelectDatas($spathSQL, array( "id_film" => $VARS_HTML["id_film"] ));
			return $resultat;
	}
}
	

?>
