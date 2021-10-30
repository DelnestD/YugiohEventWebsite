<?php
session_start();
$userPseudo = $_SESSION['pseudo'];
$bdd = new PDO('mysql:host=localhost;dbname=b7_28056591_yugioh', 'DBoardShop','helha', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
$requete = $bdd->prepare("SELECT `useraccount`.`UserPseudo`, `shop`.`ShopStreet`, `shop`.`ShopNumber`, `shop`.`ShopCity`, `shop`.`ShopPostCode`, `shop`.`ShopCountry`
FROM `useraccount`
LEFT JOIN `shop` ON `useraccount`.`UserShopId` = `shop`.`ShopId`
WHERE `useraccount`.`UserPseudo` = '$userPseudo';");
$requete->execute();
$userShop = $requete->fetch();
echo'<div class="box-container">
<div class="box">
  <div class="info">
    <h3>Add an Event</h3>
    <form class="" id="addEventForm" action="" method="post">
      <table class="table_form">
        <tr>
          <td><p>Event\'s Name</p>
          <input type="text" name="eventName"/></td>
          <td><p>Event\'s Type (for the logo picture)</p>
          <select type="text" name="eventType">
            <option value="OTS">OTS</option>
            <option value="WCQ">WCQ</option>
            <option value="YCS">YCS</option>
            <option value="Extravaganza">Extravaganza</option>
          </select></td>
          <td><p>Event\'s Date and Time</p>
          <input type="date" name="date"/><br><input type="time" name="time"/></td>
        </tr>
        <tr>
          <td><label for="atShop">Event at Shop ?</label>
          <input class="checkbox" type="checkbox" id="atShop_check" name="atShop_check" checked>
          <input type="hidden" id="atShop" name="atShop" value="1" /></td>
          <td><label for="remoteDuel">Event Remote Duel ?</label>
          <input class="checkbox" type="checkbox" id="remoteDuel_check" name="remoteDuel_check">
          <input type="hidden" id="remoteDuel" name="remoteDuel" value="0" /></td>
          <td><p>Maximum of inscription</p>
          <input type="number" name="maxEntry"/></td>
        </tr>
        <tr>
          <td><label for="fixedPrice">Fix Price ?</label>
          <input class="checkbox" type="checkbox" id="fixedPrice_check" name="fixedPrice_check" checked>
          <input type="hidden" id="fixedPrice" name="fixedPrice" value="1" /></td>
          <td>
          <p>Street and Number</p>
          <input type="text" name="street" id="street" value="'.$userShop['ShopStreet'].'" disabled="disabled"><input type="text" name="number" id="number" value="'.$userShop['ShopNumber'].'" disabled="disabled">
          </td>
          <td><p>Gift for participation\'s name</p>
          <input type="text" name="giftName"></td>
        </tr>
        <tr>
          <td><p>Min Price</p>
          <input type="number" id="minPrice" name="minPrice" disabled="disabled"/>
          <p>Max Price</p>
          <input type="number" name="maxPrice" /></td>
          <td><p>Post Code and City</p>
          <input type="text" name="postCode" id="postCode" value="'.$userShop['ShopPostCode'].'" disabled="disabled"><input type="text" name="city" id="city" value="'.$userShop['ShopCity'].'" disabled="disabled">
          <p>Country</p>
          <input type="text" name="country" id="country" value="'.$userShop['ShopCountry'].'" disabled="disabled"></td>
          <td><p>Maximum Number of Gift for participation\'s</p>
          <input type="number" name="giftNumber"/>
          <p>Gift for participation\'s Scale (1 per ... €)</p>
          <input type="number" name="giftScale" /></td>
        </tr>
        <tr>
          <td colspan="3"><p>Event Infos</p>
          <textarea  name="eventInfo" rows="4" cols="150"></textarea></td>
        </tr>
        <tr>
          <td colspan="3"><input type="submit" class="btnStd" id="btnAddEvent" name="Validation" value="Validation"/></td>
        </tr>
      </table>
    </form>
</div>
</div>';
?>
