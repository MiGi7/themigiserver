<?php
//currently closed signups redirects to the home page
//header("Location:../index.php?signup=unavailable");
//exit();

$first = $_POST['first'];
$last = $_POST['last'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

if (isset($_POST['Register!'])) {
  include_once 'dbh.inc.php';

//checks for empty fields
  if(empty($first) || empty($last) || empty($email) || empty($username) || empty($password)) {
      header("Location: ../register.php?signup=missing");
      exit();
  }

  else {
    //checks for a valid email input
      if (!preg_match("/^[a-zA-Z\d]*$/", $first) || !preg_match("/^[a-zA-Z\d]*$/", $last)) {
        header("Location: ../register.php?signup=invalidname".$first);
      exit();
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register.php?signup=invalidemail");
      }
      elseif (strlen($password) < 8) {
        header("Location: ../register.php?signup=passwordlen");
      }
      else {
        //checking if the username has been taken
        $doubles = "SELECT * FROM logins WHERE user_name='$username';";
        $result = sqlsrv_query($conn, $doubles);
        $resultcheck = sqlsrv_has_rows($result);
        //a value above 0 indicates that there is a row with the username
        if ($resultcheck === 1){
          header("Location: ../register.php?signup=usertaken");
          exit();
        } else {
          //the hashed password
          $hashedpass = password_hash($password, PASSWORD_DEFAULT);
        }

        //selects the table logins from the data base
        $sql = "INSERT INTO logins (user_fist, user_last, user_email, user_name, user_pass) VALUES (?, ?, ?, ?, ?);";
        //variable $sql
        $param = array($first, $last, $email, $username, $hashedpass);
        $stmt = sqlsrv_query($conn, $sql, $param);


        if ($stmt === false) {
          echo "SQL ERROR";
        }
        else {
          $last_id = "SELECT TOP 1 * FROM logins ORDER BY ID DESC";
          $id_result = sqlsrv_query($conn, $last_id);
          $id_num = sqlsrv_fetch_array($id_result);
          $num = $id_num['ID'];
          $new_dir = 'uploads/'.strval($num);
          mkdir($new_dir);
          }
          header('Location: ../index.php?signup=success');
    }
  }
}
else {
  header("Location: ../register.php?signup=Nsubmit");
}
