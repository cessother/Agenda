<?php
/**
* @name controller.php : Contrôleur d'affichage d'événements d'un agenda
* @author webDev - Déc. 2016
* @package Objet/Agenda
* 	Instancie différents événements (publics ou privés) pour mise à disposition d'un agenda dans les vues
*		- vues/all.php : Tous les événements dans l'ordre chronologique inverse
*		- vue/public.php : Seulement les événements publics dans l'ordre chronologique inverse
*		- vue/dashboard.php : Tous les événements dans un tableau pour "administration"
**/

require("Classes/DefinitionEvenement.class.php");
require("Classes/EvenementPublic.class.php");
require("Classes/EvenementPrive.class.php");

/**
* Cette classe va permettre de "collectionner" les événements
* De récupérer les événements collectionnés en fonction des besoins :
*	- Tous les événements dans l'ordre chronologique
*	- Les événements "publics" seulement dans l'ordre chronologique
*	- Tous les événements mais dans l'ordre alphabétique
**/
require("Classes/agenda.class.php");

$agenda = new agenda();

/**
* @update 1 : Récupérer tous les événements de la base de données
*(@see back-end/evenements/evenements.class.php::select()
*/

/**
* @update 2 : Boucler sur tous les événements et à chaque occurrence :
*	Créer un objet (EvenementPublic ou EvenementPrive) en fonction de la valeur de la colonne type
*	Ajouter l'objet créé à la collection des objets de l'agenda @see agenda::addEvenement()
**/

/**
* @update 3 : Inspecter le contexte pour agir en conséquence :
*	- Afficher TOUS les événements triés par date
*	- N'afficher QUE les événements publics triés par date
*	- N'afficher QUE les événements privés triés par date
* Appeler les méthodes de la classe Agenda (getAllBy(), ...)
**/

/**
* Charger la vue correspondante
**/

include();

