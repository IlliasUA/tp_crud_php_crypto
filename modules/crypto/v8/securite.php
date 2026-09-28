<?php
class securite {

	function getFormsAndSessionsVariables()	{
		// put all variables $_POST et $_GET into the array $VARS_HTML
		$VARS_HTML= [];

		foreach($_POST as $key => $val)	{
			$VARS_HTML[$key]= is_array($val) ? $val : trim($val);
		}

		foreach($_GET as $key => $val)	{
			$VARS_HTML[$key]= is_array($val) ? $val : trim($val);
		}

		if ( (!(isset($VARS_HTML["page"]))) || ($VARS_HTML["page"] == "") )	{
			$VARS_HTML["page"]= "liste_crypto";
		}

		return $VARS_HTML;
	}
}
?>
