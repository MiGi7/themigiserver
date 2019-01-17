<?php

session_start();

if (isset($_POST['login'])) {

  include_once 'dbh.inc.php';

  $uid = mysqli_real_escape_string($conn, $_POST['uid']);
  $pass = mysqli_real_escape_string($conn, $_POST['pass']);

 if (empty($uid) || empty($pass)) {
   header('Location: ../index.php?login=empty');
   exit();
 } else {
   $sql = "SELECT * FROM logins WHERE user_name='$uid'";
   $result = mysqli_query($conn, $sql);
   $check = mysqli_num_rows($result);
   if ($check < 1) {
     header('Location: ../index.php?login=error1');
     exit();
   } else {
     //dehashing and pass check
     if ($row = mysqli_fetch_assoc($result)) {
       $hashedpasscheck = password_verify($pass, $row['user_pass']);
       if ($hashedpasscheck == false) {
         header('Location: ../index.php?login=error1');
         exit();
       } elseif ($hashedpasscheck == true) {
         $_SESSION['u_id'] = $row['user_id'];
         $_SESSION['u_first'] = $row['user_first'];
         $_SESSION['u_last'] = $row['user_last'];
         $_SESSION['u_email'] = $row['user_email'];
         $_SESSION['u_name'] = $row['user_name'];
         $_SESSION['time'] = $_SERVER['REQUEST_TIME'];
         header('Location: ../index.php?login=success');
         exit();
       }

     }
   }
 }
} else {
  header('Location: ../index.php?login=error2');
  exit();
}
