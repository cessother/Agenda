<?php
/**
* @name all.php : Liste l'ensemble des événements enregistrés
* @see Intranet/Civilite/vues/
**/
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?php echo $title; ?></title>
		
		<!-- Inclure bootstrap.min.css //-->
		<link href="../../css/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

		<!-- Inclure la feuille de style jQuery UI //-->
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		
		<!-- Inclure le fichier de styles personnalisés //-->
		<link href="../../css/styles.css" rel="stylesheet" />
				
		<!-- Inclure le framework jQuery //-->
		<script src="../../javascript/jquery.min.js" charset="utf-8"></script>

		<!-- Inclure la librairie jqueryUI //-->
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
				
		<!-- Inclure les extensions bootstrap.js //-->
		<script src="" charset="utf-8" /></script>
		
	</head>
	
	<body>
		<div class="container">
			<header>
				<h1>Gestion des événements : Tous les événements</h1>
			</header>
			
			<main>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Id</th>
							<th>Du</th>
							<th>Au</th>
							<th>Type</th>
							<th>Titre</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					
					<tbody>
						<!-- Une boucle sur tous les événements et une ligne <tr> par événement -->
						<?php foreach($evenements->evenements as $evenement){ ?>
							<tr id="row_<?php echo $evenement["clePrimaire"]; ?>">
								<td><?php echo $evenement["clePrimaire"]; ?></td>
								<td><?php echo $evenement["date_debut"];?></td>
								<td><?php echo $evenement["date_fin"];?></td>
								<td>
									<?php if($evenement["type"] == 1){?>
										Public
									<?php } else { ?>
										Privé
									<?php } ?>
								</td>
								<td>
									<a href="controller.php?id=<?php echo $evenement["clePrimaire"]; ?>" title="Mettre à jour">
										<?php echo $evenement["titre"]; ?>
									</a>
								</td>
								<td>
									<a href="#" title="Supprimer" role="button" class="btn btn-danger" data-id="<?php echo $evenement["clePrimaire"]; ?>">
										<i class="glyphicon glyphicon-trash"></i>
									</a>								
								</td>
							</tr>
						<?php } ?>						
						<!-- N'oubliez pas un lien <a href="controller.php?id=???"> sur le titre pour mise à jour //-->
						<!-- N'oubliez pas un lien <a href="controller.php?id=???&context=delete"> sur la dernière colonne //-->
					</tbody>
					
					<tfoot>
						<!-- Le lien pour créer un nouvel événement //-->
					</tfoot>
				</table>
			</main>
			
			<footer>
			</footer>
			
			<div id="dialog" class="dialog not-showed">
				<header></header>
				<blockquote></blockquote>
			</div>
			
			<div id="dialog-confirm" title="Etes-vous sûr de vouloir supprimer cet événement ?"  class="not-showed">
				<p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Attention, si vous répondez oui, l'événement sera définitivement supprimé de la base de données.</p>
			</div>
		
		</div>
		<script charset="utf-8">
				$(".btn-danger").on("click", function(){ // Gestionnaire d'événements...
					// Ici... insérer le dialogue UI
					var id = $(this).data("id"); // on récupère la valeur de l'attribut data-id du bouton cliqué dans le tableau
					
					$("#dialog-confirm").dialog(
						{
							resizable: false, // Ne pas autoriser le redimensionnement de la boîete de dialogue
							width: 600, // La boîte de dialogue aura une largeur de 600 pixels
							modal: true, // Tant que l'utilisateur n'aura pas cliqué sur un des boutons, on reste là...
							buttons: {
								"Oui": function(){
									// A partir de ce moment, on peut essayer d'appeler un script côté serveur...
									$.ajax({
										url: "Ajax/delete.php",// L'adresse précise du script qui doit être appelé sur le serveur
										data: {
											"id": id
										},// Définit les données qui doivent être transmises au script delete.php
										type: "post", // Méthode à utiliser pour transmettre des données au script delete.php (get ou post)
										dataType: "json",// Manière dont on va récupérer les données retransmises par le script delete.php (json, xml, script, html)
										success: function(data){ // La requête a été exécutée avec succès
											//console.log("L'appel à delete.php s'est déroulé correctement");
											// On va voir ce que le script delete.php nous a retourné
											console.log("Données retournées : " + JSON.stringify(data));
											
											// Réellement effacer le tr du tableau portant l'id row_???
											$("#" + data.row).remove(); // Supprime effectivement la ligne du tableau...
											$("#dialog header").html("<h3>Suppression</h3>");
											$("#dialog blockquote").html("La suppression de l'événement s'est correctement déroulée.");
					
											// Dans tous les cas, on "affiche" le dialogue
											$("#dialog").show();
											// Définit la méthode pour masquer le dialogue au bout de 2 secondes
											setTimeout(
												function(){
													$("#dialog").hide("slow");
												},
												2000
											);
										},
										error: function(request, status, error){ // La requête vers delete.php a échoué
											console.log("Désolé, mais le script delete.php n'a pas pu être chargé correctement...");
										}
										
									});
									$(this).dialog("close");
								},
								"Non": function(){
									$(this).dialog("close");
								}
							}
						}
					);
					
		
				}
			);
		</script>
	</body>
</html>