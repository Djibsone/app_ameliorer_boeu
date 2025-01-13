<?php
require '../utilisateurs/ma_session.php';

require '../connexion.php';

$id_udser = $_POST['id_udser'];
$login = $_POST['login'];

if (isset($_POST['role'])) {
    $role = $_POST['role'];
} else {
    $role = 'Visiteur';
}

include '../fonctions.php';

$nbr_user = recherche_user_byLoginId($login, $id_udser);

if ($nbr_user == 0) {
    $requete = $pdo->prepare('UPDATE utilisateur SET login=?,role=? WHERE id_utilisateur=?');

    $valeurs = [$login, $role, $id_udser];
    $resultat = $requete->execute($valeurs);

    $msg = 'Utilisateur modifié avec sucées';
    $url = 'utilisateurs/page_les_utilisateurs.php';
    header("location:../message.php?msg=$msg&color=v&url=$url");
} else {
    $msg = "Le login $login est déja utilisé par un autre utilisateur";
    $url = "utilisateurs/page_edit_utilisateur.php?id=$id_udser";
    header("location:../message.php?msg=$msg&color=r&url=$url");
}

?>
