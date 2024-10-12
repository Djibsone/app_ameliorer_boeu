 <?php include '../sheard/head.php' ?>

 <br><br><br><br><br>
 <div class="container col-md-4 col-md-offset-4">
     <div class="panel panel-primary">
         <div class="panel-heading">Se connecter</div>
         <div class="panel-body">
             <form method="post" action="seConnecter.php" class="form">

                 <div class="form-group">
                    <label class="label-control">Email</label>
                    <input type="text" name="email" id="email" class="form-control" required>
                 </div>
                 <div class="form-group">
                    <label for="pwd" class="label-control">Mot de passe</label>
                    <input type="password" name="pwd" id="pwd" class="form-control pwd" required
                        autocomplete="off" />
                    <span class="fa fa-eye-slash fa-2x oeil" id="oeil"></span>
                 </div>

                <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
                <br>
                <a href="page_add_utilisateur.php">Créer mon compte</a>
                 &nbsp&nbsp&nbsp&nbsp&nbsp
                <a href="page_demande_pwd.php">Mot de passe oublié</a>
             </form>
         </div>
     </div>
 </div>

 <?php include '../sheard/footer.php'; ?>
