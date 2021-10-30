<?php
session_start();
$username_mail = $password="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username_mail = $_POST["username_mail"];
  $password = $_POST["password"];
}
$bdd = new PDO('mysql:host=localhost;dbname=b7_28056591_yugioh', 'DBoardUser','helha', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
$requete = $bdd->prepare("SELECT `UserId`,`UserPseudo`, `UserMail`, `UserPassword`,`UserRole`,`UserShopId`
  FROM `useraccount`
  ORDER BY `UserId`;");
$requete->execute();
while ($userAccount = $requete->fetch())
  {
    if($userAccount['UserPseudo']==$username_mail || $userAccount['UserMail']==$username_mail){
      if(sha1($password)==$userAccount['UserPassword']){
        $_SESSION['pseudo'] = $userAccount['UserPseudo'];
        $_SESSION['role'] = $userAccount['UserRole'];
        $_SESSION['userId'] = $userAccount['UserId'];
        if($userAccount['UserShopId']>0){
          $_SESSION['shopId'] = $userAccount['UserShopId'];
        }else{
          $_SESSION['shopId'] = -1;
        }
        if($_SESSION['role']=="Player"){
          header("Location: ../index.html");
        }else if($_SESSION['role']=="Manager"){
          header("Location: ../manager/indexManager.html");
        }
      }
    }else{
      echo "<script type='text/javascript'>alert('Access Refused');</script>";
    }
  }
$requete->closeCursor();
?>
