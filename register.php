
<!DOC HTML>
<html>
<head>
<meta charset="utf-8">
<title>
Register for the MIGI server
</title>
<link rel='stylesheet' href='style.css'>
</head>

<?php
  include_once 'header.php';
 ?>

<body>
  <h2 id='signup'>Sign up for the MIGI server now!</h2>
    <div id="register">
      <form  action="includes/signup.inc.php" method="POST">
        <input type="text" placeholder="First Name" name="first">
        <input type="text" placeholder="Last Name" name="last">
        <input type="text" placeholder="Email" name="email">
        <input type="text" placeholder="Username" name="username">
        <input type="password" placeholder="Password" name="password">
        <button type="submit" name="Register!">Register!</button>
      </form>
      <br/>
      <?php
      $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if(strpos($url,'signup=missing')) {
          echo "<p>All fields in red have not been filled up!</p>";
        } elseif(strpos($url,'signup=invalidname')) {
          echo "<p>The name that has been enter uses invalid symbols!</p>";
        } elseif(strpos($url,'signup=invalidemail')) {
          echo "<p>The email is invalid!</p>";
        } elseif(strpos($url,'signup=passwordlen')) {
          echo "<p>The password length must be 8 or more characters!</p>";
        } elseif(strpos($url,'signup=usertaken')) {
          echo "<p>The username is unavailable!</p>";
        }
      ?>
  </div>
</body>
</html>
