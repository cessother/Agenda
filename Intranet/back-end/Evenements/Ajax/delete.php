<?php
/**
 * @name delete.php : Script appelé en Ajax permettant la suppression d'un événement
 **/
/** chargement du loader d'application
 **/
require_once(dirname(__FILE__). "/../../../appLoader.class.php"); //__file-- renvoit le nom du script en cours d'execution
 /**
 * @var Ambiguous $id
 */
$id = $_POST["id"];

// On devrait procéder au traitement lui-même...
if(file_exists("../modele/evenements.class.php"))
	require_once("../modele/evenements.class.php");
else 
	require_once("../../modele/evenements.class.php");

$evenement = new evenements();
$evenement->delete($id);

// Prépare l'information à retourner au script jQuery
$resultat = array(
		"statut" => 1,
		"row" => "row_" . $id
);

// On envoie le tout vers la sortie standard
/**
 {
 "statut": 1,
 "row": "row_1"
 }
 **/
echo json_encode($resultat);