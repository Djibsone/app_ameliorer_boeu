<?php
require('../connexion.php');
include('../fonctions.php');

if (isset($_POST['login']))
    $login = $_POST['login'];
else
    $login = '';

if (isset($_POST['role']))
    $role = $_POST['role'];
else
    $role = 'Visiteur';

if (isset($_POST['pwd']))
    $pwd = $_POST['pwd'];
else
    $pwd = '';

if (isset($_POST['email']))
    $email = $_POST['email'];
else
    $email = '';

$errors = [];

if (!verifierCaractereSpeciaux($login)) {
    $errors[] = "Les donées non valides ont été saisies.";
}

if (strlen($pwd) < 8) {
    $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
}

if (!empty($errors)) {
    $msg = implode("<br>", $errors);
    $url = "utilisateurs/page_add_utilisateur.php";
    header("location:../message.php?msg=$msg&color=r&url=$url");
    exit();
}

$pwdHashed = password_hash($pwd, PASSWORD_DEFAULT);

$nbr_user = recherche_user_byLogin($email);

if ($nbr_user == 0) {
    $requete = $pdo->prepare("INSERT INTO utilisateur VALUES(?,?,?,?,?)");
    $valeurs = array(NULL, $login, $pwdHashed, $role, $email);
    $resultat = $requete->execute($valeurs);

    $msg = "Utilisateur ajouté avec succès";
    $url = "utilisateurs/page_les_utilisateurs.php";        
    header("location:../message.php?msg=$msg&color=v&url=$url");
} else {
    $msg = "Le l'email ou le mot de passe incorrect";
    $url = "utilisateurs/page_add_utilisateur.php";
    header("location:../message.php?msg=$msg&color=r&url=$url");
}
?>
