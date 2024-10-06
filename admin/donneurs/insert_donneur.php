	<?php
		require('../utilisateurs/ma_session.php');
		require('../utilisateurs/mon_role.php');
	?>

<?php

	require('../connexion.php');
	
	$nom=$_POST['nom'];
	$sexe=$_POST['sexe'];
	$nombre=$_POST['nombre'];

	//si le nbre entré < 0 ? on le transforme en positif : le nbre entré
	if($nombre<0)
		$nombre = - $nombre;
	else
		$nombre = $nombre;

	$requete_insert="INSERT INTO donneurs(nomDon,sexe,nbrB) VALUES(?,?,?)";
	$valeurs_insert=array($nom,$sexe,$nombre);
					
	$resultat_insert=$pdo->prepare($requete_insert);
	$resultat_insert->execute($valeurs_insert);
	
	$msg= "Donneur ajouté avec succès";
	$url="donneurs/page_les_donneurs.php";		
	header("location:../message.php?msg=$msg&color=v&url=$url");
	
	
?>
