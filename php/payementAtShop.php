<?php
session_start();
$userId = $_SESSION['userId'];
$bdd = new PDO('mysql:host=localhost;dbname=b7_28056591_yugioh', 'DBoardPlayer','helha', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
if(isset($_SESSION['cart'])&&!empty($_SESSION['cart'])){
  $cart = $_SESSION['cart'];
  $sizeCart = count($_SESSION['cart']);
    for($i=0;$i<$sizeCart;$i++){
      $eventId=$cart[$i][0];
      $eventPrice=$cart[$i][1];
      if($eventPrice==0){
        $requete = $bdd->prepare("INSERT INTO `participate` (`UserId`, `EventId`, `Payed`, `PricePayed`, `PayementMethod`, `GiftReceive`)
        VALUES ('$userId', '$eventId', '1', '0', 'at Shop', '0');");
      }else{
        $requete = $bdd->prepare("INSERT INTO `participate` (`UserId`, `EventId`, `Payed`, `PricePayed`, `PayementMethod`, `GiftReceive`)
        VALUES ('$userId', '$eventId', '0', '$eventPrice', 'at Shop', '0');");
      }
      $requete->execute();
    }
}
$requete->closeCursor();
\array_splice($_SESSION['cart'],0,$sizeCart);
?>
