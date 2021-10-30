<?php
session_start();
if(isset($_SESSION['cart'])&&!empty($_SESSION['cart'])){
  if($_SESSION['EventFixedPrice']==true){
    array_push($_SESSION['cart'],array($_SESSION['EventId'] ,$_SESSION['Price']));
  }else{
    array_push($_SESSION['cart'],array($_SESSION['EventId'] ,$_POST['entranceFee']));
  }
}else{
  if($_SESSION['EventFixedPrice']==true){
    $_SESSION['cart']=array(array($_SESSION['EventId'] ,$_SESSION['Price']));
  }else{
    $_SESSION['cart']=array(array($_SESSION['EventId'] ,$_POST['entranceFee']));
  }
}
?>
