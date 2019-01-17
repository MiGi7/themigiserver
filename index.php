
<!DOC HTML>
<html>
<head>
<meta charset="utf-8">
<title>
The MIGI server
</title>
<link rel="stylesheet" href="style.css">
</head>
<?php
  include 'header.php'
 ?>
<body>
  <div id='base'>
    <h2>Home</h2>
    <hr/>
    <?php
    if (!isset($_SESSION['u_name'])) {
      echo "<p>Please login to access your files!</p>";
    }
    elseif (isset($_SESSION['u_name'])) {
      include 'login_upload.php';
    }
    ?>
  </div>
</body>
</html>
