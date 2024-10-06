
<?php

	$id		=$_SESSION['user']['id_utilisateur'];
	$login	=$_SESSION['user']['login'];
	$role	=$_SESSION['user']['role'];

?>

	<nav class="navbar navbar-inverse navbar-fixed-top">

		<div class="navbar-header">
				<a  class="navbar-brand" href="../../index.php">
					<span class="fa fa-paw"></span>
						Gestion des boeux
				</a>
		</div>

		<ul class="nav navbar-nav">

			<li> 
				<a href="../donneurs/page_les_donneurs.php">      
					<span class="fa fa-gift"></span> 
					 Les Donneurs
				</a> 
			</li>
			<li> 
				<a href="../receveurs/page_les_receveurs.php">       
					<span class="fa fa-hand-paper-o"></span> 
					Les Receveurs 
				</a> 
			</li>
			<li> 
				<a href="../donnes_receves/page_les_donnes_receves.php">           
					<span class="fa fa-exchange"></span>  
					Les Donnneurs et Receveurs 
				</a> 
			</li>
			<?php if($role=="Administrateur"){?>
				<li>
					<a href="../utilisateurs/page_les_utilisateurs.php">   
						<span class="fa fa-users"></span> 
						Les Utilisateurs 
					</a>
				</li>
			<?php } ?>
			<li> 
				<a href="#" class="theme">    
					<span class="fa fa-moon-o nuit"></span>
					<span class="fa fa-sun-o clair"></span>
				</a> 
			</li>	
			
		</ul>

		<ul class="nav navbar-nav navbar-right">
		
			<li class="dropdown">
			
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="fa fa-user-circle-o"></span>&nbsp
						<?php echo $login ?>
					<span class="caret"></span>
				</a>
				
				<ul class="dropdown-menu">
					<li>
						<a href="../utilisateurs/page_edit_utilisateur.php?id=<?php echo $id ?>">
							<span class="fa fa-vcard-o"></span>&nbsp
							Mon Compte
						</a>
					</li>
					<li>
						<a href="../utilisateurs/seDeconnecter.php">
							<span class="fa fa-sign-out"></span>&nbsp
							Se déconnecter
						</a>
					</li>
				</ul>
				
			</li>
				
		</ul>


	</nav>

