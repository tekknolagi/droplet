<style type="text/css">
#drop-area,#wrapper {
  width:330px;
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
  <div id="drop-area" style="width:330;height:90;background-color:lightblue;">
  <div class="drop-over" style="padding-top:20px;font-size:3em;user-select:none;-moz-user-select:none;-khtml-user-select:none;">Drop files here!
  </div>
</div>
</div>
<div id="progress-wrapper" style="background-color:white;height:300px;">
  </div>
<div id="ips">
  Recently uploaded:<br>
  <?php
  
  if (file_exists("u/".$_SERVER["REMOTE_ADDR"])) {
    $lines = array_reverse(array_unique(file("u/".$_SERVER["REMOTE_ADDR"])));
    if (count($lines) < 10) $c = count($lines);
    else $c = 10;
    for ($i = 0; $i < $c; $i++) {
      echo "<a href=\"http://droplet.tk/".$lines[$i]."\">".$lines[$i]."</a><br>";
    }
  }
  else echo "Nothing uploaded from your IP!";x
?>
</div>
  </div>
</body>

<script type="text/javascript" src="mootools.js"></script>
<script type="text/javascript" src="a.js"></script>