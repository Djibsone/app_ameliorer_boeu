	<?php
		require('../utilisateurs/ma_session.php');
		require('../utilisateurs/mon_role.php');
	?>

<?php

	require('../connexion.php');
	
	$id_donneur=$_GET['id'];
	
	
	
	$requete="DELETE from donneurs where id=?";
	
	$valeur=array($id_donneur);
					
	$resultat=$pdo->prepare($requete);
	$resultat->execute($valeur);
	
	$msg= "Donneur supprimé avec succés";
	$url="donneurs/page_les_donneurs.php";		
	header("location:../message.php?msg=$msg&color=v&url=$url");
	 
?>
