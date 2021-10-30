var eventId = -1;
var pastEvent = false;
$(document).ready(function(){
    //burger menu when little screen
    $('#menu').click(function(){
        $(this).toggleClass('fa-times');
        $('.navbar').toggleClass('nav-toggle');
    });

    //default parameters
    if($('#content')){
      document.getElementById("home").classList.add("active");
      document.getElementById("log").classList.add("active");
      $('#content').load('php/displayHome.php');
    }
    //change of content with de navbar
    $('#home').click(function() {
      event.preventDefault();
      resetNavBar();
      document.getElementById("home").classList.add("active");
      pastEvent = false;
      $('#content').load('php/displayHome.php');
    });
    $('#addEvent').click(function() {
      event.preventDefault();
      resetNavBar();
      document.getElementById("addEvent").classList.add("active");
      pastEvent = false;
      $('#content').load('php/displayAddEvent.php');
    });
    $('#pastEvent').click(function() {
      event.preventDefault();
      resetNavBar();
      document.getElementById("pastEvent").classList.add("active");
      pastEvent = true;
      $('#content').load('php/displayPastEvent.php');
    });
    $('#futurEvent').click(function() {
      event.preventDefault();
      resetNavBar();
      document.getElementById("futurEvent").classList.add("active");
      pastEvent = false;
      $('#content').load('php/displayFuturEvent.php');
    });
    $('#log').click(function() {
      event.preventDefault();
      resetNavBar();
      $('#content').load('php/displayProfil.php');
    });
    $('#shop').click(function() {
      event.preventDefault();
      resetNavBar();
      document.getElementById("shop").classList.add("active");
      $('#content').load('php/displayShop.php');
    });
});
$(document).on('click','.overlay a',function(){
  event.preventDefault();
  resetNavBar();
  createCookie("eventId", this.id);
  if(this.className == "fas fa-user"){
  $('#content').load('php/displayEvent.php');
  }
  if(this.className == "fas fa-file-alt"){
  $('#content').load('php/displayPlayers.php');
  }
  if(this.className == "fas fa-pencil-alt"){
  $('#content').load('php/displayUpdateEvent.php');
}
});
$(document).on('click','#btnSearch',function(event){
  event.preventDefault();
  resetNavBar();
  $.ajax({url:"php/search.php",
          type:'POST',
          data:$('#searchForm').serialize(),
    success:function(){
      $('#content').load('php/displaySearch.php');
    }
  });
});
$(document).on('keypress','#search',function(event){
  if (event.key === 'Enter' || event.keyCode === 13) {
    event.preventDefault();
    resetNavBar();
    $.ajax({url:"php/search.php",
            type:'POST',
            data:$('#searchForm').serialize(),
      success:function(){
        $('#content').load('php/displaySearch.php');
      }
    });
  }
});
$(document).on('click','#fixedPrice_check',function(){
  if(!document.getElementById("fixedPrice_check").checked){
    document.getElementById("fixedPrice").value="0";
    document.getElementById("minPrice").disabled=false;
  }else{
    document.getElementById("fixedPrice").value="1";
    document.getElementById("minPrice").disabled=true;
  }
});
$(document).on('click','#atShop_check',function(){
  if(!document.getElementById("atShop_check").checked){
    document.getElementById("atShop").value="0";
    document.getElementById("street").disabled=false;
    document.getElementById("number").disabled=false;
    document.getElementById("postCode").disabled=false;
    document.getElementById("city").disabled=false;
    document.getElementById("country").disabled=false;
  }else{
    document.getElementById("atShop").value="1";
    document.getElementById("street").disabled=true;
    document.getElementById("number").disabled=true;
    document.getElementById("postCode").disabled=true;
    document.getElementById("city").disabled=true;
    document.getElementById("country").disabled=true;
  }
});
$(document).on('click','#remoteDuel_check',function(){
  if(!document.getElementById("remoteDuel_check").checked){
    document.getElementById("remoteDuel").value="0";
    document.getElementById("atShop_check").disabled=false;
  }else{
    document.getElementById("remoteDuel").value="1";
    document.getElementById("atShop_check").checked=true;
    document.getElementById("atShop_check").disabled=true;
    document.getElementById("street").disabled=true;
    document.getElementById("number").disabled=true;
    document.getElementById("postCode").disabled=true;
    document.getElementById("city").disabled=true;
    document.getElementById("country").disabled=true;
  }
});
$(document).on('click','#btnAddEvent',function(event) {
  event.preventDefault();
  document.getElementById("street").disabled=false;
  document.getElementById("number").disabled=false;
  document.getElementById("postCode").disabled=false;
  document.getElementById("city").disabled=false;
  document.getElementById("country").disabled=false;
  $.ajax({url:"php/addEvent.php",
          type: 'POST',
          data:$('#addEventForm').serialize(),
          success:function(){
            $('#content').load('php/displayAddEvent.php');
            alert('Event Added Succefully');
          }
  });
});
$(document).on('click','#btnUpdateEvent',function(event) {
  event.preventDefault();
  document.getElementById("street").disabled=false;
  document.getElementById("number").disabled=false;
  document.getElementById("postCode").disabled=false;
  document.getElementById("city").disabled=false;
  document.getElementById("country").disabled=false;
  $.ajax({url:"php/updateEvent.php",
          type: 'POST',
          data:$('#updateEventForm').serialize(),
          success:function(){
            document.getElementById("futurEvent").classList.add("active");
            $('#content').load('php/displayFuturEvent.php');
            alert('Event Update Succefully');
          }
  });
});
$(document).on('click','#payed_check',function(){
  if(!document.getElementById("payed_check").checked){
    document.getElementById("payed").value="0";
  }else{
    document.getElementById("payed").value="1";
  }
});
$(document).on('click','#giftReceive_check',function(){
  if(!document.getElementById("giftReceive_check").checked){
    document.getElementById("giftReceive").value="0";
  }else{
    document.getElementById("giftReceive").value="1";
  }
});
$(document).on('click','#btnUpdatePlayer',function(event){
  event.preventDefault();
  $.ajax({url:"php/updatePlayer.php",
          type: 'POST',
          data:$('#updatePlayerForm').serialize(),
          success:function(){
            $('#content').load('php/displayPlayers.php');
          }
    });
});
$(document).on('click','td a i',function(event){
  event.preventDefault();
  if(this.className=="fas fa-pencil-alt"){
    createCookie("UserId", this.id)
    $('#content').load('php/displayPlayerUpdate.php');
  }
  if(this.className=="fas fa-times-circle"){
    $.ajax({url:"php/removePlayer.php",
            type: 'POST',
            data:{UserId:this.id},
            success:function(){
              $('#content').load('php/displayPlayers.php');
            }
    });
  }
});
$(document).on('click','#btnUpdateShop',function(event) {
  event.preventDefault();
  $.ajax({url:"php/updateShop.php",
          type: 'POST',
          data:$('#updateShopForm').serialize(),
          success:function(){
            document.getElementById("shop").classList.add("active");
            $('#content').load('php/displayShop.php');
            alert('Shop Update Succefully');
          }
  });
});
$(document).on('click','#btnLogout',function(event) {
  event.preventDefault();
  resetNavBar();
  $('#content').load('php/logout.php');
  alert("You have been disconnected");
  window.location.href = "../index.html";
});
//reset all the navbar
function resetNavBar(){
  document.getElementById("home").classList.remove("active");
  document.getElementById("addEvent").classList.remove("active");
  document.getElementById("pastEvent").classList.remove("active");
  document.getElementById("futurEvent").classList.remove("active");
  document.getElementById("shop").classList.remove("active");
}
function createCookie(name, value) {
  var expires;
    var date = new Date();
    date.setTime(date.getTime() + (1 * 60 * 1000));
    expires = "; expires=" + date.toGMTString();
  document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
}
