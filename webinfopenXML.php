<?php
require ('database/dbManager.class.php');
$mysql = new dbManager();
$mysql->dataToXML();

header('Location: http://192.168.1.99/bookstore/about.php');
?>
