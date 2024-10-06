	<?php
		require('../utilisateurs/ma_session.php');
		
	?>

<?php

	require('../connexion.php');
		
	$nom=$_POST['nom'];
	$sexe=$_POST['sexe'];
	$localite=$_POST['localite'];

	$requete_insert_receveur="INSERT INTO receveurs(nomRe,sexeR,localite) VALUES(?,?,?)";
	$valeurs_insert_receveur=array(
                        $nom,
                        $sexe,
                        $localite);
					
	$resultat_insert_receveur=$pdo->prepare($requete_insert_receveur);
	$resultat_insert_receveur->execute($valeurs_insert_receveur);
	
	$msg= "Réceveur ajouté avec succès";
	$url= "receveurs/page_les_receveurs.php";		
	header("location:../message.php?msg=$msg&color=v&url=$url");
	
?>
