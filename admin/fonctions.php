<?php
function annee_scolaire_actuelle()
{
    $mois = date('m');
$annee_actuelle = date('Y');
    if ($mois >= 9 && $mois <= 12) {
        $annee1 = $annee_actuelle;
        $annee2 = $annee_actuelle + 1;
    } else {
        $annee1 = $annee_actuelle - 1;
        $annee2 = $annee_actuelle;
    }

    $annee_scolaire_actuelle = $annee1 . '/' . $annee2;
    return $annee_scolaire_actuelle;
}

function nombre_annee_scolaire()
{
    $annee_debut = 2010;
    $mois = date('m');
    $annee_actuelle = date('Y');
    if ($mois >= 9 && $mois <= 12) {
        return $annee_actuelle - $annee_debut + 1;
    } else {
        return $annee_actuelle - $annee_debut;
    }
}

function les_annee_scolaire($annee_debut = 2010)
{
    $les_annees = [];
    for ($i = 1; $i <= nombre_annee_scolaire(); $i++) {
        $annee_sc = $annee_debut + ($i - 1) . '/' . ($annee_debut + $i);
        $les_annees[] = $annee_sc;
    }
    return $les_annees;
}

//Recherche par login
function recherche_user_byLogin($login)
{
    global $pdo;

    $req = $pdo->prepare('SELECT * FROM utilisateur WHERE login=?');
    $valeur = [$login];
    $req->execute($valeur);

    if ($req->rowCount() > 0) {
        return $req->fetch();
    } else {
        return false;
    }
}

//Recherche par login et id
function recherche_user_byLoginId($login, $id)
{
    global $pdo;
    $req = $pdo->prepare('select * from utilisateur where login=? and id_utilisateur!=?');
    $valeur = [$login, $id];
    $req->execute($valeur);
    $nbr_user = $req->rowCount();
    return $nbr_user;
}

/**
//rechercher le donneur
function rechercheDonneur($q) {
    global $pdo;
    $requete = "SELECT d.*, d.nomDon, d.sexe, d.nbrB, COALESCE(SUM(a.nbreB), 0) AS nbr_total_de_boeux
                FROM donneurs d
                LEFT JOIN avoir a ON d.id = a.id_don
                WHERE d.nomDon LIKE :q
                GROUP BY d.id, d.nomDon, d.sexe, d.nbrB
                ORDER BY d.id DESC";
        $result_requete_donneurs = $pdo->prepare($requete);
        $result_requete_donneurs->execute(array(':q' => '%' . $q . '%'));
        $tous_les_donneurs = $result_requete_donneurs->fetchAll();
    return $tous_les_donneurs;
}

//afficher donneur
function afficheDonneur() {
    global $pdo;
    $requete_donneurs = "SELECT
                d.*, COALESCE(SUM(a.nbreB), 0) AS nbr_total_de_boeux 
                FROM donneurs d LEFT JOIN avoir a ON d.id = a.id_don 
                GROUP BY d.id ORDER BY d.id DESC";

		$result_requete_donneurs = $pdo->query($requete_donneurs);
		$tous_les_donneurs = $result_requete_donneurs->fetchAll();
    return $tous_les_donneurs;
}


//affiche donneur & receveur
function afficheDonneReceve() {
    global $pdo;
    $requete_donnes_receves="SELECT
				a.*, d.nomDon, d.sexe, d.nbrB, r.nomRe, r.sexeR, r.localite 
				FROM donneurs d, receveurs r, avoir a 
				WHERE d.id=a.id_don AND r.id=a.id_re ORDER BY id DESC";	

			$result_requete_donnes_receves=$pdo->query($requete_donnes_receves);
			$tous_les_donnes_receves=$result_requete_donnes_receves->fetchAll();
    return $tous_les_donnes_receves;
}

//rechercher le donneur & receveur
function rechercheDonneReceve($q) {
    global $pdo;
    $requete = "SELECT a.*, d.nomDon, d.sexe, d.nbrB, r.nomRe, r.sexeR, r.localite
                FROM donneurs d, receveurs r, avoir a 
                LEFT JOIN avoir a ON d.id = a.id_don
                WHERE d.id=a.id_don AND r.id=a.id_re AND d.nomDon LIKE :q OR r.nomRe LIKE :q
                ORDER BY id DESC";
        $result_requete_donneurs = $pdo->prepare($requete);
        $result_requete_donneurs->execute(array(':q' => '%' . $q . '%'));
        $tous_les_donneurs = $result_requete_donneurs->fetchAll();
    return $tous_les_donneurs;
}
**/

//Recherche par login et pwd (Soit l'utilisateur soit NULL)
function recherche_user_byLoginPwd($login, $pwd)
{
    global $pdo;

    $req = $pdo->prepare('select * from utilisateur where login=? and pwd=?');
    $valeur = [$login, $pwd];
    $req->execute($valeur);
    $nbr_user = $req->rowCount();

    if ($nbr_user == 1) {
        return $req->fetch();
    } else {
        return 0;
    }
}

function dateEnToDateFr($dateEn)
{
    return substr($dateEn, 8, 2) . '/' . substr($dateEn, 5, 2) . '/' . substr($dateEn, 0, 4);
}

function dateFrToDateEn($dateFr)
{
    return substr($dateFr, 6, 4) . '-' . substr($dateFr, 3, 2) . '-' . substr($dateFr, 0, 2);
}

//Effectif des inscris de donneurs
function getEffectifD()
{
    global $pdo;
    $res = $pdo->query('select coalesce(count(*), 0) effectif from donneurs');
    $nbr = $res->fetch();
    return $nbr['effectif'];
}

//Effectif des inscris de receveurs
function getEffectifR()
{
    global $pdo;
    $res = $pdo->query('select coalesce(count(*), 0) effectif from receveurs');
    $nbr = $res->fetch();
    return $nbr['effectif'];
}

//Effectif des inscris de boeux
function getEffectifB()
{
    global $pdo;
    $res = $pdo->query('select coalesce(sum(nbreB), 0) effectif from avoir');
    $nbr = $res->fetch();
    return $nbr['effectif'];
}

?>
