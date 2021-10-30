<?php
echo'<div class="box-container">
  <div class="box">
    <div class="info">
      <h3>Login</h3>
      <form class="" action="php/login.php" method="post">
        <p>Username/Email</p>
        <input type="text" name="username_mail"/>
        <p>Password</p>
        <input type="password" name="password" />
        <br/>
        <input type="submit" class="btnStd" name="Login" value="Login"/>
      </form>
    </div>
  </div>
  <div class="box">
    <div class="info">
      <h3>Signin</h3>
      <form id="signinForm" action="" method="post">
        <table class="table_form">
          <tr>
            <td><p>Last Name</p>
            <input type="text" name="last_name" required/></td>
            <td><p>First Name</p>
            <input type="text" name="first_name" required/></td>
          </tr>
          <tr>
            <td><p>Username</p>
            <input type="text" name="username" required/></td>
            <td><p>Konami ID (optionnal)</p>
            <input type="text" name="konami_id"/></td>
          </tr>
          <tr>
            <td><p>Mail</p>
            <input type="email" name="mail" required/></td>
            <td><p>Phone (Optional)</p>
            <input type="text" name="phone"/></td>
          </tr>
          <tr>
            <td><p>Password</p>
            <input type="password" name="password" required/></td>
            <td><p>Confirm Password</p>
            <input type="password" name="password2" required/></td>
          </tr>
          <tr>
            <td colspan="2"><input type="submit" class="btnStd" id="btnSignin" name="Signin" value="Signin"/><br>
            <a href="mailto:projectuser26@gmail.com?subject=Sign in like a Shop">You\'re a Shop ? Contact Us</a></td>
          </tr>
        </table>
      </form>
  </div>
</div>';
?>
