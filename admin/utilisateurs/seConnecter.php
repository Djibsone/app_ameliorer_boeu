<?php
session_start();
require '../connexion.php';
include '../fonctions.php';

$login = $_POST['login'];
$pwd = $_POST['pwd'];

$user = recherche_user_byLogin($login);

if ($user) {
    if (password_verify($pwd, $user['pwd'])) {
        $_SESSION['user'] = $user;

        header('Location:../dashboard/dashboard.php');
    } else {
        $msg = 'Le login ou le mot de passe est incorrect';
        $url = 'utilisateurs/login.php';
        header("location:../message.php?msg=$msg&color=r&url=$url");
    }
} else {
    $msg = 'Le login ou le mot de passe est incorrect';
    $url = 'utilisateurs/login.php';
    header("location:../message.php?msg=$msg&color=r&url=$url");
}
?>
