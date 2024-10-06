<?php
	require('../utilisateurs/ma_session.php');
	global $i;
?>
	
<?php
			
	require('../connexion.php');
	
	$requete_donnes_receves="SELECT
			a.*, d.nomDon, d.sexe, d.nbrB, r.nomRe, r.sexeR, r.localite 
			FROM donneurs d, receveurs r, avoir a 
			WHERE d.id=a.id_don AND r.id=a.id_re ORDER BY id DESC";	

	$result_requete_donnes_receves=$pdo->query($requete_donnes_receves);
	$tous_les_donnes_receves=$result_requete_donnes_receves->fetchAll();
		
?>		
	
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>  les donneurs & receveurs </title> 
		
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
		
	</head>
		
	<body>
	<!-- debut *************************************** -->
	<?php include('../menu.php'); ?>
	<!--  fin **************************************** -->
	<br><br><br><br>
		<div class="container">
			<h1 class="text-center">Liste des donneurs & receveurs</h1>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Rechecher des donneurs & receveurs</div>
				<div class="panel-body">
					<form class="form-inline" method="post">
							
						<input type="text" name="q" id="q" class="form-control lg" placeholder="Recherche par nom">
													
						<button type="" class="btn btn-primary" name=""> 
							<span class="fa fa-search"></span>
						</button> 
					</form>
				</div>
			</div>
			
			
			<table class="table table-striped">
				<thead>
					<tr>
						<th>N°</th><th>Nom donneurs</th><th>Nombre bœux restant par donneur</th><th>Sexe donneurs</th><th>Nom receveurs</th>
						<th>Nombre bœux reçu par receveur</th><th>Sexe receveurs</th><th>Localité réceveurs</th>
						<?php if($_SESSION['user']['role']=='Administrateur'){  ?>
							<th> Actions </th>
						<?php } ?>
					</tr>
				</thead>
					
				<tbody id="tbody">
					<?php foreach($tous_les_donnes_receves as $le_donne_receve){  ?>
						
						<tr>
							<td><?php echo $i += 1 ?></td> 
							<td><?php echo $le_donne_receve['nomDon'] ?></td> 
							<td><?php echo $le_donne_receve['nbrB'] ?></td>
							<td><?php echo $le_donne_receve['sexe'] ?></td>
							<td><?php echo $le_donne_receve['nomRe'] ?></td>
							<td><?php echo $le_donne_receve['nbreB'] ?></td>
							<td><?php echo $le_donne_receve['sexeR'] ?></td> 
							<td><?php echo $le_donne_receve['localite'] ?></td> 
							<?php if($_SESSION['user']['role']=='Administrateur'){  ?>
								<td> 
									
									<a href="page_edit_donne_receve.php?id=<?php echo $le_donne_receve['id']?>"
										class="btn btn-success btn-edit-delete"> 
										<span class="fa fa-edit"></span>
									</a>
										
									<a 
										onclick="return confirm('Etes-vous sûr de vouloir supprimer ?')"
										href="delete_donne_receve.php?id=<?php echo $le_donne_receve['id']?>"
										class="btn btn-danger btn-edit-delete">
										<span class="fa fa-trash"></span>
									</a>
										
								</td>
							<?php } ?>
						</tr>
					
					<?php } ?>
				</tbody>
			</table>
			<div class="error"></div>
			<?php if($_SESSION['user']['role']=='Administrateur'){  ?>
				<a href="page_add_donne_receve.php" class="btn btn-primary">
					<span class="fa fa-plus"></span> NOUVEL ENREGISTREMENT
				</a>
			<?php } ?>
		</div>

		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/script.js"></script>
		<script>
			$(document).ready(function () {
				var champRecherche = $('#q');
				var tableBody = $('#tbody');
				var error = $('.error');

				champRecherche.on('input', function () {
					var recherche = champRecherche.val();

					$.ajax({
						url: '../page_recherche.php',
						type: 'POST',
						data: { q_d_r: recherche },
						dataType: 'json', // Indique que la réponse doit être traitée comme JSON
						success: function (data) {
							// Traitez les données JSON et mettez à jour l'affichage
							tableBody.empty();
							error.empty();

							if (data.length > 0) {
								$.each(data, function (index, resultat) {
									// Créez un élément li pour chaque résultat
									var row = `
											<tr>
												<td>${index + 1}</td>
												<td>${resultat.nomDon}</td>
												<td>${resultat.nbrB}</td>
												<td>${resultat.sexe}</td>
												<td>${resultat.nomRe}</td>
												<td>${resultat.nbreB}</td>
												<td>${resultat.sexeR}</td>
												<td>${resultat.localite}</td>
												<?php if($_SESSION['user']['role']=="Administrateur"){?>
													<td>
														<a href="page_edit_donne_receve.php?id=${resultat.id}"
														class="btn btn-success btn-edit-delete"> 
															<span class="fa fa-edit"></span>
														</a>
														&nbsp&nbsp
														<a onclick='return confirm("Etes-vous sûr de vouloir supprimer ?")'
																href="delete_donne_receve.php?id=${resultat.id}"
																class="btn btn-danger btn-edit-delete">
															<span class="fa fa-trash"></span>
														</a>
													
													</td>
												<?php } ?>
											</tr>
										`;
									// Ajoutez l'élément li à la liste des résultats
									tableBody.append(row);
								});
							}
							else {
								error.append(("<h2>Aucun résultat trouvé.</h2>"));
								// error.append(("<h2>Oups ! aucun résultat trouvé.</h2>"));
							}
						}
					});
				});
			});


		</script>
	</body>
	
</html>




