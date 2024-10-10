	<?php
		//require('../utilisateurs/ma_session.php');
		session_start();
		
	?>

<html>
	<head>
		<meta charset="utf-8">
		
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">	
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">		
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		
	</head>
	
	<body>
		<?php if($_SESSION['user']){  ?>	
			<?php include('../menu.php') ?>
		<?php } ?>
		<br><br><br><br><br><br>
		
		<div class="container col-md-6 col-md-offset-3">
		
			<div class="panel panel-primary">
				<div class="panel-heading">
					<a href="javascript:history.back()" style="text-decoration: none; color: inherit;">
						<i class="fa fa-arrow-left" style="cursor: pointer; margin-right: 10px;"></i>
					</a>
					Nouvel utilisateur
				</div>
				<div class="panel-body">
				
					<form class="form" action="insert_utilisateur.php" method="post">
					
						<div class="form-group">
							<label for="login" class="label-control">Login</label>
							<input type="text" name="login" id="login" 
							class="form-control" autocomplete="off" required>
							
						</div>						
						
						<?php if(isset($_SESSION['user']) && $_SESSION['user']['role']=="Administrateur") {?>
							<div class="form-group">
								<label for="role" class="label-control">Role</label>
								<select class="form-control" name="role">
									<option> Visiteur </option>
									<option> Administrateur </option>
								</select>
							</div>
						<?php } ?>
						
						
						<div class="form-group">
							<label for="email" class="label-control">Email</label>
							<input type="email" name="email" autocomplete="off"  id="email" 
							class="form-control" required>						
							
						</div>

						<div class="form-group">
							<label for="pwd" class="label-control">Mot de passe</label>
							
							<input type="password" name="pwd" id="pwd" 
								class="form-control pwd" required autocomplete="off"/>                             
								<span class="fa fa-eye-slash fa-2x oeil" id="oeil"></span>
								
						</div>
						<br>
						<input type="submit" value="Enregistrer" class="btn btn-primary btn-block">
						<br>

						<?php if(empty($_SESSION['user'])){?>
							<a href="login.php">Se connecter</a>
						<?php } ?>
						
					</form>
				</div>
			</div>
			
		</div>
		
		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/script.js"></script>
	</body>
</html>