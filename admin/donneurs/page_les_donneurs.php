<?php
	require('../utilisateurs/ma_session.php');
	global $i;
?>

<?php
	include("../fonctions.php");

	require('../connexion.php');
/**
	if (isset($_POST['search'])) {
		if (!empty($_POST['q'])) {
			$q = $_POST['q'];
			$requete = "SELECT d.*, d.nomDon, d.sexe, d.nbrB, COALESCE(SUM(a.nbreB), 0) AS nbr_total_de_boeux
					FROM donneurs d
					LEFT JOIN avoir a ON d.id = a.id_don
					WHERE d.nomDon LIKE :q
					GROUP BY d.id, d.nomDon, d.sexe, d.nbrB
					ORDER BY d.id DESC";
			$result_requete_donneurs = $pdo->prepare($requete);
			$result_requete_donneurs->execute(array(':q' => '%' . $q . '%'));
			$tous_les_donneurs = $result_requete_donneurs->fetchAll();
		} else {
			$msg = "Champ de recherche vide";
			$url = "donneurs/page_les_donneurs.php";
			header("location:../message.php?msg=$msg&color=r&url=$url");
		}
	} else {
		$requete_donneurs = "SELECT
					d.*, COALESCE(SUM(a.nbreB), 0) AS nbr_total_de_boeux 
					FROM donneurs d LEFT JOIN avoir a ON d.id = a.id_don 
					GROUP BY d.id ORDER BY d.id DESC";

		$result_requete_donneurs = $pdo->query($requete_donneurs);
		$tous_les_donneurs = $result_requete_donneurs->fetchAll();
	}
**/
	$requete_donneurs = "SELECT
			d.*, COALESCE(SUM(a.nbreB), 0) AS nbr_total_de_boeux 
			FROM donneurs d LEFT JOIN avoir a ON d.id = a.id_don 
			GROUP BY d.id ORDER BY d.id DESC";

	$result_requete_donneurs = $pdo->query($requete_donneurs);
	$tous_les_donneurs = $result_requete_donneurs->fetchAll();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title> Les donneurs </title> 
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
		
	</head>
		
	<body>
	
		<?php include('../menu.php'); ?>
		<br><br><br><br>
		<div class="container">

			<h1 class="text-center"> Liste des donneurs </h1>
			<div class="panel panel-primary">
				<div class="panel-heading">Rechecher les donneurs</div>
				<div class="panel-body">

<!-- ******************** Début Formulaire de recherche des donneurs ***************** -->
					<form class="form-inline" method="post" >
						<input type="text" name="q" id="q" class="form-control lg" placeholder="Recherche par nom">
						
							<button type="" name="" class="btn btn-primary"> 
								<span class="fa fa-search"></span>
							</button>
					</form>
<!-- ******************** Fin Formulaire de recherche des donneurs ***************** -->

			
				</div>
			</div>

			<table class="table table-striped">
				<thead>
					<tr>
						<th>N°</th><th>Nom</th><th>Sexe</th><th>Total des boeux restants</th> <th>Nombre total de boeux</th>
						<?php if($_SESSION['user']['role']=='Administrateur'){  ?>
							<th> Actions </th>
						<?php } ?>
						
					</tr>
				</thead>
				
				<tbody id="tbody">
			
					<?php foreach($tous_les_donneurs as $le_donneur){?>
						<tr>
							<td><?php echo $i += 1 ?> </td>
							<td><?php echo $le_donneur['nomDon'] ?> </td>
							<td><?php echo $le_donneur['sexe'] ?> </td>
							<td><?php echo $le_donneur['nbrB'] ?> </td>
							<td><?php echo $le_donneur['nbr_total_de_boeux'] ?> </td>
							<?php if($_SESSION['user']['role']=="Administrateur"){?>
								<td>
									<a href="page_edit_donneur.php?id=<?php echo $le_donneur['id'] ?>"
									class="btn btn-success btn-edit-delete"> 
										<span class="fa fa-edit"></span>
									</a>
									&nbsp&nbsp
									<a onclick='return confirm("Etes-vous sûr de vouloir supprimer ?")'
											href="delete_donneur.php?id=<?php echo $le_donneur['id'] ?>"
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
				<a href="page_add_donneur.php" class="btn btn-primary">
					<span class="fa fa-plus"></span> NOUVEAU DONNEUR 
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
						data: { q_d: recherche },
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
												<td>${resultat.sexe}</td>
												<td>${resultat.nbrB}</td>
												<td>${resultat.nbr_total_de_boeux}</td>
												<?php if($_SESSION['user']['role']=="Administrateur"){?>
													<td>
														<a href="page_edit_donneur.php?id=${resultat.id}"
														class="btn btn-success btn-edit-delete"> 
															<span class="fa fa-edit"></span>
														</a>
														&nbsp&nbsp
														<a onclick='return confirm("Etes-vous sûr de vouloir supprimer ?")'
																href="delete_donneur.php?id=${resultat.id}"
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