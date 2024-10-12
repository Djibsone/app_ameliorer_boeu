<?php
require '../utilisateurs/ma_session.php';
require '../utilisateurs/mon_role.php';
require '../connexion.php';
include '../sheard/head.php';
include '../menu.php';

$requete = $pdo->query('select * from donneurs');
$tous_les_donneurs = $requete->fetchAll();

$req = $pdo->query('select * from receveurs');
$tous_les_receveurs = $req->fetchAll();
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
            Nouveau donneur & receveur
        </div>
        <div class="panel-body">

            <form method="post" action="insert_donne_receve.php">

                <div class="row my-row">
                    <label class="control-label col-sm-2">NOM COMPLET DU DONNEUR</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="nom_d">
                            <option>Selectionner nom donneur</option>
                            <?php foreach($tous_les_donneurs as $le_donneur){?>
                            <option value="<?php echo $le_donneur['id']; ?>"><?php echo $le_donneur['nomDon']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <label class="control-label col-sm-2">NOM COMPLET DU RECEVEUR</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="nom_r">
                            <option>Selectionner nom réceveur</option>
                            <?php foreach($tous_les_receveurs as $le_receveur){?>
                            <option value="<?php echo $le_receveur['id']; ?>"><?php echo $le_receveur['nomRe']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                </div>

                <div class="row my-row">
                    <label for="nombre" class="control-label col-sm-2">NOMBRE DE BOEUX A RECEVOIR</label>
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
