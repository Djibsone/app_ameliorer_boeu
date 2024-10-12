<?php
 require '../utilisateurs/ma_session.php';
 require '../connexion.php';
 include '../fonctions.php';

 $nom = $_POST['nom'];
 $sexe = $_POST['sexe'];
 $localite = $_POST['localite'];
 
 $tableau = [$nom, $sexe, $localite];
 
 
 if (!verifierCaractereSpeciaux($tableau)) {
     $msg = urlencode('Les données saisies ne sont pas valides');
     header("location:../message.php?msg=$msg&color=r");
     exit(); 
 } else {     
     $requete_insert_receveur = 'INSERT INTO receveurs(nomRe,sexeR,localite) VALUES(?,?,?)';
     $valeurs_insert_receveur = [$nom, $sexe, $localite];
 
     $resultat_insert_receveur = $pdo->prepare($requete_insert_receveur);
 
     if ($resultat_insert_receveur->execute($valeurs_insert_receveur)) {
         $msg = urlencode('Réceveur ajouté avec succès');
         $url = urlencode('receveurs/page_les_receveurs.php');
         header("location:../message.php?msg=$msg&color=v&url=$url");
     } else {
         $msg = urlencode('Erreur lors de l\'ajout du réceveur');
         header("location:../message.php?msg=$msg&color=r");
     }
     exit();
 }
 ?>
