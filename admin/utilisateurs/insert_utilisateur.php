<!-- <php 
	require('../connexion.php');
	
	if(isset($_POST['login']))
		$login=$_POST['login'];
	else
		$login='';
		
	if(isset($_POST['role']))
		$role=$_POST['role']; 
	else
		$role='Visiteur';
		
	if(isset($_POST['pwd']))
		$pwd=sha1($_POST['pwd']);
	else
		$pwd='';
	
	if(isset($_POST['email']))
		$email=$_POST['email'];
	else
		$email='';
	
	include('../fonctions.php');
	
	$nbr_user=recherche_user_byLogin($login);
	
	// le nombre des utilisateurs avec le meme login
	
	if($nbr_user==0){ //Aucun utilisateur n'utilise ce login
	
		$requete=$pdo->prepare("INSERT INTO utilisateur VALUES(?,?,?,?,?)");
		$valeurs=array(NULL,$login,$pwd,$role,$email);
		$resultat=$requete->execute($valeurs);
		
		$msg= "Utilisateur Ajouté avec sucées";
		$url="utilisateurs/page_les_utilisateurs.php";		
		header("location:../message.php?msg=$msg&color=v&url=$url");		
		
	}else{ // Le login est déja utilisé par un autre utilisateur
	
		$msg="Le login $login est déja utilisé par un autre utlisateur";
		$url="utilisateurs/page_add_utilisateur.php";
		header("location:../message.php?msg=$msg&color=r&url=$url");
		
	}
	
	
?> -->

<?php
    require('../connexion.php');
	 include('../fonctions.php');
    
    if(isset($_POST['login']))
        $login = $_POST['login'];
    else
        $login = '';
        
    if(isset($_POST['role']))
        $role = $_POST['role']; 
    else
        $role = 'Visiteur';
        
    if(isset($_POST['pwd']))
        $pwd = $_POST['pwd'];
    else
        $pwd = '';
    
    if(isset($_POST['email']))
        $email = $_POST['email'];
    else
        $email = '';

    // Vérification des règles de validation
    $errors = [];

    // Vérification que le login ne contient que des lettres et des chiffres
    if (!preg_match('/^[a-zA-Z0-9]+$/', $login)) {
        $errors[] = "Le login ne doit contenir que des lettres et des chiffres sans caractères spéciaux.";
    }

    // Vérification de la longueur du mot de passe (minimum 8 caractères)
    if (strlen($pwd) < 8) {
        $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
    }

    // Si des erreurs existent, les afficher et arrêter le script
    if (!empty($errors)) {
        $msg = implode("<br>", $errors);
        $url = "utilisateurs/page_add_utilisateur.php";
        header("location:../message.php?msg=$msg&color=r&url=$url");
        exit();
    }

    // Hachage du mot de passe
    $pwdHashed = password_hash($pwd, PASSWORD_DEFAULT);
    
    $nbr_user = recherche_user_byLogin($login);
    
    // Vérification de l'unicité du login
    if ($nbr_user == 0) { // Aucun utilisateur n'utilise ce login
    
        $requete = $pdo->prepare("INSERT INTO utilisateur VALUES(?,?,?,?,?)");
        $valeurs = array(NULL, $login, $pwdHashed, $role, $email);
        $resultat = $requete->execute($valeurs);
        
        $msg = "Utilisateur ajouté avec succès";
        $url = "utilisateurs/page_les_utilisateurs.php";        
        header("location:../message.php?msg=$msg&color=v&url=$url");
        
    } else { // Le login est déjà utilisé par un autre utilisateur
    
        $msg = "Le login $login est déjà utilisé par un autre utilisateur";
        $url = "utilisateurs/page_add_utilisateur.php";
        header("location:../message.php?msg=$msg&color=r&url=$url");
        
    }
?>
