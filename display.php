<style type='text/css'>
   img {
   max-width: 800px;
 }
</style>

<?php

$url = $_GET['i'];
#echo "'".$url."'";
if (file_exists("i/".$url)) {
  $pinfo = pathinfo("i/".$url);
  $ext = $pinfo['extension'];
  if (in_array($ext,array('png','svg','mov','jpg','jpeg','gif', 'tif', 'tiff'))) {
  ?>

<a href="/i/<?php echo $url;?>">  <img src="<?php echo '/i/'.$url;?>" /></a>

<?php
      }
  else {
?>
    <embed src="/i/<?php echo $url; ?>" />
<?php
  }
?>
<br>
    It works, bitches.
<?php
   }
 else {
   ?>
404 image not found.
<?php
 }
?>