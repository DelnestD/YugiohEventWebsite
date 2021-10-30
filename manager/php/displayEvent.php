<?php
session_start();
$_SESSION['EventId']  = $_COOKIE["eventId"];
$eventId = $_SESSION['EventId'];
$bdd = new PDO('mysql:host=localhost;dbname=b7_28056591_yugioh', 'DBoardShop','helha', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
$requete = $bdd->prepare("SELECT `event`.`EventName`, `shop`.`ShopName`, (Select COUNT(*) FROM participate WHERE `participate`.`EventId`=`event`.`EventId`) as nbPlayer,
`event`.`EventMaxEntry`, DATE_FORMAT(`event`.`EventDate`,'%W %d %M %Y at %H:%i') as evDate,`event`.`EventType`,`event`.`EventStreet`,`event`.`EventNumber`,`event`.`EventCity`,`event`.`EventPostCode`,
`event`.`EventCountry`,`event`.`EventFixedPrice`,`event`.`EventMinPrice`,`event`.`EventMaxPrice`,`event`.`EventGiftName`,`event`.`EventGiftLimite`,`event`.`EventGiftScale`,`event`.`EventInfo`,`event`.`EventRemote`
FROM `event`
LEFT JOIN `shop` ON `event`.`EventShopId` = `shop`.`ShopId`
WHERE `event`.`EventId`= '$eventId' ;");
$requete->execute();
$event = $requete->fetch();
$remainingPlaces = $event['EventMaxEntry'] - $event['nbPlayer'];
echo'<div class="box-container">
<div class="box">
  <div class="info">
  <form class="" action="" method="post">
  <table class="table_form">
    <tr colspan="2"><td><h3>Informations</h3></td></tr>
    <tr>';
if($remainingPlaces==0){
    echo'<td rowspan="10"><img class="image2" src="../images/Logo-SoldOut/'.$event['EventType'].'.png" alt=""></td>';
}else{
    echo'<td rowspan="10"><img class="image2" src="../images/Logo/'.$event['EventType'].'.png" alt=""></td>';
}
    echo'
        <td><h2>'.$event['EventName'].'</h2><br>'.$event['EventInfo'].'</td>
    </tr>';
if($event['EventRemote']==true){
  echo' <tr><td><img class="image3" src="../images/Remote.png" alt=""></td></tr>
        <tr><td>Start the '.$event['evDate'].'</td></tr>
        <tr><td>Organisation by '.$event['ShopName'].'</td></tr>
        <tr><td>Shop Address for prize :<br>
        '.$event['EventStreet'].' '.$event['EventNumber'].'<br>
        '.$event['EventPostCode'].' '.$event['EventCity'].'<br>
        '.$event['EventCountry'].'
        </td></tr>';
}else{
  echo' <tr><td>Start the '.$event['evDate'].'</td></tr>
        <tr><td>Organisation by '.$event['ShopName'].'</td></tr>
        <tr><td>Tournament Address :<br>
        '.$event['EventStreet'].' '.$event['EventNumber'].'<br>
        '.$event['EventPostCode'].' '.$event['EventCity'].'<br>
        '.$event['EventCountry'].'
        </td></tr>';
}
echo'<tr><td>Remaining Places : '.$remainingPlaces;
if($event['EventFixedPrice']==true){
  echo' <tr><td> Entrance Fee  : '.$event['EventMaxPrice'].' €<br>
                 Offered for Participation :  '.$event['EventGiftLimite'].' '.$event['EventGiftName'].'
        </td></tr>';
}else{
  echo' <tr><td> Entrance Fee (min : '.$event['EventMinPrice'].' € - max : '.$event['EventMaxPrice'].' €) : <input class="cart" type="text" name="entranceFee" disabled="disabled"/> €<br>
        Offered for Participation :  1 '.$event['EventGiftName'].' on every '.$event['EventGiftScale'].' € of the Entrance Fee
        </td></tr>';
}

  echo'<tr><td><input class="cart" type="submit" name="AddCart" value="Add to the Cart" disabled="disabled"/></td></tr>
  </table>
  </form>
  </div></div></div>';
?>
