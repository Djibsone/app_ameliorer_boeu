<?php
require '../utilisateurs/ma_session.php';
require '../utilisateurs/mon_role.php';
include '../sheard/head.php';
include '../menu.php';

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
            Nouveau donneur
        </div>
        <div class="panel-body">
            <form method="post" action="insert_donneur.php">

                <div class="row my-row">
                    <label for="nom" class="control-label col-sm-2">NOM COMPLET DU DONNEUR</label>
                    <div class="col-sm-4">
                        <input required type="text" name="nom" id="nom" class="form-control">
                    </div>

                    <label class="control-label col-sm-2">SEXE DU DONNEUR</label>
                    <div class="col-sm-4">
                        <input list="sexe" type="text" class="form-control" name="sexe" placeholder="Sexe du donneur" required>                            
                        <datalist id="sexe">
                            <option>Masculin</option>
                            <option>Féminin</option>
                        </datalist>
                    </div>

                </div>

                <div class="row my-row">
                    <label for="nombre" class="control-label col-sm-2">NOMBRE DE BOEUX</label>
                    <div class="col-sm-4">
                        <input required type="text" name="nombre" id="nombre" class="form-control">
                    </div>

                </div>

                <button type='submit' class="btn btn-primary btn-block">Enregistrer <span
                        class="fa fa-save"></span></button>
            </form>
        </div>
    </div>
</div>

<?php include '../sheard/footer.php'; ?>
