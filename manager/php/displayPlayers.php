<?php
session_start();
if(isset($_COOKIE["eventId"])&&!empty($_COOKIE["eventId"])){
  $_SESSION['EventId']  = $_COOKIE["eventId"];
}
$eventId = $_SESSION['EventId'];
$bdd = new PDO('mysql:host=localhost;dbname=b7_28056591_yugioh', 'DBoardShop','helha', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$requete = $bdd->prepare("SELECT `participate`.`UserId`,`useraccount`.`UserLastName`,`useraccount`.`UserFirstName`,`useraccount`.`UserKonamiId`,`participate`.`Payed`,`participate`.`PricePayed`,`participate`.`PayementMethod`,`participate`.`GiftReceive`
FROM `participate`
LEFT JOIN `useraccount` ON `participate`.`UserId` = `useraccount`.`UserId`
WHERE `participate`.`EventId` = '$eventId' ;");
$requete->execute();
echo '<div class="box-container">
  <div class="box">
  <div class="info">
  <form class="" action="" method="post">
  <table class="table_form" >
    <tr rowspan="7"><td><h3>Event\'s Players</h3></td></tr>
    <tr>
      <td class="border white">Konami Id</td>
      <td class="border white">Last Name</td>
      <td class="border white">First Name</td>
      <td class="border white">Payed</td>
      <td class="border white">Price Payed</td>
      <td class="border white">Payement Method</td>
      <td class="border white">Gift Receive</td>
    </tr>
    <tr rowspan="7"><td>&nbsp;</td></tr>';
while ($player = $requete->fetch()){
  echo'<tr>
    <td class="border white">'.$player['UserKonamiId'].'</td>
    <td class="border white">'.$player['UserLastName'].'</td>
    <td class="border white">'.$player['UserFirstName'].'</td>
    ';
    if($player['Payed']==true){
      echo'<td class="border white">YES</td>';
    }else{
      echo'<td class="border white">NO</td>';
    }
    echo'<td class="border white">'.$player['PricePayed'].' €</td>
    <td class="border white">'.$player['PayementMethod'].'</td>';
    if($player['GiftReceive']==true){
      echo'<td class="border white">YES</td>';
    }else{
      echo'<td class="border white">NO</td>';
    }

    echo'
    <td><a><i id="'.$player['UserId'].'" class="fas fa-pencil-alt"></i></a></td>
    <td><a><i id="'.$player['UserId'].'" class="fas fa-times-circle"></i></a></td>
  </tr>
  <tr rowspan="7"><td>&nbsp;</td></tr>';
}
echo '</table></form></div></div></div>';
?>
