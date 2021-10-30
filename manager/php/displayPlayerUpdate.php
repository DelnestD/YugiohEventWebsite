<?php
session_start();
$eventId = $_SESSION['EventId'];
$userId = $_COOKIE['UserId'];
$bdd = new PDO('mysql:host=localhost;dbname=b7_28056591_yugioh', 'DBoardShop','helha', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
$requete = $bdd->prepare("SELECT `useraccount`.`UserLastName`,`useraccount`.`UserFirstName`,`participate`.`Payed`,`participate`.`PricePayed`,`participate`.`PayementMethod`,`participate`.`GiftReceive`
FROM `participate`
LEFT JOIN `useraccount` ON `participate`.`UserId` = `useraccount`.`UserId`
WHERE `participate`.`EventId` = '$eventId' AND `participate`.`UserId` = '$userId';");
$requete->execute();
$userAccount = $requete->fetch();
echo'<div class="box-container">
<div class="box">
  <div class="info">
    <h3>Participant Modification</h3>
    <form id="updatePlayerForm" action="" method="post">
      <table class="table_form">
        <tr>
          <td><p>Last Name : '.$userAccount['UserLastName'].'</p></td>
          <td><p>First Name : '.$userAccount['UserFirstName'].'</p></td>
          <input type="hidden" id="userId" name="userId" value="'.$userId.'" />
        </tr>
        <tr>
        <td><label for="atShop">Payed ?</label>';
        if($userAccount['Payed']==true){
          echo'<input class="checkbox" type="checkbox" id="payed_check" name="payed_check" checked>';
        }else{
          echo'<input class="checkbox" type="checkbox" id="payed_check" name="payed_check">';
        }
        echo'
        <input type="hidden" id="payed" name="payed" value="'.$userAccount['Payed'].'" /><br>
        <label for="atShop">Gift Receive ?</label>';
        if($userAccount['GiftReceive']==true){
          echo'<input class="checkbox" type="checkbox" id="giftReceive_check" name="giftReceive_check" checked>';
        }else{
          echo'<input class="checkbox" type="checkbox" id="giftReceive_check" name="giftReceive_check">';
        }
        echo'
        <input type="hidden" id="giftReceive" name="giftReceive" value="'.$userAccount['GiftReceive'].'" /></td>
          <td><p>Konami ID (Optional)</p>
          <input type="number" name="pricePayed" value="'.$userAccount['PricePayed'].'"required/></td>
        </tr>
        <tr>
          <td colspan="2"><input type="submit" class="btnStd" name="Update" id="btnUpdatePlayer" value="Update"/></td>
        </tr>
      </table>
    </form>
</div>';
?>
