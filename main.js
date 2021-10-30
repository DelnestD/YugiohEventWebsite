var testUser = false;
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
      //verification if User is connected
      checkUser();
      home();
    }
    //change of content with de navbar
    $('#home').click(function(event) {
      event.preventDefault();
      resetNavBar();
      if(testUser)document.getElementById("log").classList.add("active");
      pastEvent = false;
      home();
    });
    $('#pastEvent').click(function(event) {
      event.preventDefault();
      resetNavBar();
      document.getElementById("pastEvent").classList.add("active");
      if(testUser)document.getElementById("log").classList.add("active");
      pastEvent = true;
      $('#content').load('php/displayPastEvent.php');
    });
    $('#futurEvent').click(function(event) {
      event.preventDefault();
      resetNavBar();
      document.getElementById("futurEvent").classList.add("active");
      if(testUser)document.getElementById("log").classList.add("active");
      pastEvent = false;
      $('#content').load('php/displayFuturEvent.php');
    });
    $('#cart').click(function(event) {
      event.preventDefault();
      resetNavBar();
      document.getElementById("cart").classList.add("active");
      if(testUser)document.getElementById("log").classList.add("active");
      var intervalID = window.setInterval(function(){
        if(document.getElementById("cart").className=="fas fa-shopping-cart active"){
          createCookie("sizeScreen",window.screen.availWidth);
          $('#content').load('php/displayCart.php');
        }
      },1000);
    });
    $('#log').click(function(event) {
      event.preventDefault();
      resetNavBar();
      document.getElementById("log").classList.add("active");
      if(testUser){
        $('#content').load('php/displayProfil.php');
      }else{
        $('#content').load('php/displayLogin.php');
      }
    });
});
$(document).on('click','#btnSearch',function(event){
  event.preventDefault();
  resetNavBar();
  if(testUser)document.getElementById("log").classList.add("active");
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
    if(testUser)document.getElementById("log").classList.add("active");
    $.ajax({url:"php/search.php",
            type:'POST',
            data:$('#searchForm').serialize(),
      success:function(){
        $('#content').load('php/displaySearch.php');
      }
    });
  }
});
$(document).on('click','.overlay a',function(event){
  event.preventDefault();
  resetNavBar();
  if(testUser)document.getElementById("log").classList.add("active");
  createCookie("eventId", this.id);
  createCookie("eventPast", pastEvent);
  $('#content').load('php/displayEvent.php');
});
$(document).on('click','td a',function(event){
  event.preventDefault();
  $.ajax({url:"php/removeCart.php",
          type: 'POST',
          data:{rowNumber:this.id},
          success:function(){
            $('#content').load('php/displayCart.php');
          }
  });
});
$(document).on('click','#addCart',function(event) {
  event.preventDefault();
$.ajax({url:"php/addCart.php",
        type:'POST',
        data:$('#addCartForm').serialize(),
  success:function(){
      resetNavBar();
      document.getElementById("cart").classList.add("active");
      if(testUser)document.getElementById("log").classList.add("active");
      var intervalID = window.setInterval(function(){
        if(document.getElementById("cart").className=="fas fa-shopping-cart active"){
          createCookie("sizeScreen",window.screen.availWidth);
          $('#content').load('php/displayCart.php');
        }
      },1000);
    }
  });
});
$(document).on('click','#PaymentShop',function(event) {
  event.preventDefault();
$.ajax({url:"php/payementAtShop.php",
  success:function(){
      resetNavBar();
      document.getElementById("log").classList.add("active")
      $('#content').load('php/displayProfil.php');
    }
  });
});
$(document).on('click','#PaymentPayPal',function(event) {
  event.preventDefault();
$.ajax({url:"php/payementValidation.php",
        type:'POST',
        data:{typePayement:"Paypal"},
  success:function(){
      resetNavBar();
      document.getElementById("log").classList.add("active")
      $('#content').load('php/displayProfil.php');
    }
  });
});
$(document).on('click','#PaymentCreditCard',function(event) {
  event.preventDefault();
$.ajax({url:"php/payementValidation.php",
        type:'POST',
        data:{typePayement:"Credit Card"},
  success:function(){
      resetNavBar();
      document.getElementById("log").classList.add("active")
      $('#content').load('php/displayProfil.php');
    }
  });
});
$(document).on('click','#btnSignin',function(event) {
  event.preventDefault();
  $.ajax({url:"php/signin.php",
          type:'POST',
          data:$('#signinForm').serialize(),
    success:function(){
        resetNavBar();
        home();
      }
    });
});
$(document).on('click','#btnUpdate',function(event) {
  event.preventDefault();
  $.ajax({url:"php/update.php",
          type:'POST',
          data:$('#updateForm').serialize(),
    success:function(){
        $('#content').load('php/displayProfil.php');
      }
    });
});
$(document).on('click','#btnLogout',function(event) {
  event.preventDefault();
  resetNavBar();
  $('#content').load('php/logout.php');
  alert("You have been disconnected");
  checkUser();
  home();
});
//reset all the navbar
function checkUser(){
  $.ajax({
    url: "php/checkUserConnection.php",
    dataType: 'json'
  }).done(function(data) {
      testUser = data;
      if(testUser)document.getElementById("log").classList.add("active");
  });
}
function home(){
  document.getElementById("home").classList.add("active");
  $('#content').load('php/displayHome.php');
}
function resetNavBar(){
  document.getElementById("home").classList.remove("active");
  document.getElementById("pastEvent").classList.remove("active");
  document.getElementById("futurEvent").classList.remove("active");
  document.getElementById("cart").classList.remove("active");
  document.getElementById("log").classList.remove("active");
}
function createCookie(name, value) {
  var expires;
    var date = new Date();
    date.setTime(date.getTime() + (1 * 60 * 1000));
    expires = "; expires=" + date.toGMTString();
  document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
}
