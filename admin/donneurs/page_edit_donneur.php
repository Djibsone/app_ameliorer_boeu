	<?php
		require('../utilisateurs/ma_session.php');
		require('../utilisateurs/mon_role.php');
	?>

	<?php
		require('../connexion.php');
		
		$id_doneur=$_GET['id'];							 
		//$annee_scolaire=$_GET['annee_scolaire'];

		$requete="SELECT * FROM donneurs WHERE id=?";

		$identite_donneur=$pdo->prepare($requete);

		$identite_donneur->execute(array($id_doneur));		
		$le_donneur=$identite_donneur->fetch();
		

	?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>  Modifier la stagiaire</title> 
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">

	</head>
		
	<body>
	<?php include('../menu.php'); ?>
	<br><br><br><br><br><br>
	
		<div class="container">
<!-- ******************** Début Identité du donneur ************** -->
			<div class="panel panel-primary">
				<div class="panel-heading" align="center">Modifier donneur</div>
					<div class="panel-body">
						<form method="post" action="update_donneur.php">
							
							<input type="hidden" name="id" id="id" class="form-control"
										value="<?php echo $le_donneur['id']; ?>">

                            <div class="row my-row">
								<label for="nom" class="control-label col-sm-2">NOM COMPLET</label> 
								<div class="col-sm-4">
									<input type="text" name="nom" id="nom" class="form-control"
									value="<?php echo $le_donneur['nomDon']; ?>"> 
								</div>

								<label class="control-label col-sm-2">SEXE</label>
								<div class="col-sm-4">
									<select class="form-control" name="sexe">
										<option><?php echo ($le_donneur['sexe']) ? $le_donneur['sexe'] : 'Sélectionner le sexe'; ?></option>
										<option>M</option>
										<option>F</option>
									</select>
								</div>

							</div>

                            <div class="row my-row">
								<label for="nombre"class="control-label col-sm-2">NOMBRE DE BOEUX</label>
								<div class="col-sm-4">
									<input type="text" name="nombre" id="nombre"class="form-control" 
									value="<?php echo $le_donneur['nbrB']; ?>">
								</div>

							</div>

							<button type='submit' 
									class="btn btn-primary btn-block"> Enregistrer <span class="fa fa-save"></span>
							</button> 
						</form>	
					</div>
			</div>

		</div>

		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/script.js"></script>
	</body>
</html>