 <?php
 require '../utilisateurs/ma_session.php';
 require '../utilisateurs/mon_role.php';
 
 require '../connexion.php';
 
 $id_donneur = $_GET['id'];
 if (empty($id_donneur) || !is_numeric($id_donneur)) {
     $msg = 'Donneur non identifié';
     $url = 'donneurs/page_les_donneurs.php';
     header("location:../message.php?msg=$msg&color=r&url=$url");
 }
 
 try {
     $requete = 'DELETE FROM receveurs WHERE id=?';
     $valeur = [$id];
 
     $resultat = $pdo->prepare($requete);
     $resultat->execute($valeur);
 
     if ($resultat->rowCount() > 0) {
         $msg = 'Donneur supprimé avec succès';
         $url = 'donneurs/page_les_donneurs.php';
         header("location:../message.php?msg=$msg&color=v&url=$url");
         exit();
     } else {
         $msg = 'Aucun réceveur trouvé avec cet identifiant.';
         $url = 'donneurs/page_les_donneurs.php';
         header("location:../message.php?msg=$msg&color=r&url=$url");
         exit();
     }
 } catch (PDOException $e) {
     if ($e->getCode() == '23000') {
         $msg = 'Impossible de supprimer, veuillez supprimer d\'abord tous les transferts liés à ce donneur.';
     } else {
         $msg = 'Une erreur est survenue : ' . $e->getMessage();
     }
     $url = 'donneurs/page_les_donneurs.php';
     header("location:../message.php?msg=$msg&color=r&url=$url");
     exit();
 }
 
 ?>
