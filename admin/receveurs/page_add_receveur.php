	<?php
		require('../utilisateurs/ma_session.php');
	?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>  Les Receveurs </title> 
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">	
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">

	</head>
		
	<body>
		<?php include('../menu.php'); ?>
        <br><br><br><br><br><br>
        
		<div class="container">
			<div class="panel panel-success">
				<div class="panel-heading" align="center">  <h3 >Nouveau receveur </h3>  </div>
					<div class="panel-body">
						<form method="post" action="insert_receveur.php">
                            
                            <!-- ************ Début  Nom: *************** -->
                            <div class="row my-row">
								<label for="nom" class="control-label col-sm-2">NOM COMPLET DU RECEVEUR</label> 
									<div class="col-sm-4">
										<input type="text" name="nom" id="nom" class="form-control" required> 
									</div>

							<!-- ************ Fin  nom: *************** -->
                            
                            <!-- ************ Début  sexe: *************** -->	

								<label for="sexe" class="control-label col-sm-2">SEXE</label> 
								<div class="col-sm-4">
									<select class="form-control" name="sexe">
										<option>Sélectionner le sexe</option>
										<option>M</option>
										<option>F</option>
									</select>
								</div>

							</div>
							<!-- ************ Fin  sexe: *************** -->
                            
                            <!-- ************ Début  localite: *************** -->
                            <div class="row my-row">
								<label for="localite"class="control-label col-sm-2">LOCALITE DU RECEVEUR</label>
									<div class="col-sm-4">								
								        <input type="text" name="localite" id="localite"class="form-control" required> 
									</div>

							<!-- ************ Fin localite: *************** -->

							<button type='submit' class="btn btn-success btn-block"> 
								Enregistrer  <span class="fa fa-save"></span>
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
