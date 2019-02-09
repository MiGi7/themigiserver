


<div id="file_explorer">
  <ul>
      <?php
    //for every file there should be an added list item.
    $id =  $_SESSION['id'];
    $dir = "includes/uploads/$id";
    $files = scandir($dir);
    $total = count($files);
    $total_new = $total - 2;
    echo "<p>Files in your folder: ".$total_new."</p>";
    for($i = 2; $i < $total; ++$i) {
      $a_file = $files[$i];
      echo '<li><a href="">'.$a_file.'</a></li>';
    }
       ?>
  </ul>
</div>

<div id="uploads">
<form action="includes/upload.inc.php" method="post" enctype="multipart/form-data">
  <input type="text" name="filename" placeholder="Rename a single file">
  <input type="file" name="files[]" multiple="multiple">
  <button type="submit" name="Upload">Upload</button>
</form>
</div>

<?php
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if(strpos($url, 'upload=unknown') == true) {
echo '<p>There was an error uploading your file.</p>';
} elseif (strpos($url, 'upload=size') == true) {
  echo '<p>The file is too large.</p>';
} elseif (strpos($url, 'upload=type') == true) {
  echo '<p>The file type is not allowed.</p>';
} elseif (strpos($url, 'upload=success') == true) {
  echo '<p>The file was successfully uploaded.</p>';
} elseif (strpos($url, 'upload=taken') == true) {
  echo "<p>A file(s) already exist with that name.";
}
?>
