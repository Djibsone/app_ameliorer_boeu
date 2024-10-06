	<?php
		require('../utilisateurs/ma_session.php');
		require('../utilisateurs/mon_role.php');
	?>


<?php 
	
		
	require('../connexion.php');
	
	$requete="select * from utilisateur";
	$resultat=$pdo->query($requete);
	$les_utilisateurs=$resultat->fetchAll();
	global $i;
?>

<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">

	</head>
	<body>
		<?php include('../menu.php') ?>
		<br><br><br><br><br><br>

		<div class="container">
			<div class="panel panel-primary">
				<div class="panel-heading">Liste des utilisateurs</div>
				<div class="panel-body">
					<table class="table table-striped table-bordered">
						<thead>
							<th>N°</th>
							<th>LOGIN</th>
							<th>ROLE</th>
							<th>Email</th>
							<?php if($_SESSION['user']['role']=="Administrateur"){?>
								<th>ACTIONS</th>
							<?php } ?>
							
						</thead>
							
						<tbody>
						<?php foreach($les_utilisateurs as $utilisateur){ ?>
								<tr>
									<td><?php echo $i += 1 ?></td>
									<td><?php echo $utilisateur['login'] ?></td>
									<td><?php echo $utilisateur['role'] ?></td>
									<td><?php echo $utilisateur['email'] ?></td>
									<?php if($_SESSION['user']['role']=="Administrateur"){?>
										<td>
											<a href="page_edit_utilisateur.php?id=<?php echo $utilisateur['id_utilisateur'] ?>"
											class="btn btn-success btn-edit-delete"> 
												<span class="fa fa-edit"></span>
											</a>
											&nbsp&nbsp
											<a onclick='return confirm("Etes-vous sûr ???")'
													href="delete_utilisateur.php?id=<?php echo $utilisateur['id_utilisateur'] ?>"
													class="btn btn-danger btn-edit-delete">
												<span class="fa fa-trash"></span>
											</a>
										
										</td>
									<?php } ?>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<?php if($_SESSION['user']['role']=="Administrateur"){?>
				<a class="btn btn-primary" href="page_add_utilisateur.php"><span class="fa fa-plus"></span> NOUVEL UTILISATEUR</a>
			<?php } ?>
			
		</div>

		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/script.js"></script>
	</body>

</html>