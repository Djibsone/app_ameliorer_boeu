<?php
require '../utilisateurs/ma_session.php';
require '../utilisateurs/mon_role.php';
require '../connexion.php';

$id_donne_receve = $_GET['id'];

if (empty($id) || !is_numeric($id)) {
    $msg = 'Donnée non identifié';
    $url = 'donnes_receves/page_les_donnes_receves.php';
    header("location:../message.php?msg=$msg&color=r&url=$url");
}

$requete = 'DELETE FROM avoir WHERE id=?';

$valeur = [$id_donne_receve];

$resultat = $pdo->prepare($requete);

$resultat->execute($valeur);

$msg = 'Supprimé avec succès';
$url = 'donnes_receves/page_les_donnes_receves.php';
header("location:../message.php?msg=$msg&color=v&url=$url");

?>
