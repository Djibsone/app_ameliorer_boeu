
<?php
    require('../utilisateurs/ma_session.php');
	 require_once('../connexion.php');
    require_once('../fonctions.php');
    $as = annee_scolaire_actuelle();

    $n1 = getEffectifD();
    $n2 = getEffectifR();
    $n3 = getEffectifB();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title> Les stagiaires </title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monStyle.css">

</head>

<body class="dash">

<?php include('../menu.php'); ?>
<br><br><br><br>
<div class="container  tableau-stat text-center">
    <h1 class="text-center text-primary">Statistiques de l'année <?php echo $as ?></h1>
    <div class="row">

        <!-- ************ Total des inscrits de donneurs ******************  -->

        <div class="col-md-4">
            <div class="stat stat12">
                <span class="fa fa-user-plus"></span>
                <div class="effectif">
                    Nombre total des donneurs
                    <div class="nbr"><?php echo $n1 ?></div>
                </div>

            </div>
        </div>

        <!-- ************* Total des inscrits de reveveurs  *****************  -->

        <div class="col-md-4">
            <div class="stat stat1">
                <span class="fa fa-user-plus"></span>
                <div class="effectif">
                    Nombre total des receveurs
                    <div class="nbr"><?php echo $n2 ?></div>
                </div>
            </div>
        </div>

        <!-- ************* Total des inscrits de boeux *****************  -->


        <div class="col-md-4">
            <div class="stat stat2">
                <span class="fa fa-paw"></span>
                <div class="effectif">
                    Nombre total des boeux
                    <div class="nbr"><?php echo $n3 ?></div>
                </div>
            </div>
        </div>


    </div>
</div>

<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/script.js"></script>
</body>
</html>