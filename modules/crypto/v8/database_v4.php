<?php
Class Class_database_v4 {

	function connectBDD($host, $name, $login, $psw)	{
			// Connection to DB : SERVEUR / LOGIN / PASSWORD / NOM_BDD
			$numero_de_connexion = new PDO('mysql:host='.$host.';dbname='.$name.';charset=utf8', $login, $psw);
			return $numero_de_connexion;
		}

		function disconnectBDD($numero_de_connexion)	{
			$numero_de_connexion= null;
		}
		
		function getSelectDatas($numero_de_connexion, $spathSQL, $data=array())	{
			// content of SQL file
			$sql= file_get_contents($spathSQL);

			// replace variables @variable from sql by values of the same variables'name
			foreach ($data as $key => $value) {
				$sql = str_replace('@'.$key, $value, $sql);
				error_log("key = " . $key . " | " . "value= " . $value. " | " . "sql = " . $sql);
			}

			error_log("getSelectDatas = " . $sql);

			// Execute la requete
			$results_db= $numero_de_connexion->prepare($sql);
			$results_db->execute();

			if (!$results_db){
				error_log("error = " . $numero_de_connexion->error);
			}

			$resultat= [];
			while ($ligne = $results_db->fetch()) {
				$new_ligne= [];
				foreach ($ligne as $key => $value) {
					if (!(is_numeric($key)))	{
						error_log("getSelectDatas DETAILS = " . $key . " => " . $value);
						$new_ligne[$key]= $value;
					}
				}
				$resultat[]= $new_ligne;
			}

			return $resultat;
		}

		function treatDatas($numero_de_connexion, $spathSQL, $data=array())	{
			// content of SQL file
			$sql= file_get_contents($spathSQL);
			// $sql= "insert into film (titre_film, date_film, duree_film) values ("@titre_film", "@date_film", @duree_film);"

			/*
			data(
				"titre_film" => $_POST["titre_film"], 
				"date_film" => $_POST["date_film"], 
				"duree_film" => $_POST["duree_film"]
			)
			*/
																	// replace variables @variable from sql by values of the same variables'name
			foreach ($data as $key => $value) {
				/*
				$sql= str_replace('@titre_film', "Avengers 3", $sql);
				insert into film (titre_film, date_film, duree_film) values 
					("Avengers 3", "@date_film", @duree_film);

				$sql= str_replace('@date_film', "2018-11-05", $sql);
				insert into film (titre_film, date_film, duree_film) values 
					("Avengers 3", "2018-11-05", @duree_film);

				$sql= str_replace('@duree_film', "123", $sql);
				insert into film (titre_film, date_film, duree_film) values 
					("Avengers 3", "2018-11-05", 123);
				*/
				$sql= str_replace('@'.$key, $value, $sql);
			}

			error_log("treatDatas = " . $sql);

			// Execute la requete
			$results_db= $numero_de_connexion->query($sql);

			if (!$results_db){
				error_log("error = " . $numero_de_connexion->error);
			}

			return $results_db;
	}

}
	
?>
