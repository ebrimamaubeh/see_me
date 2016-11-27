<?php // Example 26-5: signup.php
  require_once 'header.php';

  echo <<<_END
  <script>
    function checkUser(user)
    {
      if (user.value == '')
      {
        O('info').innerHTML = ''
        return
      }

      params  = "user=" + user.value
      request = new ajaxRequest()
      request.open("POST", "checkuser.php", true)
      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
      request.setRequestHeader("Content-length", params.length)
      request.setRequestHeader("Connection", "close")

      request.onreadystatechange = function()
      {
        if (this.readyState == 4)
          if (this.status == 200)
            if (this.responseText != null)
              O('info').innerHTML = this.responseText
      }
      request.send(params)
    }

    function ajaxRequest()
    {
      try { var request = new XMLHttpRequest() }
      catch(e1) {
        try { request = new ActiveXObject("Msxml2.XMLHTTP") }
        catch(e2) {
          try { request = new ActiveXObject("Microsoft.XMLHTTP") }
          catch(e3) {
            request = false
      } } }
      return request
    }
  </script>
  <div class='main'><h3>Please enter your details to sign up</h3>
_END;

  $error = $user = $pass = "";
  // define more variables.
  $first_name = $last_names = $nick_name = "";
  if (isset($_SESSION['user'])) destroySession();

  if (isset($_POST['user']))
  {
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
    $first_name = sanitizeString($_POST['first_name']);
    $last_names = sanitizeString($_POST['last_names']);
    $nick_name = sanitizeString($_POST['nick_name']);

    if ($user == "" || $pass == "")
      $error = "Not all fields were entered<br><br>";
    else
    {

      $query = "SELECT * FROM members WHERE user='$user' and pass = '$pass'";

      $result = queryMysql($query);

      if ($result->num_rows)
        $error = "That username already exists<br><br>";
      else
      {

        $query = "INSERT INTO members (first_name,last_names,nick_name, user, pass)
                  VALUES ('$first_name', '$last_names', '$nick_name', '$user', $pass')";

        queryMysql($query);

        // if logged redirect to the members page. (for now)

        redirect_to("members.php");

        die("<h4>Account created</h4>Please Log in.<br><br>");
      }
    }
  }

  echo <<<_END
    
    <form method='post' action='signup.php'>$error
    <span class ='fieldname'>First Name </span>
    <input type = 'text' name = 'first_name' value = '$first_name' ><br>

    <span class ='fieldname'>Last Name </span>
    <input type = 'text' name = 'last_names' value = '$last_names' ><br>

    <span class ='fieldname'>Nick Name </span>
    <input type = 'text' name = 'nick_name' value = '$nick_name' ><br>

    <span class='fieldname'>Username</span>
    <input type='text' maxlength='16' name='user' value='$user'
      onBlur='checkUser(this)'><span id='info'></span><br>
    <span class='fieldname'>Password</span>
    <input type='text' maxlength='16' name='pass'
      value='$pass'><br>
_END;
?>

    <span class='fieldname'>&nbsp;</span>
    <input type='submit' value='Sign up'>
    </form></div><br>
  </body>
</html>
