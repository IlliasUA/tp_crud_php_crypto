<?php
class securite {

	public $VARS_HTML;
	
	function __construct()	{
		// put all variables $_POST et $_GET into the array $VARS_HTML
		$this->VARS_HTML= [];

		foreach($_POST as $key => $val)	{
			$this->VARS_HTML[$key]= htmlspecialchars($val, ENT_QUOTES);
		}

		foreach($_GET as $key => $val)	{
			$this->VARS_HTML[$key]= htmlspecialchars($val, ENT_QUOTES);
		}

		if ( (!(isset($this->VARS_HTML["page"]))) || ($this->VARS_HTML["page"] == "") )	{
			$this->VARS_HTML["page"]= "liste_film";
		}
	}
	
	function __destruct()	{
		// Y'a rien à faire, snif, mais vala mon objet est vidé de VARS_HTML
	}
}
?>