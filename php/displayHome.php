<?php
session_start();
$nbBox=0;
$nbBoxMax=12;
$bdd = new PDO('mysql:host=localhost;dbname=b7_28056591_yugioh', 'DBoardUser','helha', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
$requete = $bdd->prepare("SELECT `event`.`EventId`,`event`.`EventName`, `shop`.`ShopName`, `event`.`EventCity`, (Select COUNT(*) FROM participate WHERE `participate`.`EventId`=`event`.`EventId`) as nbPlayer,`event`.`EventMaxEntry`, DATE_FORMAT(`event`.`EventDate`,'%d/%m/%Y - %H:%i') as evDate,`event`.`EventType`
FROM `event`
LEFT JOIN `shop` ON `event`.`EventShopId` = `shop`.`ShopId`
WHERE TIMESTAMP(`event`.`EventDate`) >= TIMESTAMP(NOW())
ORDER BY `event`.`EventDate` ;");
$requete->execute();
echo '<div class="box-container">';
while ($nbBox<$nbBoxMax && $event = $requete->fetch())
  {
    if($event['nbPlayer']==$event['EventMaxEntry']){
    echo'
    <div class="box">
        <div class="image">
          <img src="images/Logo-SoldOut/'.$event['EventType'].'.png" alt="">
        </div>
        <div class="info">
            <h3>'.$event['EventName'].'</h3>
            <div class="subInfo">
              <span>'.$event['ShopName'].' - '.$event['EventCity'].'</span>
              <span>'.$event['evDate'].'</span>
            </div>
        </div>
        <div class="overlay">
            <a href="" style="--i:3;" class="fas fa-search" id="'.$event['EventId'].'"></a>
        </div>
    </div>
    ';
    $nbBox++;
  }else{
    echo'
    <div class="box">
        <div class="image">
    <img src="images/Logo/'.$event['EventType'].'.png" alt="">
    </div>
    <div class="info">
        <h3>'.$event['EventName'].'</h3>
        <div class="subInfo">
          <span>'.$event['ShopName'].' - '.$event['EventCity'].'</span>
          <span>'.$event['evDate'].'</span>
        </div>
    </div>
    <div class="overlay">
        <a href="" style="--i:3;" class="fas fa-search" id="'.$event['EventId'].'"></a>
    </div>
  </div>
  ';
  $nbBox++;
  }
  }
  echo '</div>';
  $requete->closeCursor();
?>
