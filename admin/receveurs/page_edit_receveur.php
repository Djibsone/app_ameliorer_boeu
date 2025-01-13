 <?php
 require '../utilisateurs/ma_session.php';
 require '../utilisateurs/mon_role.php';
 require '../connexion.php';
 include '../sheard/head.php';
 include '../menu.php';
 
 $id_receveur = $_GET['id'];
 if (empty($id_receveur) || !is_numeric($id_receveur)) {
     $msg = 'Receveur non identifié';
     $url = 'receveurs/page_les_receveurs.php';
     header("location:../message.php?msg=$msg&color=r&url=$url");
 }
 
 $requete = 'SELECT * FROM receveurs WHERE id=?';
 $resultat = $pdo->prepare($requete);
 $resultat->execute([$id_receveur]);
 $le_receveur = $resultat->fetch();
 
 ?>

 <br><br><br><br><br><br>

 <div class="container">
     <div class="panel panel-info">
         <div class="panel-heading"
             style="display: flex; align-items: center; justify-content: center; position: relative;">
             <a href="javascript:history.back()"
                 style="position: absolute; left: 12px; text-decoration: none; color: inherit;">
                 <i class="fa fa-arrow-left" style="cursor: pointer; margin-right: 10px;"></i>
             </a>
             <h3>Modifier réceveur </h3>
         </div>
         <div class="panel-body">
             <form method="post" action="update_receveur.php">
                 <input type="hidden" name="id" value="<?php echo $le_receveur['id']; ?>">
                 <div class="row my-row">
                     <label for="nom" class="control-label col-sm-2">NOM COMPLET DU RÉCEVEUR</label>
                     <div class="col-sm-4">
                         <input type="text" name="nom" id="nom" class="form-control"
                             value="<?php echo $le_receveur['nomRe']; ?>" required>
                     </div>
                     <label for="sexe" class="control-label col-sm-2">SEXE DU RÉCEVEUR</label>
                     <div class="col-sm-4">
                         <input list="sexe" type="text" class="form-control" name="sexe"
                             placeholder="Sexe du réceveur" required value="<?php echo $le_receveur['sexeR']; ?>">
                         <datalist id="sexe">
                             <option>Masculin</option>
                             <option>Féminin</option>
                         </datalist>
                     </div>
                 </div>

                 <div class="row my-row">
                     <label for="localite"class="control-label col-sm-2">LOCALITE DU RÉCEVEUR</label>
                     <div class="col-sm-4">
                         <input type="text" name="localite" id="localite"class="form-control"
                             value="<?php echo $le_receveur['localite']; ?>" required>
                     </div>
                 </div>
                 <button type='submit' class="btn btn-info btn-block">
                     Enregistrer <span class="fa fa-save"></span>
                 </button>
             </form>
         </div>
     </div>
 </div>

 <?php include '../sheard/footer.php'; ?>
