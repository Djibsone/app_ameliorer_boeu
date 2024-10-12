<?php
require '../connexion.php';

if (isset($_POST['email']) && !empty($_POST['email'])) {
    $email = $_POST['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "<strong>Erreur!</strong> Format d'adresse email invalide!";
        $url = 'utilisateurs/page_demande_pwd.php';
        header('location:../message.php?msg=' . urlencode($msg) . "&color=r&url=$url");
        exit();
    }
} else {
    $msg = '<strong>Erreur!</strong> Veuillez saisir votre adresse mail!';
    $url = 'utilisateurs/page_demande_pwd.php';
    header('location:../message.php?msg=' . urlencode($msg) . "&color=r&url=$url");
    exit();
}

$requete = 'SELECT * FROM utilisateur WHERE email = ?';
$valeur = [$email];
$resultat = $pdo->prepare($requete);
$resultat->execute($valeur);

$nbr_user = $resultat->rowCount();

if ($nbr_user > 0) {
    $user = $resultat->fetch();

    $id = $user['id_utilisateur'];
    $newpwd = '0000';

    $requete_update = $pdo->prepare('UPDATE utilisateur SET pwd = ? WHERE id_utilisateur = ?');
    $valeurs_update = [$newpwd, $id];
    $requete_update->execute($valeurs_update);

    $to = $user['email'];
    $subject = 'INITIALISATION DE MOT DE PASSE';
    $txt = 'Votre nouveau mot de passe est : ' . $newpwd;
    $headers = 'From: Gestion des boeux' . "\r\n" . 'CC: gestionstagiaire2018@gmail.com';

    mail($to, $subject, $txt, $headers);

    $msg = 'Votre mot de passe a été initialisé avec succès.<br> Veuillez consulter votre email.';
    $url = 'utilisateurs/login.php';
    header('location:../message.php?msg=' . urlencode($msg) . "&color=v&url=$url");
    exit();
} else {
    $msg = "<strong>Erreur!</strong> L'Email est incorrect!";
    $url = 'utilisateurs/page_demande_pwd.php';
    header('location:../message.php?msg=' . urlencode($msg) . "&color=r&url=$url");
    exit();
}

?>
