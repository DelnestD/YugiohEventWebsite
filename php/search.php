<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nameEvent ="";
  if(!$_POST["search"]==""){
    $nameEvent=$_POST["search"];
    $nameEvent = "%".$nameEvent."%";
    $_SESSION["eventName"]=$nameEvent;
  }
}
?>
