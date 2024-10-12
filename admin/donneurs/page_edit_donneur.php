 <?php
 require '../utilisateurs/ma_session.php';
 require '../utilisateurs/mon_role.php';
 
 require '../connexion.php';
 include '../sheard/head.php';
 include '../menu.php';
 
 $id_doneur = $_GET['id'];
 
 $requete = 'SELECT * FROM donneurs WHERE id=?';
 
 $identite_donneur = $pdo->prepare($requete);
 
 $identite_donneur->execute([$id_doneur]);
 $le_donneur = $identite_donneur->fetch();
 
 ?>

 <br><br><br><br><br><br>

 <div class="container">
     <div class="panel panel-primary">
         <div class="panel-heading"
             style="display: flex; align-items: center; justify-content: center; position: relative;">
             <a href="javascript:history.back()"
                 style="position: absolute; left: 12px; text-decoration: none; color: inherit;">
                 <i class="fa fa-arrow-left" style="cursor: pointer; margin-right: 10px;"></i>
             </a>
             Modifier donneur
         </div>

         <div class="panel-body">
             <form method="post" action="update_donneur.php">

                 <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $le_donneur['id']; ?>">

                 <div class="row my-row">
                     <label for="nom" class="control-label col-sm-2">NOM COMPLET</label>
                     <div class="col-sm-4">
                         <input type="text" name="nom" id="nom" class="form-control"
                             value="<?php echo $le_donneur['nomDon']; ?>" required>
                     </div>

                     <label class="control-label col-sm-2">SEXE DU DONNEUR</label>
                     <div class="col-sm-4">
                        <select class="form-control" name="sexe" required>
                            <option><?php echo $le_donneur['sexe'] ? $le_donneur['sexe'] : 'Sélectionner le sexe'; ?></option>
                            <option>Masculin</option>
                        <option>Féminin</option>
                        </select>
                     </div>

                 </div>

                 <div class="row my-row">
                     <label for="nombre"class="control-label col-sm-2">NOMBRE DE BOEUX</label>
                     <div class="col-sm-4">
                         <input type="text" name="nombre" id="nombre"class="form-control"
                             value="<?php echo $le_donneur['nbrB']; ?>" required>
                     </div>

                 </div>

                 <button type='submit' class="btn btn-primary btn-block">Enregistrer <span class="fa fa-save"></span>
                 </button>
             </form>
         </div>
     </div>

 </div>

 <?php include '../sheard/footer.php'; ?>
