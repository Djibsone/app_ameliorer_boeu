
	<?php
		require('../utilisateurs/ma_session.php');
		require('../utilisateurs/mon_role.php');
	?>

<meta charset="utf-8"/>
<?php


	require('../connexion.php');
	
	$id=$_POST['id'];
	$nom=$_POST['nom'];
	$sexe=$_POST['sexe'];
	$nombre=$_POST['nombre'];

	//getDonneur
	$stmt = $pdo->prepare("SELECT * FROM donneurs WHERE id = ?");
    $stmt->execute(array($id));
	$data = $stmt->fetch();
	$ajout = $data['nbrB'] + $nombre;
	
	$resultat=$pdo->prepare("UPDATE donneurs SET nomDon=?,sexe=?,nbrB=? where id=?");
	$resultat->execute(array($nom,$sexe,$ajout,$id));
	
	$msg= "Donneur modifié avec succes";
	$url="donneurs/page_les_donneurs.php";
	header("location:../message.php?msg=$msg&color=v&url=$url");
?>
