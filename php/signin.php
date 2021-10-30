<?php
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
                $bdd = new PDO('mysql:host=localhost;dbname=b7_28056591_yugioh', 'DBoardUser','helha', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
                  if($konamiId==''&&$phone==''){
                    $requete = $bdd->prepare("INSERT INTO `useraccount` (`UserId`, `UserPseudo`, `UserPassword`, `UserKonamiId`, `UserLastName`, `UserFirstName`, `UserMail`, `UserPhone`, `UserRole`, `UserShopId`)
                    VALUES (NULL, '$username','$password', NULL, '$lastName', '$firstName', '$mail', NULL, 'Player', NULL) ;");
                  }else if($konamiId==''){
                    $requete = $bdd->prepare("INSERT INTO `useraccount` (`UserId`, `UserPseudo`, `UserPassword`, `UserKonamiId`, `UserLastName`, `UserFirstName`, `UserMail`, `UserPhone`, `UserRole`, `UserShopId`)
                    VALUES (NULL, '$username','$password', NULL, '$lastName', '$firstName', '$mail', '$phone', 'Player', NULL) ;");
                  }else if($phone==''){
                    $requete = $bdd->prepare("INSERT INTO `useraccount` (`UserId`, `UserPseudo`, `UserPassword`, `UserKonamiId`, `UserLastName`, `UserFirstName`, `UserMail`, `UserPhone`, `UserRole`, `UserShopId`)
                    VALUES (NULL, '$username','$password', '$konamiId', '$lastName', '$firstName', '$mail', NULL, 'Player', NULL) ;");
                  }else{
                    $requete = $bdd->prepare("INSERT INTO `useraccount` (`UserId`, `UserPseudo`, `UserPassword`, `UserKonamiId`, `UserLastName`, `UserFirstName`, `UserMail`, `UserPhone`, `UserRole`, `UserShopId`)
                    VALUES (NULL, '$username','$password', '$konamiId', '$lastName', '$firstName', '$mail', '$phone', 'Player', NULL) ;");
                  }
                  if($requete->execute()){
                    echo "<script type='text/javascript'>alert('Inscription ok');</script>";
                    //envoie de mail avec récapitulatif. (désactivé car nécessite des modification de wamp)
                    /*if(mail($mail,"DBoard Inscription","You just signed up.\nHere are your login details :\nUsername : $username\nPassword : $password2","From: projectuser26@gmail.com")){
                      echo "<script type='text/javascript'>alert('mail envoyer');</script>";
                    }*/
                  }
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
