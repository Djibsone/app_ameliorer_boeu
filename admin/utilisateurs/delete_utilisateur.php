
	<?php
		require('../utilisateurs/ma_session.php');
		require('../utilisateurs/mon_role.php');
	?>
<?php 
		require('../connexion.php');
		
		
		$id_udser=$_GET['id'];
		
		$requete="DELETE FROM utilisateurs where id_utilisateur=?";		
		
		$requete=$pdo->prepare($requete);		
		
		$resultat=$requete->execute(array($id_udser));
		
		
		$msg= "Utilisateur Supprimé avec sucées";
		$url= "utilisateurs/page_les_utilisateurs.php";		
		header("location:../message.php?msg=$msg&color=v&url=$url");
		
?>