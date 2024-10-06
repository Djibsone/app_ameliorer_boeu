<!-- <php
	session_start();
	
	require('../connexion.php');
	
	$login=$_POST['login'];
	$pwd=sha1($_POST['pwd']);
	
	include('../fonctions.php');
		
	$user=recherche_user_byLoginPwd($login,$pwd); 		
		
	if($user!=0){ // l'utilisateur existe

		if ($user['login']===$login && $user['pwd']===$pwd) {
			//password_verify('rasmuslerdorf', $hash)

			$_SESSION['user']=$user; 
			//La variable $_SESSION['user']est un tableau contenant:
			//l'id_utilisateur,login,pwd et role de l'utilisateur 
		
        	header("Location:../dashboard/dashboard.php");

		} else {

			$msg="Le login ou le mot de passe incorrecte";
			$url="utilisateurs/login.php";
			header("location:../message.php?msg=$msg&color=r&url=$url");
		}
		
		
    }else{ //l'utilisateur n'existe pas
	
		$msg="Le login ou le mot de passe incorrecte";
		$url="utilisateurs/login.php";
		header("location:../message.php?msg=$msg&color=r&url=$url");
		 
    } 
	
?> -->

<?php
    session_start();
    require('../connexion.php');
	include('../fonctions.php');
    
    $login = $_POST['login'];
    $pwd = $_POST['pwd'];  // Mot de passe en clair soumis par l'utilisateur
    
    // Recherche de l'utilisateur par login (sans hachage pour le moment)
    $user = recherche_user_byLogin($login);  // Assure-toi que cette fonction récupère le mot de passe haché
    
    if ($user) { // l'utilisateur existe
        // Vérification du mot de passe en utilisant password_verify
        if (password_verify($pwd, $user['pwd'])) { 
            // Mot de passe correct, l'utilisateur est authentifié
            
            $_SESSION['user'] = $user; 
            // Redirection vers le tableau de bord
            header("Location:../dashboard/dashboard.php");
        } else {
            // Mot de passe incorrect
            $msg = "Le login ou le mot de passe est incorrect";
            $url = "utilisateurs/login.php";
            header("location:../message.php?msg=$msg&color=r&url=$url");
        }
    } else { 
        // L'utilisateur n'existe pas
        $msg = "Le login ou le mot de passe est incorrect";
        $url = "utilisateurs/login.php";
        header("location:../message.php?msg=$msg&color=r&url=$url");
    }
?>
