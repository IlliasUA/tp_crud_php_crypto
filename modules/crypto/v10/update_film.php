<?php
// List of classes needed for this class
require_once "initialize.php";

class Update_film extends Initialize	{
	
	public $resultat;

	public function __construct()	{
		// SESSION
		// session_start();
		// Call Parent Constructor
		parent::__construct();

		// init variables resultat
		$this->resultat= [];

		// execute main function
		$this->main();
	}

	public function __destruct()	{
		parent::__destruct();
	}

	function main()	{
		// Here I can Access to :
		// $this->GLOBALS_INI
		// $this->oBdd
		// $this->VARS_HTML
		$spathSQL= $this->GLOBALS_INI["PATH_HOME"] . $this->GLOBALS_INI["PATH_SQL"] . "update_film.sql";
		$this->resultat= $this->oBdd->treatDatas($spathSQL, array(
																	"id_film" => $this->VARS_HTML["id_film"], 
																	"titre_film" => $this->VARS_HTML["titre_film"], 
																	"date_film" => $this->VARS_HTML["date_film"], 
																	"duree_film" => $this->VARS_HTML["duree_film"]
																	));
	}
}
?>
