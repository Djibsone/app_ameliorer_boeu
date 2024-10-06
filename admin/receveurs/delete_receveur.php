	<?php
		require('../utilisateurs/ma_session.php');
		require('../utilisateurs/mon_role.php');
	?>
	
<?php
	
	require('../connexion.php');
	
	$id=$_GET['id'];		
	
	$requete="DELETE FROM receveurs where id=?";
	
	$valeur=array($id);
	
	$resultat=$pdo->prepare($requete);
	
	$resultat->execute($valeur);
	
	$msg= "Réceveur supprimé avec succès";
	$url="receveurs/page_les_receveurs.php";		
	header("location:../message.php?msg=$msg&color=v&url=$url");
	
?>