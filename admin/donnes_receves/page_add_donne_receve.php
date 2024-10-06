<?php
require('../utilisateurs/ma_session.php');
require('../utilisateurs/mon_role.php');
?>

<?php
	require('../connexion.php');

    //donneur
    $requete=$pdo->query("select * from donneurs");
    $tous_les_donneurs=$requete->fetchAll();

    //receveur
    $req=$pdo->query("select * from receveurs");
    $tous_les_receveurs=$req->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title> Nouvelle filiére </title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monStyle.css">

</head>

<body>
<?php include('../menu.php'); ?>
<br><br><br><br><br><br>

<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading" align="center">Nouveau donneur & receveur</div>
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
                   
                <button type='submit' class="btn btn-primary btn-block">Enregistrer <span class="fa fa-save"></span></button>
            </form>
        </div>
    </div>
</div>

<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/script.js"></script>
</body>
</html>
