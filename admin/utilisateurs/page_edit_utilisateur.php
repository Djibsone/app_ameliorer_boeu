﻿ <?php
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
             Modifier un utilisateur
         </div>

         <div class="panel-body">

             <form class="form" action="update_utilisateur.php" method="post">

                 <input type="hidden" name="id_udser" value="<?php echo $utilisateur['id_utilisateur']; ?>">

                 <div class="form-group">
                     <label for="login" class="label-control">Login</label>
                     <input type="text" name="login" id="login" class="form-control"
                         value="<?php echo $utilisateur['login']; ?>">
                 </div>

                 <?php if($_SESSION['user']['role'] == "Administrateur"){?>
                 <div class="form-group">
                     <label for="role" class="label-control">Role</label>
                     <select class="form-control" name="role">

                         <option <?php if ($utilisateur['role'] == 'Visiteur') {
                             echo 'selected';
                         }
                         ?>>
                             Visiteur
                         </option>

                         <option <?php if ($utilisateur['role'] == 'Directeur') {
                             echo 'selected';
                         }
                         ?>>
                             Administrateur
                         </option>

                     </select>

                 </div>
                 <?php } ?>

                 <div class="form-group">
                     <label for="pwd" class="label-control">Mot de passe</label>
                     <input type="password" name="pwd" id="pwd" class="form-control"
                         value="<?php echo $utilisateur['pwd']; ?>">
                    <span class="fa fa-eye-slash fa-2x oeil" id="oeil"></span>
                 </div>

                 <div class="form-group">
                     <label for="email" class="label-control">Email</label>
                     <input type="email" name="email" autocomplete="off" id="email" class="form-control"
                         required value="<?php echo $utilisateur['email']; ?>">
                 </div>

                 <input type="submit" value="Enregistrer" class="btn btn-success btn-block">

             </form>
         </div>
     </div>

 </div>

 <?php include '../sheard/footer.php'; ?>
