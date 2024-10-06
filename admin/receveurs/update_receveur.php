
	<?php
		require('../utilisateurs/ma_session.php');
		require('../utilisateurs/mon_role.php');
	?>
	
<?php

	require('../connexion.php');
	
	$id=$_POST['id'];
	$nom=$_POST['nom'];
	$sexe=$_POST['sexe'];
	$localite=$_POST['localite'];
    
	$requete="UPDATE  receveurs SET nomRe=?,
                                sexeR=?,
                                localite=?
                            	WHERE id=?";
    $valeurs=array( $nom,
                    $sexe,
                    $localite,
					$id);
					
	$resultat=$pdo->prepare($requete);
	$resultat->execute($valeurs);
	
	$msg= "Réceveur modifié avec succès";
	$url= "receveurs/page_les_receveurs.php";		
	header("location:../message.php?msg=$msg&color=v&url=$url");
	
?>
