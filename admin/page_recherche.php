<?php
require './connexion.php';

if (isset($_POST['q_d'])) {
    $q = $_POST['q_d'];

    $requete = "SELECT d.*, d.nomDon, d.sexe, d.nbrB, COALESCE(SUM(a.nbreB), 0) AS nbr_total_de_boeux
        FROM donneurs d
        LEFT JOIN avoir a ON d.id = a.id_don
        WHERE d.nomDon LIKE :q
        GROUP BY d.id, d.nomDon, d.sexe, d.nbrB
        ORDER BY d.id DESC";

    $result_requete_donneurs = $pdo->prepare($requete);
    $result_requete_donneurs->execute([':q' => '%' . $q . '%']);

    $tous_les_donneurs = $result_requete_donneurs->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        echo json_encode($tous_les_donneurs);
    } else {
    }
}

if (isset($_POST['q_r'])) {
    $q = $_POST['q_r'];

    $requete = "SELECT r.*, r.nomRe, r.sexeR, COALESCE(SUM(a.nbreB), 0) AS nbr_total_de_boeux
        FROM receveurs r
        LEFT JOIN avoir a ON r.id = a.id_re
        WHERE r.nomRe LIKE :q OR r.localite LIKE :q
        GROUP BY r.id, r.nomRe, r.sexeR
        ORDER BY r.id DESC";

    $result_requete_receveurs = $pdo->prepare($requete);
    $result_requete_receveurs->execute([':q' => '%' . $q . '%']);

    $tous_les_receveurs = $result_requete_receveurs->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        echo json_encode($tous_les_receveurs);
    } else {
    }
}

if (isset($_POST['q_d_r'])) {
    $q = $_POST['q_d_r'];

    $requete = "SELECT a.*, d.nomDon, d.sexe, d.nbrB, r.nomRe, r.sexeR, r.localite
        FROM donneurs d JOIN avoir a ON d.id = a.id_don JOIN receveurs r ON r.id = a.id_re
        WHERE d.nomDon LIKE :q OR r.nomRe LIKE :q OR r.localite LIKE :q
        ORDER BY id DESC";

    $result_requete_donnes_receves = $pdo->prepare($requete);
    $result_requete_donnes_receves->execute([':q' => '%' . $q . '%']);

    $tous_les_donnes_receves = $result_requete_donnes_receves->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        echo json_encode($tous_les_donnes_receves);
    } else {
    }
}
