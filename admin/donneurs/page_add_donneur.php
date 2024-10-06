<?php
require('../utilisateurs/ma_session.php');
require('../utilisateurs/mon_role.php');

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title> Nouveau donneur </title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/monStyle.css">

</head>

<body>
<?php include('../menu.php'); ?>
<br><br><br><br><br><br>

<div class="container">

    <div class="panel panel-primary">
        <div class="panel-heading" align="center">Nouveau donneur</div>
        <div class="panel-body">
            <form method="post" action="insert_donneur.php">

                <div class="row my-row">
                    <label for="nom" class="control-label col-sm-2">NOM COMPLET DU DONNEUR</label>
                    <div class="col-sm-4">
                        <input required type="text" name="nom" id="nom" class="form-control">
                    </div>

                    <label class="control-label col-sm-2">SEXE</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="sexe">
                            <option>Sélectionner le sexe</option>
                            <option>M</option>
                            <option>F</option>
                        </select>
                    </div>

                </div>

                <div class="row my-row">
                    <label for="nombre" class="control-label col-sm-2">NOMBRE DE BOEUX</label>
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
