<?php
require ('database/dbManager.class.php');
$mysql = new dbManager();
$mysql->dataToExcel();
?>
