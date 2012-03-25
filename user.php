<div id="ips">
  Recently uploaded:<br>
  <?php
  if (file_exists("u/".$_SERVER["REMOTE_ADDR"])) {
    $lines = array_reverse(array_unique(file("u/".$_SERVER["REMOTE_ADDR"])));
    $c = count($lines);
    for ($i = 0; $i < $c; $i++) {
      $lines[$i] = trim($lines[$i]);
      if (file_exists($lines[$i])) {
	echo "<a href=\"http://droplet.tk/".$lines[$i]."\" target=\"_blank\">".$lines[$i]."</a><br>";
      }
      else {
	echo "http://droplet.tk/".$lines[$i]." (deleted)<br>"; 
      }
      
    }
  }
?>
</div>
</body>