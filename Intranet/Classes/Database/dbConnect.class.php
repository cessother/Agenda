<?php
/**
* @name dbConnect.class.php : service de connexion à une base de données
*	Design Pattern : Class Factory
**/

/**
* Requiert le fichier qui contient les constantes d'informations de connexion
**/

	


class dbConnect{
	/**
	* private mixed $base : Instance de connexion à une base de données ou faux, si la connexion a échoué
	**/
	private $base;
	
	
	public function __construct(){
		
		
		$connecteur = dbConfig::$sgbd; // => MySQL
		
		$connexion = new $connecteur();
		$connexion->connect();
		
		$this->base = $connexion->getConnexion();
	}
	
	/**
	* public mixed getBase(void)
	*	@return mixed : Instance de connexion à la base de données ou faux
	**/
	public function getBase(){
		return $this->base;
	}
}
