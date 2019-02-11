
<?php
 session_start();

if (isset($_POST['Upload'])) {
  include_once 'dbh.inc.php';

  $total = count($_FILES['files']['name']);

  for ( $i=0 ; $i < $total ; $i++ ) {
  $dir = 0;
  $filename = $_FILES['files']['name'][$i];
  $filetmp = $_FILES['files']['tmp_name'][$i];
  $filesize = $_FILES['files']['size'][$i];
  $fileerror = $_FILES['files']['error'][$i];
  $filetype = $_FILES['files']['type'][$i];
  $new_name = mysqli_real_escape_string($conn,$_POST['filename']);

  $fileExt = explode('.',$filename);
  $extension = strtolower(end($fileExt));

  $allowed_files = array('jpg','jpeg','mp3','mp4','png','heic','pyc','py','exe');

  if(in_array($extension, $allowed_files)) {

    if($fileerror === 0) {

      if($filesize < 1000000000) {
          $filesize = ($filesize / 1000).' MB';
          $id =  $_SESSION['id'];
          $des = "uploads/$id/";
        if(strlen($new_name) > 1) {
          $filename = $new_name.'.'.$extension;
          $file_des = $des.$filename;
          move_uploaded_file($filetmp,$file_des);
        } else {
          $file_des = $des.$filename;
          move_uploaded_file($filetmp,$file_des);
        }
        $dir = 1;
        //File information is inserted into the database.
        $sql = "INSERT INTO uploads (file_name,file_size,file_type,user_login,date_uploaded) VALUES(?,?,?,?,?);";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt,$sql)) {
          echo "SQL ERROR";
        }
        else {
          $user = $_SESSION['u_name'];
          mysqli_stmt_bind_param($stmt, "sssss",$filename,$filesize,$filetype,$user,$total);
          mysqli_stmt_execute($stmt);
          }


        } else {
          $upload_error = ('The file is too large.');
          header('Location:../index.php?upload=size');
        }
      } else {
        $upload_error = ('There was an error uploading your file.');
        header('Location:../index.php?upload=unknown');
      }
   } else {
       $upload_error = ('The file type is not allowed.');
       header('Location:../index.php?upload=type');
    }

  }
  if ($dir == 1){
  printf($filetype);
  header('Location:../index.php?upload=success');
  }
}
 else {
  header('Location:../index.php?upload=unknown');
}
 ?>
