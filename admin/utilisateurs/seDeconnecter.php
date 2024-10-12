<?php
session_start();
session_destroy();
header('location:../utilisateurs/login.php');
exit();
?>
