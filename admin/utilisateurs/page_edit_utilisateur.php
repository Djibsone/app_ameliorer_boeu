 <?php
 require '../utilisateurs/ma_session.php';
 
 require '../connexion.php';
 include '../sheard/head.php';
 include '../menu.php';
 
 $id = $_GET['id'];
 
 if (empty($id) || !is_numeric($id)) {
     $msg = 'Utilisateur non identifié';
     $url = 'utilisateurs/page_les_utilisateurs.php';
     header("location:../message.php?msg=$msg&color=r&url=$url");
 }
 
 $stmt = $pdo->prepare('SELECT * FROM utilisateur WHERE id_utilisateur = ?');
 $stmt->execute([$id]);
 $utilisateur = $stmt->fetch();
 
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

                         <option <?php if ($utilisateur['role'] == 'Administrateur') {
                             echo 'selected';
                         }
                         ?>>
                             Administrateur
                         </option>

                     </select>

                 </div>
                 <?php } ?>

                 <div class="form-group">
                     <label for="email" class="label-control">Email (<span class="text-info"><i>Votre e-mail n'est
                                 pas modifiable</i></span>)</label>
                     <input type="email" name="email" autocomplete="off" id="email" class="form-control"
                         required value="<?php echo $utilisateur['email']; ?>" disabled>
                 </div>

                 <input type="submit" value="Enregistrer" class="btn btn-success btn-block">

             </form>
         </div>
     </div>

 </div>

 <?php include '../sheard/footer.php'; ?>
