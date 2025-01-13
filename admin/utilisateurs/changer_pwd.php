<?php
require '../utilisateurs/ma_session.php';
require '../connexion.php';

$id_udser = $_POST['id_udser'];
$oldpwd = trim($_POST['oldpwd']);
$newpwd = trim($_POST['newpwd']);
$cpwd = trim($_POST['cpwd']);

$errors = [];

if (strlen($oldpwd) < 8 || strlen($newpwd) < 8 || strlen($cpwd) < 8) {
    $errors[] = "Les mots de passe doivent contenir au moins 8 caractères.";
}

if ($newpwd !== $cpwd) {
    $errors[] = "Les nouveaux mots de passe ne sont pas identiques.";
}

if (!empty($errors)) {
    $msg = implode("<br>", $errors);
    $url = "utilisateurs/page_edit_mdp_utilisateur.php?id=$id_udser";
    header("location:../message.php?msg=$msg&color=r&url=$url");
    exit();
}

$stmt = $pdo->prepare('SELECT * FROM utilisateur WHERE id_utilisateur = ?');
$stmt->execute([$id_udser]);
$data = $stmt->fetch();

if (!$data) {
    $msg = 'Utilisateur non trouvé';
    $url = 'utilisateurs/page_edit_utilisateur.php';
    header("location:../message.php?msg=$msg&color=r&url=$url");
    exit();
}

if (!password_verify($oldpwd, $data['pwd'])) {
    $msg = 'L\'ancien mot de passe ne correspond pas';
    $url = "utilisateurs/page_edit_mdp_utilisateur.php?id=$id_udser";
    header("location:../message.php?msg=$msg&color=r&url=$url");
    exit();
}

$pwdHashed = password_hash($newpwd, PASSWORD_DEFAULT);
$requete = $pdo->prepare("UPDATE utilisateur SET pwd = ? WHERE id_utilisateur = ?");
$requete->execute([$pwdHashed, $id_udser]);

$msg = 'Le mot de passe a été changé, veuillez vous reconnecter';
$url = 'utilisateurs/seDeconnecter.php';
header("location:../message.php?msg=$msg&color=v&url=$url");
exit();
?>
