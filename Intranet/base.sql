/*
SQLyog Community v12.3.2 (64 bit)
MySQL - 5.6.16 : Database - authentification
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `civilites` */

DROP TABLE IF EXISTS `civilites`;

CREATE TABLE `civilites` (
  `civilite_id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`civilite_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `civilites` */

insert  into `civilites`(`civilite_id`,`libelle`) values (1,'Madame');
insert  into `civilites`(`civilite_id`,`libelle`) values (2,'Mademoiselle');
insert  into `civilites`(`civilite_id`,`libelle`) values (3,'Mr');
insert  into `civilites`(`civilite_id`,`libelle`) values (4,'Maître');
insert  into `civilites`(`civilite_id`,`libelle`) values (5,'Docteur');
insert  into `civilites`(`civilite_id`,`libelle`) values (6,'Senor');

/*Table structure for table `evenements` */

DROP TABLE IF EXISTS `evenements`;

CREATE TABLE `evenements` (
  `evenement_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` smallint(6) NOT NULL DEFAULT '1' COMMENT '1 : Public, 2 : Privé',
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text,
  `lieu` varchar(255) DEFAULT NULL,
  `places_disponibles` int(11) DEFAULT NULL,
  `ordre_du_jour` varchar(255) DEFAULT NULL,
  `commission` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL COMMENT 'Lien vers le fichier image',
  `programme` varchar(255) DEFAULT NULL COMMENT 'Lien vers le document PDF',
  PRIMARY KEY (`evenement_id`),
  KEY `date_debut` (`date_debut`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `evenements` */

insert  into `evenements`(`evenement_id`,`type`,`date_debut`,`date_fin`,`heure_debut`,`heure_fin`,`titre`,`description`,`lieu`,`places_disponibles`,`ordre_du_jour`,`commission`,`image`,`programme`) values (1,1,'2016-12-23','2016-12-23','09:00:00','16:00:00','Modifier le titre','Modifier la description','Place du Capitole',10,'','','/upload/jpg/monimage.jpg','/upload/pdf/document.pdf');

/*Table structure for table `groupes` */

DROP TABLE IF EXISTS `groupes`;

CREATE TABLE `groupes` (
  `groupe_id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(75) NOT NULL,
  PRIMARY KEY (`groupe_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `groupes` */

insert  into `groupes`(`groupe_id`,`libelle`) values (1,'Super administrateurs');
insert  into `groupes`(`groupe_id`,`libelle`) values (2,'Administrateurs');
insert  into `groupes`(`groupe_id`,`libelle`) values (3,'Utilisateurs');

/*Table structure for table `groupes_modules` */

DROP TABLE IF EXISTS `groupes_modules`;

CREATE TABLE `groupes_modules` (
  `groupe_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `groupes_modules` */

insert  into `groupes_modules`(`groupe_id`,`module_id`) values (1,1);
insert  into `groupes_modules`(`groupe_id`,`module_id`) values (1,3);
insert  into `groupes_modules`(`groupe_id`,`module_id`) values (2,3);

/*Table structure for table `modules` */

DROP TABLE IF EXISTS `modules`;

CREATE TABLE `modules` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(75) DEFAULT NULL,
  `libelle_url` varchar(255) DEFAULT NULL COMMENT 'URL pour le chargement du module',
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `modules` */

insert  into `modules`(`module_id`,`libelle`,`libelle_url`) values (1,'Gestion des civilités','Civilite/civiliteController.php');
insert  into `modules`(`module_id`,`libelle`,`libelle_url`) values (3,'Gestion des Modules','Module/moduleController.php');

/*Table structure for table `utilisateurs` */

DROP TABLE IF EXISTS `utilisateurs`;

CREATE TABLE `utilisateurs` (
  `utilisateur_id` int(11) NOT NULL AUTO_INCREMENT,
  `civilite` smallint(6) NOT NULL DEFAULT '1' COMMENT '1: Monsieur, 2: Madame, 3: Mademoiselle',
  `nom` varchar(75) NOT NULL,
  `prenom` varchar(75) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `identifiant` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `valide` tinyint(4) NOT NULL DEFAULT '0',
  `groupe_id` int(11) NOT NULL,
  PRIMARY KEY (`utilisateur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `utilisateurs` */

insert  into `utilisateurs`(`utilisateur_id`,`civilite`,`nom`,`prenom`,`email`,`identifiant`,`password`,`valide`,`groupe_id`) values (1,1,'Aubert','Jean-Luc','jean-luc.aubert@web-projet.com','jean-luc.aubert','admin',1,1);
insert  into `utilisateurs`(`utilisateur_id`,`civilite`,`nom`,`prenom`,`email`,`identifiant`,`password`,`valide`,`groupe_id`) values (2,3,'Aubert','Jean-Luc','jean-luc.aubert@web-projet.com','admin','admin',0,2);
insert  into `utilisateurs`(`utilisateur_id`,`civilite`,`nom`,`prenom`,`email`,`identifiant`,`password`,`valide`,`groupe_id`) values (3,5,'Durant','Jean-Pierre','durant.jp@avocat.com','jpdurant','admin',0,3);
insert  into `utilisateurs`(`utilisateur_id`,`civilite`,`nom`,`prenom`,`email`,`identifiant`,`password`,`valide`,`groupe_id`) values (4,1,'Lightyear','Buzz','buzz@ovni.fr','buzz','buzz',0,3);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
