
<?php
    require('../utilisateurs/ma_session.php');
	require_once('../connexion.php');
    include('../sheard/head.php');
    include('../menu.php');
    require_once('../fonctions.php');

    $as = annee_scolaire_actuelle();
    $n1 = getEffectifD();
    $n2 = getEffectifR();
    $n3 = getEffectifB();

?>

<br><br><br><br>
<div class="container  tableau-stat text-center">
    <h1 class="text-center text-primary">Statistiques de l'année <?= $as ?></h1>
    <div class="row">

        <div class="col-md-4">
            <div class="stat stat12">
                <span class="fa fa-user-plus"></span>
                <div class="effectif">
                    Nombre total des donneurs
                    <div class="nbr"><?= $n1 ?></div>
                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="stat stat1">
                <span class="fa fa-user-plus"></span>
                <div class="effectif">
                    Nombre total des receveurs
                    <div class="nbr"><?= $n2 ?></div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat stat2">
                <span class="fa fa-paw"></span>
                <div class="effectif">
                    Nombre total des boeux
                    <div class="nbr"><?= $n3 ?></div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include('../sheard/footer.php') ?>