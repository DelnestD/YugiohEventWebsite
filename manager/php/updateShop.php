<?php
session_start();
$shopId = $_SESSION['shopId'];
$name=$phone=$mail=$street=$number=$postCode=$city=$country="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(!$_POST['name']==""){
    $name=$_POST['name'];
    if(!$_POST['name']==""){
      $phone=$_POST['phone'];
      if(!$_POST['name']==""){
        $mail=$_POST['mail'];
        if(!$_POST['name']==""){
          $street=$_POST['street'];
          if(!$_POST['name']==""){
            $number=$_POST['number'];
            if(!$_POST['name']==""){
              $postCode=$_POST['postCode'];
              if(!$_POST['name']==""){
                $city=$_POST['city'];
                if(!$_POST['name']==""){
                  $country=$_POST['country'];
                  if(strstr($name, "'")){
                    $name = str_replace("'","\'",$name);
                  }
                  if(strstr($street, "'")){
                    $street = str_replace("'","\'",$street);
                  }

                  $bdd = new PDO('mysql:host=localhost;dbname=b7_28056591_yugioh', 'DBoardShop','helha', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
                  $requete = $bdd->prepare("UPDATE `shop`
                    SET `ShopName` = '$name', `ShopStreet` = '$street', `ShopNumber` = '$number', `ShopCity` = '$city', `ShopPostCode` = '$postCode', `ShopCountry` = '$country', `ShopMail` = '$mail', `ShopPhone` = '$phone'
                    WHERE `shop`.`ShopId` = '$shopId';");
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
?>
