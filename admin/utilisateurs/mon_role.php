<?php
if ($_SESSION['user']['role'] != 'Administrateur') {
    $msg = 'Opération non autorisée';
    $url = $_SERVER['HTTP_REFERER'];
    header("location:../message.php?msg=$msg&color=r&url=$url");
    exit();
}
?>
