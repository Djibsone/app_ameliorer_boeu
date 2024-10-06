<?php
	require('../utilisateurs/ma_session.php');
?>

<?php
	//include("../fonctions.php");

	require('../connexion.php');

	$requete="SELECT r.*, COALESCE(SUM(a.nbreB), 0) AS nbr_total_de_boeux 
				FROM receveurs r LEFT JOIN avoir a ON r.id = a.id_re 
				GROUP BY r.id 
				ORDER BY r.id DESC";
        $result=$pdo->query($requete);
	    $tous_les_receveurs=$result->fetchAll();  
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title> Les Receveurs </title> 
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
		
	</head>
		
	<body>
	
		<?php include('../menu.php'); ?>
		<br><br><br><br>
		<div class="container">

			<h1 class="text-center"> Liste des receveurs </h1>
			<div class="panel panel-primary">
				<div class="panel-heading">Rechecher les receveurs</div>
				<div class="panel-body">

<!-- ******************** Début Formulaire de recherche des réceveurs ***************** -->
					<form class="form-inline" method="post" >
						<input type="text" name="q" id="q" class="form-control lg" placeholder="Recherche par nom">
						
							<button type="" name="" class="btn btn-primary"> 
								<span class="fa fa-search"></span>
							</button>
					</form>
<!-- ******************** Fin Formulaire de recherche des réceveurs ***************** -->
			
				</div>
			</div>

			<table class="table table-striped">
				<thead>
					<tr>
						<th>N°</th> <th>Nom</th> <th>Sexe</th><th>Localité des receveurs</th> <th>Total des boeux réçu</th>
						<?php if($_SESSION['user']['role']=="Administrateur"){?>
							<th> Action</th>
						<?php } ?>			
					</tr>
				</thead>
				
				<tbody id="tbody">
			
					<?php foreach($tous_les_receveurs as $le_receveur){
					?>
					
						<tr>
							<td><?php echo $i += 1 ?></td>
							<td><?php echo $le_receveur['nomRe'] ?></td>
							<td><?php echo $le_receveur['sexeR'] ?></td>
							<td><?php echo $le_receveur['localite'] ?></td>
							<td><?php echo $le_receveur['nbr_total_de_boeux'] ?></td>
							<?php if($_SESSION['user']['role']=="Administrateur"){?>
								<td> 					
									<a href="page_edit_receveur.php?id=<?php echo $le_receveur['id']?>" 
									class="btn btn-success btn-edit-delete"><span class="fa fa-edit"></span> 
									</a>
										
									<a 
										onclick="return confirm('Etes-vous sûr de vouloir supprimer ?')"
										href="delete_receveur.php?id=<?php echo $le_receveur['id']?>" 
										class="btn btn-danger btn-edit-delete"><span class="fa fa-trash"></span> 
									</a>										
								</td>
							<?php } ?>
							
						</tr>
					<?php } ?>
					
				</tbody>
				
			</table>
			<div class="error"></div>
			<!-- <a class="btn btn-primary btn-block" href="page_add_receveur.php" >
				<h4>
					<span class="fa fa-plus"></span> 
					NOUVEAU RECEVEUR
				</h4>
			</a>  -->
			<?php if($_SESSION['user']['role']=='Administrateur'){  ?>
				<a href="page_add_receveur.php" class="btn btn-primary">
					<span class="fa fa-plus"></span> NOUVEAU RECEVEUR 
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
						data: { q_r: recherche },
						dataType: 'json',
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
												<td>${resultat.nomRe}</td>
												<td>${resultat.sexeR}</td>
												<td>${resultat.localite}</td>
												<td>${resultat.nbr_total_de_boeux}</td>
												<?php if($_SESSION['user']['role']=="Administrateur"){?>
													<td>
														<a href="page_edit_receveur.php?id=${resultat.id}"
														class="btn btn-success btn-edit-delete"> 
															<span class="fa fa-edit"></span>
														</a>
														&nbsp&nbsp
														<a onclick='return confirm("Etes-vous sûr de vouloir supprimer ?")'
																href="delete_receveur.php?id=${resultat.id}"
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
							}
						}
					});
				});
			});
		</script>
	</body>
</html>