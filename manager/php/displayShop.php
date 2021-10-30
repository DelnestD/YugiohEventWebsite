<?php
session_start();
$shopId = $_SESSION['shopId'];
$bdd = new PDO('mysql:host=localhost;dbname=b7_28056591_yugioh', 'DBoardShop','helha', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
$requete = $bdd->prepare("SELECT *
  FROM `shop`
  WHERE `ShopId` = '$shopId';");
$requete->execute();
$shop = $requete->fetch();
echo'<div class="box-container">
<div class="box">
  <div class="info">
    <h3>Update Shop Information</h3>
    <form class="" id="updateShopForm" action="" method="post">
      <table class="table_form">
        <tr>
        <td><p>Shop\'s Name</p>
        <input type="text" name="name" value="'.$shop['ShopName'].'"/></td>
        <td>
        <p>Street and Number</p>
        <input type="text" name="street" id="street" value="'.$shop['ShopStreet'].'"><input type="text" name="number" id="number" value="'.$shop['ShopNumber'].'">
        </td>
        </tr>
        <tr>
        <td><p>Phone</p><input type="text" name="phone" value="'.$shop['ShopPhone'].'"/>
        <p>Mail</p><input type="text" name="mail" value="'.$shop['ShopMail'].'"/></td>
        <td><p>Post Code and City</p>
        <input type="text" name="postCode" id="postCode" value="'.$shop['ShopPostCode'].'"><input type="text" name="city" id="city" value="'.$shop['ShopCity'].'">
        <p>Country</p>
        <input type="text" name="country" id="country" value="'.$shop['ShopCountry'].'"></td>
        </tr>
        <tr>
          <td colspan="2"><input type="submit" class="btnStd" id="btnUpdateShop" name="UpdateShop" value="Update"/></td>
        </tr>
      </table>
    </form>
</div>
</div>';
?>
