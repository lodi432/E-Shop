<?php
require_once $_SERVER['DOCUMENT_ROOT']. '/konfiguracija.php';
unset ($_SESSION['SDUser']);
header('Location: login2.php');
 ?>
