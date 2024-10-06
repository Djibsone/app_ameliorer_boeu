	<?php
		require('../utilisateurs/ma_session.php');
	?>

<?php 
		require('../connexion.php');			
		
		$id_udser=$_POST['id_udser'];
		$login=$_POST['login'];
		$pwd=$_POST['pwd'];
		
		//getUser
		$stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = ?");
		$stmt->execute(array($id_udser));
		$data = $stmt->fetch();

		if(isset($_POST['role']))
			$role=$_POST['role']; 
		else
			$role='Visiteur';

		if ($pwd == $data['pwd'])
			$pwd = $data['pwd']; 
		else 
			$pwd = sha1($_POST['pwd']);
		
		$email=$_POST['email'];
		
		include('../fonctions.php');
		
		$nbr_user=recherche_user_byLoginId($login,$id_udser);
		
		if($nbr_user==0){ //utilisateur n'existe pas
		
			$requete=$pdo->prepare("UPDATE utilisateur SET login=?,pwd=?,role=?,email=? 
									where id_utilisateur=?");
									
			$valeurs=array($login,$pwd,$role,$email,$id_udser);			
			$resultat=$requete->execute($valeurs);
			
			$msg= "Utilisateur modifié avec sucées";
			$url="utilisateurs/page_les_utilisateurs.php";		
			header("location:../message.php?msg=$msg&color=v&url=$url");
		}
		else{
			
			$msg= "Le login $login est déja utilisé par un autre utilisateur";
			$url="utilisateurs/page_edit_utilisateur.php?id=$id_udser";		
			header("location:../message.php?msg=$msg&color=r&url=$url");
		}
		
		
		
?>