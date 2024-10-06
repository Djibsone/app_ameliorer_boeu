
<?php
	require('../utilisateurs/ma_session.php');
	require('../utilisateurs/mon_role.php');
	
?>

<?php
	
	
	require('../connexion.php');
	
	$id_donne_receve=$_GET['id'];		
	
	$requete="DELETE FROM avoir where id=?";
	
	$valeur=array($id_donne_receve);
	
	$resultat=$pdo->prepare($requete);
	
	$resultat->execute($valeur);
	
	$msg= "Supprimé avec succès";
	$url="donnes_receves/page_les_donnes_receves.php";		
	header("location:../message.php?msg=$msg&color=v&url=$url");
	
	
?>