<?php
/**
 * 
 * @author cecile
 *@name appLoader.class.php
 */

class appLoader {
	public function __construct(){
		#begin_debug
		#echo "Script en cours d'execution :" . $_SERVER["PHP_SELF"]."<br />";
		#end_debug
		//Fonction qui definit l'autoloader de classes
		spl_autoload_register(array(__CLASS__,"autoload"));
	}
	/**
	 * methode statique qui sera appelée automatiquement lors de l'instanciation de la classe
	 */
	public static function autoload($className){
		
		#begin_debug
		#echo "on charge la classe :" .$className."<br />";
		#end_debug
		
		//1.on cherche la classe a partir du dossier "classes" de notre appli
		//la methode searchclass retourne le chemin complet ou faux si
		//la classe n'a pas pu ê trouvée à partir du dossier spécifié
		$fullClassPath = self::searchClass("/Classes", $className);
		
		//2. c'est pas dans "classes", on va parcourir tous les dossier
		$fullClassPath = self::searchClass("/", $className);
	}
	private static function searchClass($dossier, $className){
		$listeFichiers = new \DirectoryIterator($dossier);
		
		foreach($listeFichiers as $fichier){
			// ne pas traiter les dossier . et ..
			if($fichier->isDot()){
				continue;//
			}
			if($fichier->isDir()){ // si c'est un dossier
				if(substr($fichier->getFileName(),0,1)=="_"){
					continue;
				}
				
				if($resultat = self::searchClass($dossier . $fichier->getFilename(), $className))
			}
		}
	}
}
