<?php
require_once "initialize.php";
/**
 * Class add_film | file add_film.php
 *
 * In this class, we show the interface "add_film.html".
 * With this interface, we'll be able to fill the fields needed for adding a new movie
 *
 * List of classes needed for this class
 *
 * require_once "initialize.php";
 *
 * @package Cinema Project
 * @subpackage add_film
 * @author JiJou
 * @copyright  1920-2080 The JiJou Group Corporation
 * @version v10.1.0
 */
class Add_film extends Initialize	{
	
	/**
	 * public $resultat is used to store all datas needed for HTML Templates
	 * @var array
	 */
	public $resultat;

	/**
	 * Call the parent constructor
	 *
	 * init variables resultat
	 *
	 * execute main function
	 */
	public function __construct()	{
		parent::__construct();

		$this->resultat= [];

		$this->main();
	}

	/**
	 * Call the parent destructor
	 */
	public function __destruct()	{
		parent::__destruct();
	}

	/**
	 * Here is where the main code is. Here I can Access to :
	 * 
	 * $this->GLOBALS_INI
	 * 
	 * $this->oBdd
	 * 
	 * $this->VARS_HTML
	 */
	function main()	{
		$this->resultat= [];
	}
}

?>
