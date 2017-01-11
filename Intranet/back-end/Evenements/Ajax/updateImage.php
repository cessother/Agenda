<?php
/**
 * @name updateImage.php : Script appelé en Ajax pour :
*	- Récupérer la ligne dans la table evenements pour evenement_id = l'identifiant passé dans la requête HTTP
*	- Supprimer physiquement le fichier sur le serveur
*	- Mettre à jour la table evenement en effaçant le contenu de la colonne image
**/

// Charger les classes nécessaires pour la création d'un objet du modèle evenements
if(file_exists("../modele/evenements.class.php"))
	require_once("../modele/evenements.class.php");
	else
		require_once("../../modele/evenements.class.php");

		// Récupération du paramètre transmis en "GET" dans la requête HTTP
		$id = $_GET["id"];

		// A partir de ce moment là, on va exécuter un select sur cette valeur d'identifiant dans la table evenements
		$evenement = new evenements(); // Instanciation d'un nouvel objet "evenement"

		$evenement->selectById($id); // Appelle la méthode de sélection par "id"

		$image = $evenement->evenements["image"]; // On peut donc récupérer le lien vers l'image tel qu'il existe dans la base de données

		// Supprimer le fichier physiquement sur le serveur
		$fullPathName = dirname(__FILE__) . "/../.." . $image;

		if(file_exists($fullPathName)){
			if(@unlink($fullPathName)){
				$results["fileDeletion"] = 1; // On ajoute une clé indiquant que le fichier a bien été supprimé
			} else {
				$results["fileDeletion"] = 0; // La clé indiquera que la suppression n'a pu être effectuée
			}
		}

		// Dans tous les cas, on met à jour la base de données
		$updateStatut = $evenement->updateImage($id);

		// Initialise le tableau qui sera retransmis à la callback "success" de l'appel Ajax
		$results = array(
				"statut" => $updateStatut ? 1 : 0
		);
		
		$results["id"] = $id;
		echo json_encode($results);