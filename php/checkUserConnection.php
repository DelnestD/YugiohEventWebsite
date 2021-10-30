<?php
session_start();
if(isset($_SESSION['pseudo'])&&!empty($_SESSION['pseudo'])){
  $checkUser = true;
}else{
  $checkUser = false;
}
echo json_encode($checkUser);
?>
