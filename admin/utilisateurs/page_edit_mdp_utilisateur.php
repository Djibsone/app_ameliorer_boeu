 <?php
 require '../utilisateurs/ma_session.php';
 
 require '../connexion.php';
 include '../sheard/head.php';
 include '../menu.php';
 
 $id = $_GET['id'];
 
 $requete = "select * from utilisateur where id_utilisateur=$id";
 $resultat = $pdo->query($requete);
 $utilisateur = $resultat->fetch();
 
 ?>

 <br><br><br><br><br><br>

 <div class="container col-md-6 col-md-offset-3">

     <div class="panel panel-danger">
         <div class="panel-heading">
             <a href="javascript:history.back()" style="text-decoration: none; color: inherit;">
                 <i class="fa fa-arrow-left" style="cursor: pointer; margin-right: 10px;"></i>
             </a>
             Modifier le mot de passe
         </div>

         <div class="panel-body">

             <form class="form" action="update_utilisateur.php" method="post">

                 <input type="hidden" name="id_udser" value="<?php echo $utilisateur['id_utilisateur']; ?>">

                 <div class="form-group">
                     <label class="label-control">L'ancien mot de passe</label>
                     <input type="password" name="oldpwd" id="pwd" class="form-control">
                    <span class="fa fa-eye-slash fa-2x oeil" id="oeil"></span>
                 </div>
                 <div class="form-group">
                     <label class="label-control">Nouveau mot de passe</label>
                     <input type="password" name="newpwd" id="newpwd" class="form-control">
                    <span class="fa fa-eye-slash fa-2x oeil" id="oeil1"></span>
                 </div>
                 <div class="form-group">
                     <label class="label-control">Confirmer le mot de passe</label>
                     <input type="password" name="cpwd" id="cpwd" class="form-control">
                    <span class="fa fa-eye-slash fa-2x oeil" id="oeil2"></span>
                 </div>

                 <input type="submit" value="Enregistrer" class="btn btn-success btn-block">

             </form>
         </div>
     </div>

 </div>

 <?php include '../sheard/footer.php'; ?>
