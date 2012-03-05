<?php

if (!function_exists('apache_request_headers')) { 
        function apache_request_headers() { 
            foreach($_SERVER as $key=>$value) { 
                if (substr($key,0,5)=="HTTP_") { 
                    $key=str_replace(" ","-",ucfirst(strtolower(str_replace("_","_",substr($key,5))))); 
                    $out[$key]=$value; 
                }else{ 
                    $out[$key]=$value; 
        } 
            } 
            return $out; 
        } 
}

$headers = apache_request_headers();

//print_r($headers);

$tmp_name = $headers["tmp_name"];
$name = $headers["name"];
echo $tmp_name."\n";
echo $name."\n";
if(file_get_contents($tmp_name)) {
	echo file_get_contents($tmp_name)."\n";
}
else {
	echo "failed to get contents\n";
}

if (file_exists("upload/" . $name)) {
	echo $name . " already exists. ";
}
else {
	if(rename($tmp_name, "upload/".$name)) {
		echo "Stored in: upload/$name";
	}
	else {
		echo "Failed to store $name";
	}
}