
<?php
    require('../utilisateurs/ma_session.php');
	require_once('../connexion.php');
    include('../sheard/head.php');
    include('../menu.php');
    require_once('../fonctions.php');

    $as = annee_scolaire_actuelle();
    $donneurs = getEffectifD();
    $receveurs = getEffectifR();
    $nbrBoeux = getEffectifB();

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
                    <div class="nbr"><?= formatNumber($donneurs['total']) ?></div>
                    <div class="gender-count d-flex justify-content-between">
                        <div class="text-left">
                            Garçons: <?= formatNumber($donneurs['garcons']) ?>
                        </div>
                        <div class="text-right">
                            Filles: <?= formatNumber($donneurs['filles']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat stat1">
                <span class="fa fa-user-plus"></span>
                <div class="effectif">
                    Nombre total des receveurs
                    <div class="nbr"><?= formatNumber($receveurs['total']) ?></div>
                    <div class="gender-count d-flex justify-content-between">
                        <div class="text-left">
                            Garçons: <?= formatNumber($receveurs['garcons']) ?>
                        </div>
                        <div class="text-right">
                            Filles: <?= formatNumber($receveurs['filles']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat stat2">
                <span class="fa fa-paw"></span>
                <div class="effectif">
                    Nombre total des boeux
                    <div class="nbr"><?= formatNumber($nbrBoeux) ?></div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include('../sheard/footer.php') ?>