<div id="ips">
  Recently uploaded:<br>
  <?php
  
  if (file_exists("u/".$_SERVER["REMOTE_ADDR"])) {
    $lines = array_reverse(array_unique(file("u/".$_SERVER["REMOTE_ADDR"])));
    //if (count($lines) < 10) $c = count($lines);
    //else $c = 10;
    $c = count($lines);
    for ($i = 0; $i < $c; $i++) {
      echo "<a href=\"http://droplet.tk/".$lines[$i]."\" target=\"_blank\">"/*<img src=\""*/.$lines[$i]./*"\"  width=\"50\"/>*/"</a><br>";
    }
  }
  else echo "Nothing uploaded from your IP!";
?>
</div>
</body>