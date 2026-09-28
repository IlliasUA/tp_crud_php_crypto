<?php
require_once  "initialize.php";
/**
 * Class Tunnel_commande_service | fichier tunnel_commande_service.php
 *
 * Cette class permet de gérer les différentes fonctions de modification envoyé à la BDD .
 *
 * Cette classe necessite l'utilisation de la classe :
 *
 * require_once "initialize.php";
 *
 * @package Mes travaux immo
 * @subpackage Tunnel commande service
 * @author CATHELAIN Pauline
 * @copyright  
 * @version v1.0
 */

Class Tunnel_commande_service extends Initialize	{

  /**
   * public $resultat is used to store all datas needed for HTML Templates
   * @var array
   */
  public $resultat;

  /**
   * init variables resultat
   *
   * execute main function
   */
  public function __construct() {
    // Call Parent Constructor
    parent::__construct();

    // init variables resultat
    $this->resultat = [];

    // execute main function
  }

/*
*fonction de récupération des données abonnement pour le panier
*/
  public function panier_list(){
  $spathSQL= $this->GLOBALS_INI["PATH_HOME"] . $this->GLOBALS_INI["PATH_MODEL"] . "panier_list.sql";
  $this->resultat["tunnel_commande_panier_list"]= $this->oBdd->getSelectDatas($spathSQL);
}

/*
*fonction de récupération des données cgv pour le panier
*/
public function cgv_list(){
  $spathSQL= $this->GLOBALS_INI["PATH_HOME"] . $this->GLOBALS_INI["PATH_MODEL"] . "cgv_list.sql";
  $this->resultat["tunnel_commande_cgv_list"]= $this->oBdd->getSelectDatas($spathSQL);
}

/*
*fonction de récupération des données ville pour l'inscription
*/
public function ville_list(){
  $spathSQL= $this->GLOBALS_INI["PATH_HOME"] . $this->GLOBALS_INI["PATH_MODEL"] . "select_ville.sql";
  $this->resultat["tunnel_commande_select_ville"]= $this->oBdd->getSelectDatas($spathSQL);
}

 /*
  *fonction de création d'un pro
  */
  public function add_pro(){
 
    $spathSQL= $this->GLOBALS_INI["PATH_HOME"] . $this->GLOBALS_INI["PATH_MODEL"] . "add_pro.sql";
    $this->resultat["tunnel_commande_add_pro"]= $this->oBdd->treatDatas($spathSQL, array(
                                "login_pro" => $this->VARS_HTML["login_pro"], 
                                 "mdp_pro" => crypterssl($this->VARS_HTML["siret_pro"], $this->VARS_HTML["mdp_pro"]), 
                                  "societe_pro" => $this->VARS_HTML["societe_pro"], 
                                  "tel_pro" => $this->VARS_HTML["tel_pro"], 
                                  "address_pro" => $this->VARS_HTML["address_pro"], 
                                  "id_ville" => $this->VARS_HTML["id_ville"],
                                  "mail_pro" => $this->VARS_HTML["mail_pro"],
                                  "siret_pro" => $this->VARS_HTML["siret_pro"]
                                  ));
  
  }

 /*
  *fonction de création d'un pro
  */
  public function check_connect_pro(){
	// en amont je récupère le siret du login soumis
    $spathSQL= $this->GLOBALS_INI["PATH_HOME"] . $this->GLOBALS_INI["PATH_MODEL"] . "select_siret_pro.sql";
    $this->resultat["siret_pro"]= $this->oBdd->getSelectDatas($spathSQL, array(
                                "login_pro" => $this->VARS_HTML["login_pro"]
                                  ));
	
	if (count($this->resultat["siret_pro"]) > 0)	{
		// ensuite je vérifie si login et mdp sont correct	
		$spathSQL= $this->GLOBALS_INI["PATH_HOME"] . $this->GLOBALS_INI["PATH_MODEL"] . "select_pro.sql";
		$this->resultat["tunnel_commande_select_pro"]= $this->oBdd->getSelectDatas($spathSQL, array(
									"login_pro" => $this->VARS_HTML["login_pro"], 
									 "mdp_pro" => crypterssl($this->resultat["siret_pro"][0]["siret"], $this->VARS_HTML["mdp_pro"])
									  ));
		if (count($this->resultat["siret_pro"]) == 1)	{
			// bon login et pass
		}  else  {
			// mauvais login et pass
		}
	}
  
  }


	private function crypterssl($maCleDeCryptage, $maChaineACrypter) {
		// Set a random salt
		// $salt = openssl_random_pseudo_bytes(8);
		// Or empty salt so that we'll be able to compare again
		$salt= "";
		$salted = '';
		$dx = '';
		// Salt the key(32) and iv(16) = 48
		while (strlen($salted) < 48) {
		  $dx = md5($dx.$maCleDeCryptage.$salt, true);
		  $salted .= $dx;
		}
		$key = substr($salted, 0, 32);
		$iv  = substr($salted, 32,16);
		$encrypted_data = openssl_encrypt($maChaineACrypter, 'aes-256-cbc', $key, true, $iv);
		return base64_encode('Salted__' . $salt . $encrypted_data);
	}
   /**
   *
   * Destroy service
   *
   */
  public function __destruct() {
    // Call Parent destructor
    parent::__destruct();
    // destroy objet_service
  }


}
  

?>