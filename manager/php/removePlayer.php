<?php
session_start();
$eventId = $_SESSION['EventId'];
$userId = $_POST['UserId'];
$bdd = new PDO('mysql:host=localhost;dbname=b7_28056591_yugioh', 'DBoardShop','helha', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$requete = $bdd->prepare("DELETE FROM `participate`
WHERE `participate`.`UserId` = '$userId' AND `participate`.`EventId` = '$eventId';");
$requete->execute();
?>
