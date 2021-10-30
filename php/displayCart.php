<?php
$sizeScreen = $_COOKIE["sizeScreen"];
if($sizeScreen<=600){
  echo'<div class="box-container">
  <div class="box">
    <div class="info">
    <h3>Error - Cart Informations</h3>
    <h2>The information is too broad, we ask you to switch to landscape mode.</h2>
    </div></div></div>';
}else{
session_start();
$_SESSION['total'] = 0;
echo'<div class="box-container">
<div class="box">
  <div class="info">
  <form class="" action="" method="post">
  <table class="table_form" >
    <tr rowspan="5"><td><h3>Cart Informations</h3></td></tr>
    <tr>
      <td class="border white">Event</td>
      <td class="border white">Organizer</td>
      <td class="border white">Location</td>
      <td class="border white">Date</td>
      <td class="border white">Price</td>
    </tr>
    <tr rowspan="5"><td>&nbsp;</td></tr>';
if(isset($_SESSION['cart'])&&!empty($_SESSION['cart'])){
  $cart = $_SESSION['cart'];
  $sizeCart = count($_SESSION['cart']);
  if(isset($_SESSION['userId'])&&!empty($_SESSION['userId'])){
    $userId=$_SESSION['userId'];
    $bdd = new PDO('mysql:host=localhost;dbname=b7_28056591_yugioh', 'DBoardPlayer','helha', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
    $requete2 = $bdd->prepare("SELECT `participate`.`EventId`
    FROM `participate`
    WHERE `participate`.`UserId`= '$userId';");
    $requete2->execute();
    while($participation = $requete2->fetch()){
      for($i=0;$i<$sizeCart;$i++){
        if($cart[$i][0]==$participation['EventId']){
          if($i==0){
            \array_splice($_SESSION['cart'],0,1);
          }else{
            \array_splice($_SESSION['cart'],$i,$i);
          }
        }
      }
    }
    $cart = $_SESSION['cart'];
    $sizeCart = count($_SESSION['cart']);
  }

  for($i=0;$i<$sizeCart;$i++){
  $eventId=$cart[$i][0];
  $eventPrice=$cart[$i][1];
  $bdd = new PDO('mysql:host=localhost;dbname=b7_28056591_yugioh', 'DBoardUser','helha', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
  $requete = $bdd->prepare("SELECT `event`.`EventName`,`event`.`EventCity`,`event`.`EventCountry`, `shop`.`ShopName`, DATE_FORMAT(`event`.`EventDate`,'%d/%m/%Y - %H:%i') as evDate,`event`.`EventFixedPrice`,`event`.`EventMinPrice`,`event`.`EventMaxPrice`
  FROM `event`
  LEFT JOIN `shop` ON `event`.`EventShopId` = `shop`.`ShopId`
  WHERE `event`.`EventId`= '$eventId' ;");
  $requete->execute();
  $event = $requete->fetch();
  $_SESSION['total'] = $_SESSION['total'] + $eventPrice ;
      echo'<tr>
        <td class="border white">'.$event['EventName'].'</td>
        <td class="border white">'.$event['ShopName'].'</td>
        <td class="border white">'.$event['EventCity'].' - '.$event['EventCountry'].'</td>
        <td class="border white">'.$event['evDate'].'</td>
        <td class="border white">'.$eventPrice.' €</td>
        <td><a id="'.$i.'"><i class="fas fa-times-circle"></i></a></td>
      </tr>
      <tr rowspan="5"><td>&nbsp;</td></tr>';
    }
    echo'
    <tr rowspan="5"><td>&nbsp;</td></tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td class="border right white">Total :&nbsp;</td>
      <td class="border white">'.$_SESSION['total'].' €</td>
    </tr>
    <tr>
      ';
if(isset($_SESSION['pseudo'])&&!empty($_SESSION['pseudo'])){
    echo'<td></td>
        <td><input class="btnCart" type="submit" id="PaymentShop" name="PaymentShop" value="Payment at Shop"/></td>
        <td><input class="btnCart" type="submit" id="PaymentPayPal" name="PaymentPayPal" value="Payment by PayPal"/></td>
        <td><input class="btnCart" type="submit" id="PaymentCreditCard" name="PaymentCreditCard" value="Payment by Credit Card"/></td>';
    }else{
      echo'<td>Please, Login or Signin to finalize payment</td>
          <td><input class="btnCart" type="submit" name="PaymentShop" value="Payment at Shop" disabled="disabled"/></td>
          <td><input class="btnCart" type="submit" name="PaymentPayPal" value="Payment by PayPal" disabled="disabled"/></td>
          <td><input class="btnCart" type="submit" name="PaymentCreditCard" value="Payment by Credit Card" disabled="disabled"/></td>';
    }'
    <td></td>
    </tr>
      </table>
      </form>
      </div></div></div>';
}
}
?>
