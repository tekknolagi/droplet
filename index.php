<style type="text/css">
#drop-area,#wrapper,#progress-wrapper {
  width:600px;
margin: 0 auto;
}
body {
 margin: 0 auto;
  text-align:center;
}
</style>

<title>Drag and Drop Upload!</title>
<body>
<div id="wrapper">
  <div id="show-false" style="display:none;">
  <input id="files-upload" type="file" multiple>
  </div>

<div id="show-true">
  <div id="drop-area" style="height:90;background-color:lightblue;">
<img src="sitelogo.png" />
  <div class="drop-over" style="padding-top:20px;font-size:3em;user-select:none;-moz-user-select:none;-khtml-user-select:none;"></div>
</div>
</div>
<div id="progress-wrapper" style="background-color:white;">
  </div>
  </div>
<br><br><br>
<div id="ips">
  Recently uploaded:<br>
  <?php  
  clearstatcache();
  if (file_exists("u/".$_SERVER["REMOTE_ADDR"])) {
    $lines = array_reverse(array_unique(file("u/".$_SERVER["REMOTE_ADDR"])));
    if (count($lines) < 10) $c = count($lines);
    else $c = 10;
    for ($i = 0; $i < $c; $i++) {
      $lines[$i] = trim($lines[$i]);
      if (file_exists($lines[$i])) {
	echo "<a href=\"http://droplet.tk/".$lines[$i]."\" target=\"_blank\">".$lines[$i]."</a><br>";
      }
      else {
	echo "http://droplet.tk/".$lines[$i]." (deleted)<br>"; 
      }
      
    }
    echo "Want to see the whole list? Click <a href='http://droplet.tk/user.php' target='_blank'>here</a>.";
  }
  else echo "Nothing uploaded from your IP!";
?>
</div>
</body>

<script type="text/javascript" src="mootools.js"></script>
<script type="text/javascript" src="a.js"></script>
<pre>By using this service, you take all accountability for the content of the uploads.</pre>