<?php
/**
 * @name formulaire.php : Formulaire pour l'ajout / modification d'un événement
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
	<!-- classe bootstrap .container : contraint l'affichage à une largeur de 1190px //-->
		<div class="container">
			<header>
				<h1>Gestion des événements : <?php echo $title; ?></h1>
			</header>
			
			<main>
				<form name="evenements" method="post" action="controller.php" enctype="multipart/form-data">
					<input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
					<fieldset>
						<legend>Titre et description</legend>
						<div class="form-group">
							<label for="titre">Titre :</label>
							<input type="text" class="form-control" name="titre" id="titre" value="<?php echo $evenements->evenements["titre"]; ?>" />
						</div>
						<div class="form-group">
							<label for="description">Description :</label>
							<textarea class="form-control" name="description" id="description" cols="30" rows="5"><?php echo $evenements->evenements["titre"]; ?></textarea>
						</div>
						<div class="form-group">
							<?php if($evenements->evenements["image"] != "") { ?>
								<img src="<?php echo $evenements->evenements["image"]; ?>" title="Illustration" id="image_<?php echo $evenements->evenements["clePrimaire"]; ?>" />
								<a href="#" class="btn btn-default imageDelete" title="Supprimer l'image" data-id="<?php echo $evenements->evenements["clePrimaire"]; ?>">Supprimer</a>
								<div id="image-file-<?php echo $evenements->evenements["clePrimaire"]; ?>"></div>
							<?php } else { ?>
								<label for="image">Illustration :</label>
								<input type="file" class="form-control" name="image" id="image" accept=".jpg,.jpeg,.png,.gif, image/*" />
							<?php } ?>
						</div>
						<div class="form-group">
							<label for="programme">Programme :</label>
							<input type="text" class="form-control" name="programme" id="programme" value="<?php echo $evenements->evenements["programme"]; ?>" />
						</div>
					</fieldset>
					<fieldset>
						<legend>Dates et heures</legend>
						<div class="form-group">
							<label for="date_debut">Date de début :</label>
							<input type="text" class="form-control" name="date_debut" id="date_debut" value="<?php echo $evenements->evenements["date_debut"]; ?>" />
						</div>
						<div class="form-group">
							<label for="date_fin">Date de fin :</label>
							<input type="text" class="form-control" name="date_fin" id="date_fin" value="<?php echo $evenements->evenements["date_fin"]; ?>" />
						</div>
						<div class="form-group">
							<label for="heure_debut">Heure de début :</label>
							<input type="text" class="form-control" name="heure_debut" id="heure_debut" value="<?php echo $evenements->evenements["heure_debut"]; ?>" />
						</div>
						<div class="form-group">
							<label for="heure_fin">Heure de fin :</label>
							<input type="text" class="form-control" name="heure_fin" id="heure_fin" value="<?php echo $evenements->evenements["heure_fin"]; ?>" />
						</div>							
					</fieldset>
					
					<fieldset>
						<legend>Type</legend>
						<div class="radio">
							<label>
								<input type="radio" name="type" id="type_public" value="1" checked="checked" />
								Public
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="type" id="type_prive" value="2" />
								Privé
							</label>
						</div>
						<div class="content">
							<div class="col-lg-6 current">
								<div class="form-group">
									<label for="lieu">Lieu :</label>
									<input type="text" class="form-control" name="lieu" id="lieu" value="<?php echo $evenements->evenements["lieu"]; ?>" />
								</div>
								<div class="form-group">
									<label for="places_disponibles">Places disponibles :</label>
									<input type="text" class="form-control" name="places_disponibles" id="places_disponibles" value="<?php echo $evenements->evenements["places_disponibles"]; ?>" />
								</div>
							</div>
							
							<div class="col-lg-6">
								<div class="form-group">
									<label for="commission">Commission :</label>
									<input type="text" class="form-control" name="commission" id="commission" value="<?php echo $evenements->evenements["commission"]; ?>" />
								</div>
								<div class="form-group">
									<label for="ordre_du_jour">Ordre du jour :</label>
									<input type="text" class="form-control" name="ordre_du_jour" id="ordre_du_jour" value="<?php echo $evenements->evenements["ordre_du_jour"]; ?>" />
								</div>
							</div>
						</div>
					</fieldset>
					<div class="form-group">
						<button type="submit" class="btn btn-primary"><?php echo $buttonLabel; ?></button>
						<input type="hidden" name="clePrimaire" value="<?php echo $evenements->evenements["clePrimaire"]; ?>" />
					</div>
				</form>
			</main>
			
			<footer>
			</footer>
		<div id="dialog-confirm" title="Etes-vous sûr de vouloir supprimer cette image ?" class="not-showed">
			<p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Attention, si vous répondez oui,
			l'image sera physiquement effacée sur le serveur. Cette action est irréversible.</p>
		</div>
					
			<script charset="utf-8">
				$(".imageDelete").on("click", function(){
						var id = $(this).data("id"); // Récupère l'ID de l'événement de l'attribut data-id du bouton cliqué
						
						// Charger le dialogue permettant de confirmer la suppression de l'image sur le serveur et la mise à jour
					$("#dialog-confirm").dialog(
						{
							resizable: false, // Ne pas autoriser le redimensionnement de la boîete de dialogue
							width: 600, // La boîte de dialogue aura une largeur de 600 pixels
							modal: true, // Tant que l'utilisateur n'aura pas cliqué sur un des boutons, on reste là...
							buttons: {
								"Oui": function(){
									//console.log("Oui, on veut supprimer l'image...");
									$.ajax({
										url: "Ajax/updateImage.php", // Script sur le serveur qui doit être exécuté
										type: "get", // Méthode à utiliser pour transmettre les données au script
										data: {
											"id": id // Dans updateImage, on récupérera $_GET["id"]
										},
										dataType: "json", // On récupérera les données au format JSON
										success: function(result){ // Le script a été trouvé, et il a été correctement exécuté
											$(this).dialog("close");
											console.log("Okay, updateImage a bien été trouvé et exécuté");
											if(result.statut == 1){
												$("#image_" + result.id).remove(); // Supprime l'objet #image_n du DOM
												$("a[data-id=" + result.id + "]").remove(); // Supprime le lien du bouton Supprimer du DOM
												// Créer... artificiellement un champ de type FILE pour pouvoir à nouveau télécharger un fichier
												var dock = $("#image-file-" + result.id);
												
												var label = $("<label>");
												// Ajoutons l'attribut "name" à ce nouvel objet
												label.attr("for","image");
												label.html("Illustration");
												
												var input = $("<input>");
												input.attr("name","image");
												input.attr("id","image");
												input.attr("accept",".jpg,.jpeg,.png,.gif");
												input.attr("type","file");
												
												// Ajouter l'élément au DOM
												label.appendTo(dock);
												input.appendTo(dock);
												
											}
										},
										error: function(request,status,error){
											console.log("Erreur : " + error + " Statut : " + status);
										}
										
									});
								},
								"Non": function(){
									//console.log("Non, on s'est fait peur, l'image ne sera pas supprimée.");
									$(this).dialog("close");
								}
							}
						}
						);						
					}
				);
			</script>
		</div>
	</body>
</html>