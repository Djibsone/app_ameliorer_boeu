<?php
require '../utilisateurs/ma_session.php';
require '../utilisateurs/mon_role.php';

require '../connexion.php';
include '../fonctions.php';

$id = $_POST['id'];
$nom = $_POST['nom'];
$sexe = $_POST['sexe'];
$localite = $_POST['localite'];
 
 $tableau = [$nom, $sexe, $localite];
 
 
 if (!verifierCaractereSpeciaux($tableau)) {
     $msg = urlencode('Les données saisies ne sont pas valides');
     header("location:../message.php?msg=$msg&color=r");
     exit(); 
 } else {     
    $requete = 'UPDATE  receveurs SET nomRe = ?, sexeR = ?, localite = ? WHERE id = ?';
    $valeurs = [$nom, $sexe, $localite, $id];
 
    $resultat = $pdo->prepare($requete);
 
    if ($resultat->execute($valeurs)) {
        $msg = urlencode('Réceveur modifié avec succès');
        $url = urlencode('receveurs/page_les_receveurs.php');
        header("location:../message.php?msg=$msg&color=v&url=$url");
    } else {
        $msg = urlencode('Erreur lors de la modification du réceveur');
        header("location:../message.php?msg=$msg&color=r");
    }
    exit();
 }

?>
