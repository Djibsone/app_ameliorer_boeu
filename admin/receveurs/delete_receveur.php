 <?php
 require '../utilisateurs/ma_session.php';
 require '../utilisateurs/mon_role.php';
 
 require '../connexion.php';
 
 $id = $_GET['id'];
 if (empty($id) || !is_numeric($id)) {
     $msg = 'Receveur non identifié';
     $url = 'receveurs/page_les_receveurs.php';
     header("location:../message.php?msg=$msg&color=r&url=$url");
     exit();
 }
 
 try {
     $requete = 'DELETE FROM receveurs WHERE id=?';
     $valeur = [$id];
 
     $resultat = $pdo->prepare($requete);
     $resultat->execute($valeur);
 
     if ($resultat->rowCount() > 0) {
         $msg = 'Réceveur supprimé avec succès';
         $url = 'receveurs/page_les_receveurs.php';
         header("location:../message.php?msg=$msg&color=v&url=$url");
         exit();
     } else {
         $msg = 'Aucun réceveur trouvé avec cet identifiant.';
         $url = 'receveurs/page_les_receveurs.php';
         header("location:../message.php?msg=$msg&color=r&url=$url");
         exit();
     }
 } catch (PDOException $e) {
     if ($e->getCode() == '23000') {
         $msg = 'Impossible de supprimer, veuillez supprimer d\'abord tous les transferts liés à ce réceveur.';
     } else {
         $msg = 'Une erreur est survenue : ' . $e->getMessage();
     }
     $url = 'receveurs/page_les_receveurs.php';
     header("location:../message.php?msg=$msg&color=r&url=$url");
     exit();
 }
 
 ?>
