<?php
/**
 * @name appLoader.class.php
* 	Services de chargement des applications
* 	Intègre la méthode autoload pour le chargement automatique des classes
* @author webdev - 2016 - 2017
* @package \
* @version 1.0
**/
class appLoader {
	
	private static $racine;
	/**
	 * Instancie un nouvel objet de chargement d'application
	 **/
	public function __construct(){
	
		spl_autoload_register(array(__CLASS__,"autoload"));
	}

	/**
	 * Méthode de chargement automatique des classes
	 * @param string $className
	 */
	public static function autoload($className){
		self::$racine = $_SERVER["DOCUMENT_ROOT"]."/Agenda/Intranet";
		//1. On cherche d'abord dans le dossier Classes de l'application
		//echo "Dossier racine :".$_SERVER["DOCUMENT_ROOT"]. "<br />";
		$cheminCompletClasse = self::chercherClasse(self::$racine."/Classes/",$className);

		if(!$cheminCompletClasse){
			$cheminCompletClasse = self::chercherClasse(self::$racine."/",$className);
		}

		if($cheminCompletClasse){
			require_once($cheminCompletClasse);
			return true;
		}

		throw new Exception("Impossible de trouver la classe " . $className, -100001);
		return false;
	}

	private static function chercherClasse($dossier, $className){
		// \DirectoryIterator retourne la liste des dossiers et des fichiers du dossier $dossier
		$listeFichier = new \DirectoryIterator($dossier);

		foreach($listeFichier as $element){
			if($element->isDot()){
				#begin_debug
				#echo "dans le dossier :".$dossier."on a un dossier \".\" ou\"..\"<br />";
				#end_debug
				continue; // Revient à l'instruction foreach sans exécuter tout le reste
			}
				
			if($element->isDir()){
				// L'élément lu est un dossier, on vérifie le dossier commence par "_"
				if(substr($element->getFilename(),0,1) == "_"){
					continue;
				}

				// Il s'agit d'un dossier, on va entrer dans ce nouveau dossier pour le parcourir à son tour
				if($resultat = self::chercherClasse($dossier . $element->getFilename() . "/", $className)){
					#begin_debug
					#echo "Dossier :".$dossier . $element->getFilename()."<br />";
					#end_debug
					// On a donc trouvé dans ce nouveau dossier ce qu'on cherche...
					return $resultat; // On sort de la boucle itérative avec le chemin complet à charger
					echo "chemin:".$resultat;
				} else {
					continue; // On passe à l'élément suivant
				}
			} else {
				// Il s'agit donc d'un fichier...
				if($element->getFileName() == $className . ".class.php"
						|| $element->getFileName() == $className . ".php"
						|| $element->getFileName() == "class." . $className . ".php"){
							// Et il s'agit bien de celui qu'on recherche
							return $dossier . $element->getFilename();
							
				}
			}
		}
		return false; // Le fichier demandé n'a pas pu être trouvé...
	}
}