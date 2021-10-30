<?php
session_start();
$shopId=$_SESSION['shopId'];
$eventId = $_SESSION['EventId'];
$bdd = new PDO('mysql:host=localhost;dbname=b7_28056591_yugioh', 'DBoardShop','helha', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$name = $type = $date = $strdate = $giftName = $eventInfo = $street = $number = $postCode = $city = $country = "";
$maxInscription = $minPrice = $maxPrice = $giftMax = $giftScale = 0;
$eventAtShop = $eventRemote = $fixPrice = 0;
var_dump($_POST);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $eventAtShop = (int)$_POST["atShop"];
  $eventRemote = (int)$_POST["remoteDuel"];
  $fixPrice = (int)$_POST["fixedPrice"];
  $maxInscription = (int)$_POST["maxEntry"];
  $minPrice = (int)$_POST["minPrice"];
  $maxPrice = (int)$_POST["maxPrice"];
  $giftName = $_POST["giftName"];
  $giftMax = (int)$_POST["giftNumber"];
  $giftScale = (int)$_POST["giftScale"];
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
                      $requete = $bdd->prepare("UPDATE `event`
                      SET `EventName` = '$name', `EventAtShop` = '$eventAtShop', `EventStreet` = '$street', `EventNumber` = '$number', `EventCity` = '$city', `EventPostCode` = '$postCode', `EventCountry` = '$country', `EventDate` = '$date', `EventMaxEntry` = '$maxInscription', `EventFixedPrice` = '$fixPrice', `EventMinPrice` = '$minPrice', `EventMaxPrice` = '$maxPrice', `EventGiftName` = '$giftName', `EventGiftLimite` = '$giftMax', `EventGiftScale` = '$giftScale', `EventInfo` = '$eventInfo', `EventRemote` = '$eventRemote', `EventType` = '$type'
                      WHERE `event`.`EventId` = '$eventId';");
                    }else{
                      $requete = $bdd->prepare("UPDATE `event`
                      SET `EventName` = '$name', `EventAtShop` = '$eventAtShop', `EventStreet` = '$street', `EventNumber` = '$number', `EventCity` = '$city', `EventPostCode` = '$postCode', `EventCountry` = '$country', `EventDate` = '$date', `EventMaxEntry` = '$maxInscription', `EventFixedPrice` = '$fixPrice', `EventMinPrice` = '$minPrice', `EventMaxPrice` = '$maxPrice', `EventGiftName` = '$giftName', `EventGiftLimite` = '$giftMax', `EventGiftScale` = '$giftScale', `EventInfo` = NULL, `EventRemote` = '$eventRemote', `EventType` = '$type'
                      WHERE `event`.`EventId` = '$eventId';");
                    }

                    $requete->execute();
                    $requete->closeCursor();
                  }
                }
              }
            }
          }
        }
      }
    }
  }
}
?>
