<?php
session_start();
if($_POST['rowNumber']==0){
  \array_splice($_SESSION['cart'],0,1);
}else{
  \array_splice($_SESSION['cart'],$_POST['rowNumber'],$_POST['rowNumber']);
}
?>
