<form method="POST" action="./views/handle.php">
<div class="error_login">
<?php
    if(isset($_SESSION['error_login'])){
        echo $_SESSION['error_login'];
    }
?>
</div>
  <div class="wrap_login">
    <label for="uname"><b>Username</b></label>
    <input class="form_usn_login" type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input class="form_psw_login" type="password" placeholder="Enter Password" name="psw" required>

    <input class="sbm_login_form" name="sbm_login" Value="Login" type="submit"/>
   
  </div>

  <div class="wrap_login" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>
<style>
  
</style>