<?php
session_start();
$shopId=$_SESSION['shopId'];
$bdd = new PDO('mysql:host=localhost;dbname=b7_28056591_yugioh', 'DBoardShop','helha', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$requete = $bdd->prepare("SELECT
(SELECT COUNT(*) FROM `participate`LEFT JOIN `event` ON `participate`.`EventId` = `event`.`EventId`LEFT JOIN `shop` ON `event`.`EventShopId` = `shop`.`ShopId`WHERE `event`.`EventShopId` = '$shopId') as nbPlayer,
(SELECT COUNT(*) FROM `participate`LEFT JOIN `event` ON `participate`.`EventId` = `event`.`EventId`LEFT JOIN `shop` ON `event`.`EventShopId` = `shop`.`ShopId`WHERE `event`.`EventShopId` = '$shopId'AND `participate`.`Payed` = '1'AND `participate`.`PricePayed` = '0') as nbFree,
(SELECT COUNT(*) FROM `participate`LEFT JOIN `event` ON `participate`.`EventId` = `event`.`EventId`LEFT JOIN `shop` ON `event`.`EventShopId` = `shop`.`ShopId`WHERE `event`.`EventShopId` = '$shopId'AND `participate`.`Payed` = '1'AND `participate`.`PricePayed` != '0') as nbPayed,
(SELECT COUNT(*) FROM `participate`LEFT JOIN `event` ON `participate`.`EventId` = `event`.`EventId`LEFT JOIN `shop` ON `event`.`EventShopId` = `shop`.`ShopId`WHERE `event`.`EventShopId` = '$shopId'AND `participate`.`Payed` = '0'AND `participate`.`PricePayed` != '0') as nbUnpayed,
(SELECT COUNT(*) FROM `event`LEFT JOIN `shop` ON `event`.`EventShopId` = `shop`.`ShopId`WHERE `event`.`EventShopId` = '$shopId') as nbEvent,
(SELECT COUNT(*) FROM `event`LEFT JOIN `shop` ON `event`.`EventShopId` = `shop`.`ShopId`WHERE `event`.`EventShopId` = '$shopId' AND `event`.`EventType` = 'OTS') as nbOTS,
(SELECT COUNT(*) FROM `event`LEFT JOIN `shop` ON `event`.`EventShopId` = `shop`.`ShopId`WHERE `event`.`EventShopId` = '$shopId' AND `event`.`EventType` = 'WCQ') as nbWCQ,
(SELECT COUNT(*) FROM `event`LEFT JOIN `shop` ON `event`.`EventShopId` = `shop`.`ShopId`WHERE `event`.`EventShopId` = '$shopId' AND `event`.`EventType` = 'YCS') as nbYCS,
(SELECT COUNT(*) FROM `event`LEFT JOIN `shop` ON `event`.`EventShopId` = `shop`.`ShopId`WHERE `event`.`EventShopId` = '$shopId' AND `event`.`EventType` = 'Extravaganza') as nbExtravaganza,
(SELECT COUNT(*) FROM `event`LEFT JOIN `shop` ON `event`.`EventShopId` = `shop`.`ShopId`WHERE `event`.`EventShopId` = '$shopId' AND `event`.`EventRemote` = '1') as nbRemote
FROM `participate`
LEFT JOIN `event` ON `participate`.`EventId` = `event`.`EventId`
LEFT JOIN `shop` ON `event`.`EventShopId` = `shop`.`ShopId`
WHERE `event`.`EventShopId` = '$shopId' ;");
$requete->execute();
$stat=$requete->fetch();

echo'
<div class="box-container">
  <div class="box">
    <div class="info">
    <h3>Statistics</h3>
    <table class="table">
      <tr>
        <td><p>Number of Events Create : '.$stat['nbEvent'].'</p></td>
        <td><p>Number of Remote Duel Events Create : '.$stat['nbRemote'].'</p></td>
      </tr>
      <tr>
        <td><p>Number of OTS Events Create : '.$stat['nbOTS'].'</p></td>
        <td><p>Number of WCQ Events Create : '.$stat['nbWCQ'].'</p></td>
      </tr>
      <tr>
        <td><p>Number of YCS Events Create : '.$stat['nbYCS'].'</p></td>
        <td><p>Number of Extravaganza Events Create : '.$stat['nbExtravaganza'].'</p></td>
      </tr>
      <tr>
        <td><p>Number of Participation total : '.$stat['nbPlayer'].'</p></td>
        <td><p>Number of Unpayed Participation : '.$stat['nbUnpayed'].'</p></td>
      </tr>
      <tr>
        <td><p>Number of free Participation : '.$stat['nbFree'].'</p></td>
        <td><p>Number of Payed Participation : '.$stat['nbPayed'].'</p></td>
      </tr>
    </table>
    </div>
  </div>
</div>';
?>
