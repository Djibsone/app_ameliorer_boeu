<?php
require '../utilisateurs/ma_session.php';
require '../utilisateurs/mon_role.php';

require '../connexion.php';

$id_udser = $_GET['id'];
if (empty($id) || !is_numeric($id)) {
    $msg = 'Utilisateur non identifié';
    $url = 'utilisateurs/page_les_utilisateurs.php';
    header("location:../message.php?msg=$msg&color=r&url=$url");
}

$requete = 'DELETE FROM utilisateurs WHERE id_utilisateur=?';

$requete = $pdo->prepare($requete);

$resultat = $requete->execute([$id_udser]);

$msg = 'Utilisateur Supprimé avec sucées';
$url = 'utilisateurs/page_les_utilisateurs.php';
header("location:../message.php?msg=$msg&color=v&url=$url");

?>
