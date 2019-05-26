<?php

session_start();

if (isset($_POST['login'])) {

  include_once 'dbh.inc.php';

  $uid = $_POST['uid'];
  $pass = $_POST['pass'];

 if (empty($uid) || empty($pass)) {
   header('Location: ../index.php?login=empty');
   exit();
 } else {
   $sql = "SELECT * FROM logins WHERE user_name='$uid'";
   $result = sqlsrv_query($conn, $sql);
   $check = sqlsrv_has_rows($result);
   if ($check < 1) {
     header('Location: ../index.php?login=error1');
     exit();
   } else {
     //dehashing and pass check
     if ($row = sqlsrv_fetch_array($result)) {
       $hashedpasscheck = password_verify($pass, $row['user_pass']);
       if ($hashedpasscheck == false) {
         header('Location: ../index.php?login=error1');
         exit();
       } elseif ($hashedpasscheck == true) {
         $_SESSION['id'] = $row['ID'];
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
