<?php
session_start();
$userPseudo = $_SESSION['pseudo'];
$_SESSION['EventId'] = $_COOKIE["eventId"];
$eventId = $_SESSION['EventId'];
$bdd = new PDO('mysql:host=localhost;dbname=b7_28056591_yugioh', 'DBoardShop','helha', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
$requete = $bdd->prepare("SELECT * FROM `event` WHERE `event`.`eventId`='$eventId';");
$requete->execute();
$event = $requete->fetch();
$eventInfo = $event['EventInfo'];
if(strstr($eventInfo, "<br>\n")){
  $eventInfo = str_replace("<br>\n","\n",$eventInfo);
}
$date = date('Y-m-d',strtotime($event["EventDate"]));
$time = date('H:i', strtotime($event["EventDate"]));
echo'<div class="box-container">
<div class="box">
  <div class="info">
    <h3>Update an Event</h3>
    <form class="" id="updateEventForm" action="" method="post">
      <table class="table_form">
        <tr>
          <td><p>Event\'s Name</p>
          <input type="text" name="eventName" value="'.$event['EventName'].'"/></td>
          <td><p>Event\'s Type (for the logo picture)</p>
          <select type="text" name="eventType">';
          if($event['EventType']=="OTS"){
            echo'<option value="OTS" selected>OTS</option>';
          }else{
            echo'<option value="OTS">OTS</option>';
          }
          if($event['EventType']=="WCQ"){
            echo'<option value="WCQ" selected>WCQ</option>';
          }else{
            echo'<option value="WCQ">WCQ</option>';
          }
          if($event['EventType']=="YCS"){
            echo'<option value="YCS" selected>YCS</option>';
          }else{
            echo'<option value="YCS">YCS</option>';
          }
          if($event['EventType']=="Extravaganza"){
            echo'<option value="Extravaganza" selected>Extravaganza</option>';
          }else{
            echo'<option value="Extravaganza">Extravaganza</option>';
          }
          echo'</select></td>
          <td><p>Event\'s Date and Time</p>
          <input type="date" name="date" value="'.$date.'"/><br><input type="time" name="time" value="'.$time.'"/></td>
        </tr>
        <tr>
          <td><label for="atShop">Event at Shop ?</label>';
          if($event['EventAtShop']==true && $event['EventRemote']==true){
            echo'<input class="checkbox" type="checkbox" id="atShop_check" name="atShop_check" disabled="disabled" checked>';
          }else if($event['EventAtShop']==true && $event['EventRemote']==false){
            echo'<input class="checkbox" type="checkbox" id="atShop_check" name="atShop_check" checked>';
          }else{
            echo'<input class="checkbox" type="checkbox" id="atShop_check" name="atShop_check">';
          }
          echo'
          <input type="hidden" id="atShop" name="atShop" value="'.$event['EventAtShop'].'" /></td>
          <td><label for="remoteDuel">Event Remote Duel ?</label>';
          if($event['EventRemote']==true){
            echo'<input class="checkbox" type="checkbox" id="remoteDuel_check" name="remoteDuel_check" checked>';
          }else{
            echo'<input class="checkbox" type="checkbox" id="remoteDuel_check" name="remoteDuel_check">';
          }
          echo'<input type="hidden" id="remoteDuel" name="remoteDuel" value="'.$event['EventRemote'].'" /></td>
          <td><p>Maximum of inscription</p>
          <input type="number" name="maxEntry" value="'.$event['EventMaxEntry'].'"/></td>
        </tr>
        <tr>
          <td><label for="fixedPrice">Fix Price ?</label>';
          if($event['EventFixedPrice']==true){
            echo'<input class="checkbox" type="checkbox" id="fixedPrice_check" name="fixedPrice_check" checked>';
          }else{
            echo'<input class="checkbox" type="checkbox" id="fixedPrice_check" name="fixedPrice_check">';
          }
          echo'<input type="hidden" id="fixedPrice" name="fixedPrice" value="'.$event['EventFixedPrice'].'" /></td>
          <td>
          <p>Street and Number</p>
          <input type="text" name="street" id="street" value="'.$event['EventStreet'].'" disabled="disabled"><input type="text" name="number" id="number" value="'.$event['EventNumber'].'" disabled="disabled">
          </td>
          <td><p>Gift for participation\'s name</p>
          <input type="text" name="giftName" value="'.$event['EventGiftName'].'"></td>
        </tr>
        <tr>
          <td><p>Min Price</p>';
          if($event['EventFixedPrice']==true){
            echo'<input type="number" id="minPrice" name="minPrice" value="'.$event['EventMinPrice'].'" disabled="disabled"/>';
          }else{
            echo'<input type="number" id="minPrice" name="minPrice" value="'.$event['EventMinPrice'].'"/>';
          }
          echo'<p>Max Price</p>
          <input type="number" name="maxPrice" value="'.$event['EventMaxPrice'].'"/></td>
          <td><p>Post Code and City</p>
          <input type="text" name="postCode" id="postCode" value="'.$event['EventPostCode'].'" disabled="disabled"><input type="text" name="city" id="city" value="'.$event['EventCity'].'" disabled="disabled">
          <p>Country</p>
          <input type="text" name="country" id="country" value="'.$event['EventCountry'].'" disabled="disabled"></td>
          <td><p>Maximum Number of Gift for participation\'s</p>
          <input type="number" name="giftNumber" value="'.$event['EventGiftLimite'].'"/>
          <p>Gift for participation\'s Scale (1 per ... €)</p>
          <input type="number" name="giftScale"value="'.$event['EventGiftScale'].'" /></td>
        </tr>
        <tr>
          <td colspan="3"><p>Event Infos</p>
          <textarea  name="eventInfo" rows="4" cols="150">'.$eventInfo.'</textarea></td>
        </tr>
        <tr>
          <td colspan="3"><input type="submit" class="btnStd" id="btnUpdateEvent" name="Update" value="Update"/></td>
        </tr>
      </table>
    </form>
</div>
</div>';
?>
