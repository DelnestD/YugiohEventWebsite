<?php
session_start();
$userPseudo = $_SESSION['pseudo'];
$bdd = new PDO('mysql:host=localhost;dbname=b7_28056591_yugioh', 'DBoardShop','helha', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
$requete = $bdd->prepare("SELECT *
  FROM `useraccount`
  WHERE `UserPseudo` = '$userPseudo';");
$requete->execute();
$userAccount = $requete->fetch();
echo'<div class="box-container">
<div class="box">
  <div class="info">
    <h3>Profil Informations</h3>
    <form class="" action="php/update.php" method="post">
      <table class="table_form">
        <tr>
          <td><p>Last Name</p>
          <input type="text" name="last_name" value="'.$userAccount['UserLastName'].'"/></td>
          <td><p>First Name</p>
          <input type="text" name="first_name" value="'.$userAccount['UserFirstName'].'"/></td>
        </tr>
        <tr>
          <td><p>Username</p>
          <input type="text" name="username" value="'.$userAccount['UserPseudo'].'"/></td>
          <td><p>Konami ID (optionnal)</p>
          <input type="text" name="konami_id" value="'.$userAccount['UserKonamiId'].'"/></td>
        </tr>
        <tr>
          <td><p>Mail</p>
          <input type="text" name="mail" value="'.$userAccount['UserMail'].'"/></td>
          <td><p>Phone (Optional)</p>
          <input type="text" name="phone" value="'.$userAccount['UserPhone'].'"/></td>
        </tr>
        <tr>
          <td><p>Password</p>
          <input type="password" name="password" /></td>
          <td><p>Confirm Password</p>
          <input type="password" name="password2" /></td>
        </tr>
        <tr>
          <td><input type="submit" class="btnStd" name="Update" value="Update"/></td>
          <td><input type="submit" class="btnStd" name="Logout" id="btnLogout" value="Logout"/></td>
        </tr>
      </table>
    </form>
</div>
</table>
</div>
</div>
</div>';
?>
