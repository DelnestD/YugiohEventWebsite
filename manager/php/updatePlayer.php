<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
  session_start();
  $eventId = $_SESSION['EventId'];
  $userId = $_POST['userId'];
  $payed = $_POST['payed'];
  $giftReceive = $_POST['giftReceive'];
  $pricePayed = $_POST['pricePayed'];
  $bdd = new PDO('mysql:host=localhost;dbname=b7_28056591_yugioh', 'DBoardShop','helha', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $requete = $bdd->prepare("UPDATE `participate`
  SET `Payed` = '$payed', `PricePayed` = '$pricePayed', `GiftReceive` = '$giftReceive'
  WHERE `participate`.`UserId` = '$userId' AND `participate`.`EventId` = '$eventId';");
  $requete->execute();
}
?>
