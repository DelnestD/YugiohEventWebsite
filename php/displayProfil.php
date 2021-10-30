<?php
session_start();
$userPseudo = $_SESSION['pseudo'];
$bdd = new PDO('mysql:host=localhost;dbname=b7_28056591_yugioh', 'DBoardPlayer','helha', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
$requete = $bdd->prepare("SELECT *, (Select COUNT(*) FROM participate WHERE `participate`.`UserId`=`useraccount`.`UserId`) as nbEvent
  FROM `useraccount`
  WHERE `UserPseudo` = '$userPseudo';");
$requete->execute();
$userAccount = $requete->fetch();
echo'<div class="box-container">
<div class="box">
  <div class="info">
    <h3>Profil Informations</h3>
    <form id="updateForm" action="" method="post">
      <table class="table_form">
        <tr>
          <td><p>Last Name</p>
          <input type="text" name="last_name" value="'.$userAccount['UserLastName'].'"required/></td>
          <td><p>First Name</p>
          <input type="text" name="first_name" value="'.$userAccount['UserFirstName'].'"required/></td>
        </tr>
        <tr>
          <td><p>Username</p>
          <input type="text" name="username" value="'.$userAccount['UserPseudo'].'"required/></td>
          <td><p>Konami ID (Optional)</p>
          <input type="text" name="konami_id" value="'.$userAccount['UserKonamiId'].'"/></td>
        </tr>
        <tr>
          <td><p>Mail</p>
          <input type="email" name="mail" value="'.$userAccount['UserMail'].'"required/></td>
          <td><p>Phone (Optional)</p>
          <input type="text" name="phone" value="'.$userAccount['UserPhone'].'"/></td>
        </tr>
        <tr>
          <td><p>Password</p>
          <input type="password" name="password" required/></td>
          <td><p>Confirm Password</p>
          <input type="password" name="password2" required/></td>
        </tr>
        <tr>
          <td><input type="submit" class="btnStd" name="Update" id="btnUpdate" value="Update"/></td>
          <td><input type="submit" class="btnStd" name="Logout" id="btnLogout" value="Logout"/></td>
        </tr>
      </table>
    </form>
</div>';
if($userAccount['nbEvent']>0){
echo'
<div class="info">
  <h3>My Events</h3>
    <table class="table_Event">
      <tr class="border">
      <td class="border">Event</td>
      <td class="border">Organizer</td>
      <td class="border">Date</td>
      <td class="border">Tournament Address</td>
      <td class="border">Payed</td>
      <td class="border">PricePayed</td>
      <td class="border">Gift Receive</td>
      </tr>';
$requete2 = $bdd->prepare("SELECT `participate`.`Payed`, `participate`.`PricePayed`, `participate`.`GiftReceive`, `event`.`EventName`, `shop`.`ShopName`,DATE_FORMAT(`event`.`EventDate`,'%d/%m/%Y - %H:%i') as evDate,
`event`.`EventStreet`,`event`.`EventNumber`,`event`.`EventCity`,`event`.`EventPostCode`,
`event`.`EventCountry`
FROM `useraccount`
LEFT JOIN `participate` ON `participate`.`UserId` = `useraccount`.`UserId`
LEFT JOIN `event` ON `participate`.`EventId` = `event`.`EventId`
LEFT JOIN `shop` ON `event`.`EventShopId` = `shop`.`ShopId`
WHERE `useraccount`.`UserPseudo`= '$userPseudo'
ORDER BY `event`.`EventDate` DESC;");
$requete2->execute();
while($participation = $requete2->fetch()){
  echo' <tr class="border">
        <td class="border">'.$participation['EventName'].'</td>
        <td class="border">'.$participation['ShopName'].'</td>
        <td class="border">'.$participation['evDate'].'</td>
        <td class="border">'.$participation['EventStreet'].' '.$participation['EventNumber'].'<br>
        '.$participation['EventPostCode'].' '.$participation['EventCity'].'<br>
        '.$participation['EventCountry'].'</td>';
        if($participation['Payed']==true){
          echo'<td class="border">YES</td>';
        }else{
          echo'<td class="border">NO</td>';
        }
        echo'<td class="border">'.$participation['PricePayed'].' €</td>';
        if($participation['GiftReceive']==true){
          echo'<td class="border">YES</td></tr>';
        }else{
          echo'<td class="border">NO</td></tr>';
        }
}

echo'</table>
</div>
</div>
</div>';}
?>
