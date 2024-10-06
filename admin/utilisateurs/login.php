<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Se connecter</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
	</head>
	<body>		
		<br><br><br><br><br>
		<div class="container col-md-4 col-md-offset-4">			
			<div class="panel panel-primary">
				<div class="panel-heading">Se connecter</div>
				<div class="panel-body">
					<form method="post" action="seConnecter.php" class="form">
									
						<div class="form-group">
							<label for="login" class="label-control">Login</label>
							<input type="text" name="login" id="login" 
							class="form-control" autocomplete="off" required>
							
						</div>
						<div class="form-group">
							<label for="pwd" class="label-control">Mot de passe</label>
							
							<input type="password" name="pwd" id="pwd" 
								class="form-control pwd" required autocomplete="off"/>                             
								<span class="fa fa-eye-slash fa-2x oeil" id="oeil"></span>
								
						</div>
							
						<button type="submit" class="btn btn-primary btn-block">Se connecter</button>
						<br>
						
						<a href="page_add_utilisateur.php">Créer mon compte</a>
						&nbsp&nbsp&nbsp&nbsp&nbsp
						<a href="page_demande_pwd.php">Mot de passe oublié</a>
						
					</form>
				</div>
			</div>			
		</div>

		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/script.js"></script>
	</body>
</html>