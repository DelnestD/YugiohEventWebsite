<?php
session_start();
$shopId=$_SESSION['shopId'];
$bdd = new PDO('mysql:host=localhost;dbname=b7_28056591_yugioh', 'DBoardShop','helha', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$requete = $bdd->prepare("SELECT `ShopStreet`, `ShopNumber`, `ShopCity`, `ShopPostCode`, `ShopCountry`
FROM `shop`
WHERE `ShopId` = '$shopId';");
$requete->execute();
$shop = $requete->fetch();

$name = $type = $date = $strdate = $giftName = $eventInfo = "";
$maxInscription = $minPrice = $maxPrice = $giftMax = $giftScale = 0;
$eventAtShop = $eventRemote = $fixPrice = 0;

$street=$shop["ShopStreet"];
$number=$shop["ShopNumber"];
$postCode=$shop["ShopPostCode"];
$city=$shop["ShopCity"];
$country=$shop["ShopCountry"];
$requete->closeCursor();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $eventAtShop = (int)$_POST["atShop"];
  $eventRemote = (int)$_POST["remoteDuel"];
  $fixPrice = (int)$_POST["fixedPrice"];
  $maxInscription = (int)$_POST["maxEntry"];
  $minPrice = (int)$_POST["minPrice"];
  $maxPrice = (int)$_POST["maxPrice"];
  $giftMax = (int)$_POST["giftNumber"];
  $giftScale = (int)$_POST["giftScale"];

  if($eventAtShop==0){
    if(!$_POST["street"]==""){
      $street=$_POST["street"];
      if(!$_POST["number"]==""){
        $number=$_POST["number"];
        if(!$_POST["postCode"]==""){
          $postCode=$_POST["postCode"];
          if(!$_POST["city"]==""){
            $city=$_POST["city"];
            if(!$_POST["country"]==""){
              $country=$_POST["country"];
            }
          }
        }
      }
    }
  }

  if(!$_POST["eventName"]==""){
    $name = $_POST["eventName"];
    if(!$_POST["eventType"]==""){
      $type = $_POST["eventType"];
      if(!$_POST["date"]=="" && !$_POST["time"]==""){
        $strdate = strtotime($_POST["date"])-strtotime(date('Y-m-d',strtotime("now")));
        $date = date('Y-m-d H:i:s', (strtotime($_POST["time"])+$strdate));
        if(!$_POST["giftName"]==""){
          $giftName = $_POST["giftName"];
          if(!$_POST["eventInfo"]==""){
            $eventInfo = $_POST["eventInfo"];
          }
          if(strstr($street, "'")){
            $street = str_replace("'","\'",$street);
          }
          if(strstr($eventInfo, PHP_EOL)){
            $eventInfo = str_replace(PHP_EOL,"<br>\n",$eventInfo);
          }

          if(!$eventInfo==""){
            $requete2 = $bdd->prepare("INSERT INTO `event` (`EventId`, `EventName`, `EventAtShop`, `EventShopId`, `EventStreet`, `EventNumber`, `EventCity`, `EventPostCode`, `EventCountry`, `EventDate`, `EventMaxEntry`, `EventFixedPrice`, `EventMinPrice`, `EventMaxPrice`, `EventGiftName`, `EventGiftLimite`, `EventGiftScale`, `EventInfo`, `EventRemote`, `EventType`)
            VALUES (NULL, '$name', '$eventAtShop', '$shopId', '$street', '$number', '$city', '$postCode', '$country', '$date', '$maxInscription', '$fixPrice', '$minPrice', '$maxPrice', '$giftName', '$giftMax', '$giftScale', '$eventInfo', '$eventRemote', '$type')  ;");
          }else{
            $requete2 = $bdd->prepare("INSERT INTO `event` (`EventId`, `EventName`, `EventAtShop`, `EventShopId`, `EventStreet`, `EventNumber`, `EventCity`, `EventPostCode`, `EventCountry`, `EventDate`, `EventMaxEntry`, `EventFixedPrice`, `EventMinPrice`, `EventMaxPrice`, `EventGiftName`, `EventGiftLimite`, `EventGiftScale`, `EventInfo`, `EventRemote`, `EventType`)
            VALUES (NULL, '$name', '$eventAtShop', '$shopId', '$street', '$number', '$city', '$postCode', '$country', '$date', '$maxInscription', '$fixPrice', '$minPrice', '$maxPrice', '$giftName', '$giftMax', '$giftScale', NULL, '$eventRemote', '$type')  ;");
          }

          $requete2->execute();
          $requete2->closeCursor();
        }
      }
    }
  }
}
?>
