<?php
require_once "initialize.php";

/**
 * Class film_service | file film_service.php
 *
 * In this class, we have methods for :
 * - adding a movie with method save_film()
 * - updating a movie with method update_film()
 * - deleting a movie with method supprime_film()
 * - listing all movies with method liste_film()
 * - editing a movie with method edit_film()
 * With this interface, we'll be able to list all the films stored in database
 *
 * List of classes needed for this class
 *
 * require_once "film_service.php";
 *
 * @package Cinema Project
 * @subpackage configuration
 * @author @Afpa Lab Team
 * @copyright  1920-2080 The Afpa Lab Team Group Corporation World Company
 * @version v1.0
 */
class Film_service extends Initialize	{
	
	/**
	 * public $resultat is used to store all datas needed for HTML Templates
	 * @var array
	 */
	public $resultat;

	/**
	 * Call the parent constructor
	 *
	 * init variables resultat
	 */
	public function __construct()	{
		// Call Parent Constructor
		parent::__construct();

		// init variables resultat
		$this->resultat= [];
	}

	/**
	 * Call the parent destructor
	 */
	public function __destruct()	{
		// Call Parent destructor
		parent::__destruct();
	}

	/**
	 * Method save_film()
	 *
	 * Insert a new movie in database
	 */
	public function save_film()	{
		// Here I can Access to :
		// $this->GLOBALS_INI
		// $this->oBdd
		// $this->VARS_HTML
		$spathSQL= $this->GLOBALS_INI["PATH_HOME"] . $this->GLOBALS_INI["PATH_SQL"] . "insert_film.sql";
		$this->resultat["save_film"]= $this->oBdd->treatDatas($spathSQL, array(
																	"titre_film" => $this->VARS_HTML["titre_film"], 
																	"date_film" => $this->VARS_HTML["date_film"], 
																	"duree_film" => $this->VARS_HTML["duree_film"]
																	));
		$this->resultat["id_film_created"]= $this->oBdd->getLastInsertId();
	}
	
	/**
	 * Method liste_film()
	 *
	 * List all movies in database
	 */
	public function liste_film()	{
		$spathSQL= $this->GLOBALS_INI["PATH_HOME"] . $this->GLOBALS_INI["PATH_SQL"] . "select_film.sql";
		$this->resultat["liste_film"]= $this->oBdd->getSelectDatas($spathSQL, array());
	}

	/**
	 * Method edit_film()
	 *
	 * Edit the movie with param id_film from the database
	 */
	public function edit_film(){
		// Here I can Access to :
		// $this->GLOBALS_INI
		// $this->oBdd
		// $this->VARS_HTML
		$spathSQL= $this->GLOBALS_INI["PATH_HOME"] . $this->GLOBALS_INI["PATH_SQL"] . "select_film_single.sql";
		$this->resultat["edit_film"]= $this->oBdd->getSelectDatas($spathSQL, array( "id_film" => $this->VARS_HTML["id_film"] ));

	}

	/**
	 * Method supprime_film()
	 *
	 * Delete a movie in database
	 */
	public function supprime_film(){
		// Here I can Access to :
		// $this->GLOBALS_INI
		// $this->oBdd
		// $this->VARS_HTML
		$spathSQL= $this->GLOBALS_INI["PATH_HOME"] . $this->GLOBALS_INI["PATH_SQL"] . "delete_film.sql";
		$this->resultat["supprime_film"]= $this->oBdd->treatDatas($spathSQL, array(
																	"id_film" => $this->VARS_HTML["id_film"]
																	));

	}

	/**
	 * Method update_film()
	 *
	 * Update the movie with param id_film in database
	 */
	public function update_film(){
		// Here I can Access to :
		// $this->GLOBALS_INI
		// $this->oBdd
		// $this->VARS_HTML
		$spathSQL= $this->GLOBALS_INI["PATH_HOME"] . $this->GLOBALS_INI["PATH_SQL"] . "update_film.sql";
		$this->resultat["update_film"]= $this->oBdd->treatDatas($spathSQL, array(
																	"id_film" => $this->VARS_HTML["id_film"], 
																	"titre_film" => $this->VARS_HTML["titre_film"], 
																	"date_film" => $this->VARS_HTML["date_film"], 
																	"duree_film" => $this->VARS_HTML["duree_film"]
																	));

	}
}

?>
