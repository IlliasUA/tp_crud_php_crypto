<?php

// List of classes needed for this class
require_once "database.php";
require_once "securite.php";


Class Initialize	{
	// Database instance object
	protected $oBdd;
	// All globals from INI
	protected $GLOBALS_INI;
	// Form Securite instance object
	private $oForms;
	public $VARS_HTML;
	
	public function __construct()	{
		// Instance of Config
		$this->GLOBALS_INI= Configuration::getGlobalsINI();

		// Instance of BDD
		$this->oBdd = new Database($this->GLOBALS_INI["DB_HOST"],
								   $this->GLOBALS_INI["DB_NAME"],
								   $this->GLOBALS_INI["DB_LOGIN"],
								   $this->GLOBALS_INI["DB_PSW"]);

		// Instance of Securite to have $this->VARS_HTML
		$this->oForms= new Securite();
		$this->VARS_HTML= $this->oForms->VARS_HTML;
	}

	public function __destruct()	{
		// destroy Instance of Form
		unset($this->oForms);
		// disconnect of BDD
		// destroy Instance of BDD
		unset($this->oBdd);
	}

}

?>
