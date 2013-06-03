<?php






















 if ($handle = opendir('Desktop')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
        	
			$p="Desktop/$entry";
			if (is_dir($p)){echo "$entry<br>";}
			
            
			
			//var_dump(is_dir($p));
        }
    }
    closedir($handle);
}





$pics_dir="/Users/jeremym/Desktop/pics";

 

 

$faces=array();

$filename="/Users/jeremym/Library/Application Support/Google/Picasa3/contacts/contacts.xml";

$xml=simplexml_load_file($filename);

#var_dump($xml);

$contacts=$xml->contacts;

 

echo "<p>from contacts.xml:</p>";

foreach ($xml->contact as $contact){

$id=$contact->attributes()->id;

$name=$contact->attributes()->name;

echo "<p>$id: $name</p>";

$faces["$id"]=$name;

 

 

}

var_dump($faces);

echo "<hr>";

 

$pics=array();

 

$handle = fopen("$pics_dir/.picasa.ini", "r");

if ($handle) {

    while (($buffer = fgets($handle, 4096)) !== false) {

     

$buffer=trim($buffer, "\n\r");

 

if ($buffer[0]=="["){

 

$a=trim($buffer, "][");

 

$current=$a;

 

 echo "<div><img src='/Desktop/pics/$a' width='400px'></div>";

 

 

}

else{

 

 

//echo "$buffer<br>";

if ($ids=eval_picasa_ini_entry($buffer)){

 

//var_dump($ids);

foreach ($ids as $i){

 

$n=$faces[$i];

echo "$n: $current<br>";

 

 

}

}

 

}

 

 

    }

    if (!feof($handle)) {

        echo "Error: unexpected fgets() fail\n";

    }

    fclose($handle);

}

 

function eval_picasa_ini_entry($buffer){

 

$face_ids=array();

$x=explode("=",$buffer);

if ($x[0]=="faces"){

$y=explode(";", $x[1]);

foreach ($y as $z){

$f=explode(",", $z);

$id=$f[1];

array_push($face_ids, $id);

 

 

//echo "<p>$z</p>";    

 

}

 

return $face_ids;

 

}

else{return false;}

}

 

 

 

?>