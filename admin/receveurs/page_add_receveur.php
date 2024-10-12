 <?php
 require '../utilisateurs/ma_session.php';
 include '../sheard/head.php';
 include '../menu.php';
 ?>

 <br><br><br><br><br><br>

 <div class="container">
     <div class="panel panel-success">
         <div class="panel-heading"
             style="display: flex; align-items: center; justify-content: center; position: relative;">
             <a href="javascript:history.back()"
                 style="position: absolute; left: 12px; text-decoration: none; color: inherit;">
                 <i class="fa fa-arrow-left" style="cursor: pointer; margin-right: 10px;"></i>
             </a>
             <h3>Nouveau receveur </h3>
         </div>

         <div class="panel-body" style="padding: 25px;">
             <form method="post" action="insert_receveur.php">

                 <div class="row my-row">
                    <label for="nom" class="control-label col-sm-2">NOM COMPLET DU RECEVEUR</label>
                    <div class="col-sm-4">
                        <input type="text" name="nom" id="nom" class="form-control" required>
                    </div>

                    <label class="control-label col-sm-2">SEXE DU RECEVEUR</label>
                    <div class="col-sm-4">
                        <input list="sexe" type="text" class="form-control" name="sexe" placeholder="Sexe du receveur" required>                            
                        <datalist id="sexe">
                            <option>Masculin</option>
                            <option>Féminin</option>
                        </datalist>
                    </div>
                </div>

                <div class="row my-row">
                    <label for="localite"class="control-label col-sm-2">LOCALITE DU RECEVEUR</label>
                    <div class="col-sm-4">
                        <input type="text" name="localite" id="localite"class="form-control" required>
                    </div>
                </div>

                <button type='submit' class="btn btn-success btn-block">
                    Enregistrer <span class="fa fa-save"></span>
                </button>
             </form>
         </div>
     </div>
 </div>

 <?php include '../sheard/footer.php'; ?>
