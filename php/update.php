<?php
session_start();
$userId = $_SESSION['userId'];
$username = $mail = $firstName = $lastName = $konamiId = $phone = $password = $password2 = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $konamiId = $_POST["konami_id"];
  $phone = $_POST["phone"];
  if(!$_POST["username"]==""){
    $username = $_POST["username"];
    if(!$_POST["password"]==""){
      $password = $_POST["password"];
      if(!$_POST["password2"]==""){
        $password2 = $_POST["password2"];
        if(!$_POST["last_name"]==""){
          $lastName = $_POST["last_name"];
          if(!$_POST["first_name"]==""){
            $firstName = $_POST["first_name"];
            if(!$_POST["mail"]==""){
              $mail = $_POST["mail"];
              if($password==$password2){
                $password = SHA1($password2);
                $bdd = new PDO('mysql:host=localhost;dbname=b7_28056591_yugioh', 'DBoardPlayer','helha', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
                  if($konamiId==''&&$phone==''){
                    $requete = $bdd->prepare("UPDATE `useraccount`
                    SET `UserPseudo` = '$username', `UserPassword` = '$password', `UserKonamiId` = NULL, `UserLastName` = '$lastName', `UserFirstName` = '$firstName', `UserMail` = '$mail', `UserPhone` = NULL
                    WHERE `useraccount`.`UserId` = '$userId' ;");
                  }else if($konamiId==''){
                    $requete = $bdd->prepare("UPDATE `useraccount`
                    SET `UserPseudo` = '$username', `UserPassword` = '$password', `UserKonamiId` = NULL, `UserLastName` = '$lastName', `UserFirstName` = '$firstName', `UserMail` = '$mail', `UserPhone` = '$phone'
                    WHERE `useraccount`.`UserId` = '$userId' ;");
                  }else if($phone==''){
                    $requete = $bdd->prepare("UPDATE `useraccount`
                    SET `UserPseudo` = '$username', `UserPassword` = '$password', `UserKonamiId` = '$konamiId', `UserLastName` = '$lastName', `UserFirstName` = '$firstName', `UserMail` = '$mail', `UserPhone` = NULL
                    WHERE `useraccount`.`UserId` = '$userId' ;");
                  }else{
                    $requete = $bdd->prepare("UPDATE `useraccount`
                    SET `UserPseudo` = '$username', `UserPassword` = '$password', `UserKonamiId` = '$konamiId', `UserLastName` = '$lastName', `UserFirstName` = '$firstName', `UserMail` = '$mail', `UserPhone` = '$phone'
                    WHERE `useraccount`.`UserId` = '$userId' ;");
                  }
                  $requete->execute();
                }
                $requete->closeCursor();
            }
          }
        }
      }
    }
  }
}
?>
