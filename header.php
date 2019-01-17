<?php
  session_start();
//log the user out after 10 minutes of inactivity (activity = clicking on link, etc)
  $time_allowed = 600;

  if (isset($_SESSION['time'])) {

    if ($_SERVER['REQUEST_TIME'] - $_SESSION['time'] > $time_allowed) {
    session_unset();
    session_destroy();
    } else {
      $_SESSION['time'] = $_SERVER['REQUEST_TIME'];
    }
  }
 ?>
<header>
  <nav>
    <div class='theheader'>
      <p id='name'>THE MIGI SERVER</p>
      <ul>
        <il><a href="index.php">Your MIGI</a></il>
        <il><a href='FILES.php'>Browse your files</a></il>
      </ul>
      <?php
      /*checking if a login is present
      changes the nav bar from login to logout*/
      $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      if (!isset($_SESSION['u_name'])) {
      echo
      "<div>
        <form method='post' action='includes/signin.inc.php'>
          <input type='text' name='uid' placeholder='Username'>
          <input type='password' name='pass' placeholder='Password'>
          <button type='submit' name='login'>Login</button>"; ?>

          <?php if(strpos($url, 'login=error1') == true) {
            echo '<p>Incorrect username and/or password combination. Please try again.</p>';
          } elseif (strpos($url, 'login=error2') == true) {
              echo '<p>Something went wrong. Please try again.</p>';
            }
          }
            ?>
          <?php
        if (!isset($_SESSION['u_name'])) {
        echo "</form>
        <a href='forgotpassword'>Forgot your password?</a>
        <a href='register.php'>Sign up!</a>
      </div>";
    } else {
      echo
      "<div id='logout'>
        <form method='post' action='includes/signout.inc.php'>
        <button type='submit' name='logouy'>Logout</button>
        <a href='user_account.php'>".$_SESSION['u_name']."</a>
        </form>
      </div>";
    }?>
    </div>
  </nav>
</header>
