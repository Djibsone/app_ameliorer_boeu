<?php
require '../utilisateurs/ma_session.php';
require_once '../connexion.php';
include '../sheard/head.php';
include '../menu.php';
require_once '../fonctions.php';

// Récupération des données
$as = annee_scolaire_actuelle();
$donneurs = getEffectifD();
$receveurs = getEffectifR();
$nbrBoeux = getEffectifB();

// Données pour les graphiques
$labels = ['Donneurs', 'Receveurs', 'Bœux'];
$data = [$donneurs['total'], $receveurs['total'], $nbrBoeux];
$colors = ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)'];
?>

<br><br><br><br>
<div class="container tableau-stat text-center">
    <h1 class="text-center text-primary">Statistiques de l'année <?= $as ?></h1>
    <div class="row d-flex align-items-stretch">

        <!-- Donneurs -->
        <div class="col-md-4">
            <div class="stat stat12 h-100 d-flex flex-column justify-content-center">
                <span class="fa fa-user-plus"></span>
                <div class="effectif">
                    Nombre total des donneurs
                    <div class="nbr"><?= formatNumber($donneurs['total']) ?></div>
                    <div class="gender-count d-flex justify-content-between">
                        <div class="text-left">
                            Homme<?= $donneurs['garcons'] > 1 ? 's' : '' ?>: <?= formatNumber($donneurs['garcons']) ?>
                        </div>
                        <div class="text-right">
                            Femme<?= $donneurs['filles'] > 1 ? 's' : '' ?>: <?= formatNumber($donneurs['filles']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Receveurs -->
        <div class="col-md-4">
            <div class="stat stat1 h-100 d-flex flex-column justify-content-center">
                <span class="fa fa-user-plus"></span>
                <div class="effectif">
                    Nombre total des réceveurs
                    <div class="nbr"><?= formatNumber($receveurs['total']) ?></div>
                    <div class="gender-count d-flex justify-content-between">
                        <div class="text-left">
                            Homme<?= $receveurs['garcons'] > 1 ? 's' : '' ?>: <?= formatNumber($receveurs['garcons']) ?>
                        </div>
                        <div class="text-right">
                            Femme<?= $receveurs['filles'] > 1 ? 's' : '' ?>: <?= formatNumber($receveurs['filles']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bœux -->
        <div class="col-md-4">
            <div class="stat stat2 h-100 d-flex flex-column justify-content-center">
                <span class="fa fa-paw"></span>
                <div class="effectif">
                    Nombre total des bœux
                    <div class="nbr"><?= formatNumber($nbrBoeux) ?></div>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="col-md-12">
            <h3>Vue Globale</h3>
            <?php generateChart('globalChart', 'bar', $labels, $data, $colors, [
                'responsive' => true,
                'plugins' => ['legend' => ['display' => true]],
            ]); ?>
        </div>
    </div>
</div>
<?php include '../sheard/footer.php'; ?>
