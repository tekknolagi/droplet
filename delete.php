<?php
error_reporting(-1);
mysql_connect("localhost","ruyadesigns_img","c88ba6e1") or die("Unable to connect to SQL server");
mysql_select_db("ruyadesigns_img") or die("Unable to select the database");
$scaped = mysql_real_escape_string($_GET["id"]);
$res = mysql_query("SELECT fn from link WHERE id = '$scaped'");
if (mysql_num_rows($res) > 0) {
  $rec = mysql_fetch_assoc($res);
  if (file_exists($rec['fn'])) {
    unlink($rec['fn']);
    mysql_query("DELETE FROM link WHERE id = '$scaped'");
    echo "Deleted. Thanks.";
  }
  else {
    echo "No such file... or other error.";
  }
 }
 else {
   echo "No such file... or other error.";
}

echo mysql_error();
mysql_close();

?>