<?php
require_once "tunnel_commande_service.php";
/**
 * Class Tunnel_commande_add_pro| fichier tunnel_commande_add_pro.php
 *
 * Permet d'inscrire un professionnel
 *
 * Cette classe necessite l'utilisation de la classe :
 *
 * require_once "tunnel_commande_service.phpp";
 *
 * @package Mes travaux immo
 * @subpackage tunnel commande add pro
 * @author CATHELAIN Pauline
 * @copyright  
 * @version v1.0
 */

Class Tunnel_commande_add_pro	{
	
    /**
     * public $resultat is used to store all datas needed for HTML Templates
     * @var array
     */
    public $resultat;

    /**
     * private $aErrors permet de stocker les types d'erreurs trouvées
     * @var array
     */
    private $aErrors;

	/**
	 * private $nb_form_errors est nécessaire pour savoir le nombre d'erreurs dans le formulaire.
	 * @var int
	 */
	private $nb_form_errors;

    /**
     * init variables resultat
     *
     * execute main function
     */
    public function __construct() {
        // init variables resultat
        $this->resultat = [];

        // execute main function
        $this->main();
    }

    /**
     *
     * Destroy service
     *
     */
    public function __destruct() {
        // destroy objet_service
        unset($objet_service);
    }

 
    /**
     * Get interface to gestion of accueil
     */
    function main() {
        $objet_service = new Tunnel_commande_service();
		// Ici je fais mon appel $objet_service->ma_methode_qui_est_dans_le_service

		// initialisation du nombre d'erreur
		$this->nb_form_errors= 0;

		// initialisation array of errors
		$this->aErrors= [];

		// Vérifie si les données sont bien présentes
		$this->checkExistDatasPro();

		// Vérifie si les données sont bien formatées
		$this->checkFormatDatasPro();

		// si je n'ai pas d'erreur,je peux lancer l'appel à mon insert
		if ($this->nb_form_errors == 0)	{
			$objet_service->add_pro();
		}

		// Je passe mes parametres pour y avoir acces dans mes pages HTML
		$this->resultat = $objet_service->resultat;

		// Je rajoute les entrées nb_form_errors et aErrors dans $this->resultat pour y avoir accès dans ma page HTML
		$this->resultat["nb_form_errors"]= $this->nb_form_errors;
		$this->resultat["aErrors"]= $this->aErrors;

		$this->VARS_HTML = $objet_service->VARS_HTML;
    }
    
	/**
	 * private function checkExistDatasPro()
	 * 
	 * Vérifie si les données postées sont présentes.
	 * 
	 */
	private function checkExistDatasPro()	{
		// Vérifie l'existence du login
		$this->aErrors["login_pro"]= 0;
		if ((!(isset($this->VARS_HTML["login_pro"]))) || ($this->VARS_HTML["login_pro"] == ""))	{
			$this->nb_form_errors++;
			$this->aErrors["login_pro"]= 1;
		}

		// Vérifie l'existence du mdp 1
		$this->aErrors["mdp_pro"]= 0;
		if ((!(isset($this->VARS_HTML["mdp_pro"]))) || ($this->VARS_HTML["mdp_pro"] == ""))	{
			$this->nb_form_errors++;
			$this->aErrors["mdp_pro"]= 1;
		}

		// Vérifie l'existence du mdp 2
		$this->aErrors["mdp_2_pro"]= 0;
		if ((!(isset($this->VARS_HTML["mdp_2_pro"]))) || ($this->VARS_HTML["mdp_2_pro"] == ""))	{
			$this->nb_form_errors++;
			$this->aErrors["mdp_2_pro"]= 1;
		}

		// Vérifie la cohérence mdp 1 et mdp 2
		$this->aErrors["mdp_coherence"]= 0;
		if ($this->VARS_HTML["mdp_pro"] != $this->VARS_HTML["mdp_2_pro"])	{
			$this->nb_form_errors++;
			$this->aErrors["mdp_coherence"]= 1;
		}

		// Vérifie l'existence de la société
		$this->aErrors["societe_pro"]= 0;
		if ((!(isset($this->VARS_HTML["societe_pro"]))) || ($this->VARS_HTML["societe_pro"] == ""))	{
			$this->nb_form_errors++;
			$this->aErrors["societe_pro"]= 1;
		}

		// Vérifie l'existence du téléphone
		$this->aErrors["tel_pro"]= 0;
		if ((!(isset($this->VARS_HTML["tel_pro"]))) || ($this->VARS_HTML["tel_pro"] == ""))	{
			$this->nb_form_errors++;
			$this->aErrors["tel_pro"]= 1;
		}

		// Vérifie l'existence de l'adresse
		$this->aErrors["address_pro"]= 0;
		if ((!(isset($this->VARS_HTML["address_pro"]))) || ($this->VARS_HTML["address_pro"] == ""))	{
			$this->nb_form_errors++;
			$this->aErrors["address_pro"]= 1;
		}

		// Vérifie l'existence de la ville
		$this->aErrors["id_ville"]= 0;
		if ((!(isset($this->VARS_HTML["id_ville"]))) || ($this->VARS_HTML["id_ville"] == ""))	{
			$this->nb_form_errors++;
			$this->aErrors["id_ville"]= 1;
		}

		// Vérifie l'existence du mail
		$this->aErrors["mail_pro"]= 0;
		if ((!(isset($this->VARS_HTML["mail_pro"]))) || ($this->VARS_HTML["mail_pro"] == ""))	{
			$this->nb_form_errors++;
			$this->aErrors["mail_pro"]= 1;
		}

		// Vérifie l'existence du siret
		$this->aErrors["siret_pro"]= 0;
		if ((!(isset($this->VARS_HTML["siret_pro"]))) || ($this->VARS_HTML["siret_pro"] == ""))	{
			$this->nb_form_errors++;
			$this->aErrors["siret_pro"]= 1;
		}

	}  // end of private function checkExistDatasPro()

	/**
	 * private function checkFormatDatasPro()
	 * 
	 * Vérifie si les données postées sont bien formatées (nombres, format de l'email, longueurs des champs attendues dans la BDD, ...).
	 * 
	 */
	private function checkFormatDatasPro()	{
		// Vérifie la longueur du login
		$this->aErrors["length_login_pro"]= 0;
		if (strlen($this->VARS_HTML["login_pro"]) > 30)	{
			$this->nb_form_errors++;
			$this->aErrors["length_login_pro"]= 1;
		}

		// Vérifie si l'email est bien un email
		$this->aErrors["format_mail_pro"]= 0;
		if (filter_var($this->VARS_HTML["mail_pro"], FILTER_VALIDATE_EMAIL))	{
			$this->nb_form_errors++;
			$this->aErrors["format_mail_pro"]= 1;
		}

		// Vérifie la longueur de l'email
		$this->aErrors["length_mail_pro"]= 0;
		if (strlen($this->VARS_HTML["mail_pro"]) > 50)	{
			$this->nb_form_errors++;
			$this->aErrors["length_mail_pro"]= 1;
		}

	}  // end of private function checkFormatDatasPro()

}

?>