<?php

function getFilesFromDir($dir) { 
  $files = array(); 
  if ($handle = opendir($dir)) { 
    while (false !== ($file = readdir($handle))) { 
      if ($file != "." && $file != "..") { 
	if(is_dir($dir.'/'.$file)) { 
	  $dir2 = $dir.'/'.$file; 
	  $files[] = getFilesFromDir($dir2); 
	} 
	else { 
	  $files[] = $dir.'/'.$file; 
	} 
      } 
    } 
    closedir($handle); 
  } 
  return array_flat($files); 
}

function array_flat($array) { 
  foreach($array as $a) { 
    if(is_array($a)) { 
      $tmp = array_merge($tmp, array_flat($a)); 
    } 
    else { 
      $tmp[] = $a; 
    } 
  } 
  return $tmp; 
}

function randString($length, $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')
{
  $str = '';
  $count = strlen($charset);
  while ($length--) {
    $str .= $charset[mt_rand(0, $count-1)];
  }
  return $str;
}

if (!function_exists('apache_request_headers')) { 
        function apache_request_headers() { 
            foreach($_SERVER as $key=>$value) { 
                if (substr($key,0,5)=="HTTP_") { 
                    $key=str_replace(" ","-",strtolower(str_replace("_","_",substr($key,5)))); 
                    $out[$key]=$value; 
                }else{ 
                    $out[$key]=$value; 
        } 
            } 
            return $out; 
        } 
}

function find_fn($name) {
  if (file_exists("i/".$name)) {
    find_fn(randString(2).$name);
  }
  else {
    return $name;
  }
}

$headers = apache_request_headers();
$contents = file_get_contents("php://input");

$orig_inf = pathinfo($headers["name"]);
$ext = $orig_inf["extension"];

$ffilename = randString(5).".".$ext;
$allowed = array('png','svg','mov','jpg','jpeg','gif','avi','pdf', 'txt', 'mp3','mp4','wav','m4a','m4v','flac','doc','otf','rtf','docx', 'midi', 'xls', 'xlsx', 'ppt', 'pptx');

$ext = strtolower($ext);
if (in_array($ext, $allowed)) {
  $uplo = true;
  $ffilename = "i/".find_fn($ffilename);
  $fh = fopen($ffilename, "w+");
  fwrite($fh, $contents);
  fclose($fh);
  chmod($ffilename, 0755);
  $hash = md5_file($ffilename);
  foreach (getFilesFromDir("i") as $key) {
    if (md5_file($key) == $hash && $key != $ffilename) {
      unlink($ffilename);
      $ffilename = $key;
      break;
    }
  }
  include('sql.php');
  mysql_connect($server, $user, $password);
  //if (!$con) die("Cound not connect to database: ".mysql_error());
  mysql_select_db($database);
  $rand_id = randString(50);
  mysql_query("INSERT INTO link (id, fn) VALUES ('$rand_id', '$ffilename')");
  mysql_close();
  echo json_encode(array($ffilename, $rand_id));
}
 else {
   echo "fail";
   $uplo = json_encode(array("false"));
 }
if ($uplo) {
$exs = file_exists("u/".$_SERVER["REMOTE_ADDR"]);

$alog = fopen("u/".$_SERVER["REMOTE_ADDR"],"a+");
fwrite($alog, $ffilename."\n");
fclose($alog);

if(!$exs) {
  chmod("u/".$_SERVER["REMOTE_ADDR"], 0733);
 }
 }
?>