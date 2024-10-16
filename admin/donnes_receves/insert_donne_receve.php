<?php
require '../utilisateurs/ma_session.php';
require '../utilisateurs/mon_role.php';
require '../connexion.php';

$nom_d = $_POST['nom_d'];
$nom_r = $_POST['nom_r'];
$nombre = $_POST['nombre'];

//getDonneur
$stmt = $pdo->prepare('SELECT * FROM donneurs WHERE id = ?');
$stmt->execute([$nom_d]);
$data = $stmt->fetch();

//getNbrReceve
$check = $pdo->prepare('SELECT * FROM avoir WHERE id_re = ?');
$check->execute([$nom_r]);
$result = $check->fetch();

//verify
$verify = $pdo->prepare('SELECT * FROM avoir  WHERE id_don = ? AND  id_re = ?');
$verify->execute([$nom_d, $nom_r]);
$row = $verify->rowCount();

if ($nombre <= 0) {
    $msg = 'Nombre invalide';
    $url = 'donnes_receves/page_les_donnes_receves.php';
    header("location:../message.php?msg=$msg&color=r&url=$url");
} else {
    if ($data['nbrB'] < $nombre) {
        $msg = 'Nombre insuffisant';
        $url = 'donnes_receves/page_les_donnes_receves.php';
        header("location:../message.php?msg=$msg&color=r&url=$url");
    } else {
        if ($row) {
            $retireB = $data['nbrB'] - $nombre;
            $ajoutB = $result['nbreB'] + $nombre;

            $req = $pdo->prepare('UPDATE avoir SET nbreB = ? WHERE id_don = ? AND id_re = ?');
            $req->execute([$ajoutB, $nom_d, $nom_r]);

            $resultat = $pdo->prepare('UPDATE donneurs SET nbrB = ? WHERE id = ?');
            $resultat->execute([$retireB, $nom_d]);

            $msg = 'Ajouté avec succès';
            $url = 'donnes_receves/page_les_donnes_receves.php';
            header("location:../message.php?msg=$msg&color=v&url=$url");
        } else {
            $retireB = $data['nbrB'] - $nombre;
            $resultat = $pdo->prepare('INSERT INTO avoir(id_don,id_re,nbreB) VALUES(?,?,?)');
            $resultat->execute([$nom_d, $nom_r, $nombre]);

            $resul = $pdo->prepare('UPDATE donneurs SET nbrB = ? WHERE id = ?');
            $resul->execute([$retireB, $nom_d]);

            $msg = 'Ajouté avec succès';
            $url = 'donnes_receves/page_les_donnes_receves.php';
            header("location:../message.php?msg=$msg&color=v&url=$url");
        }
    }
}

?>
