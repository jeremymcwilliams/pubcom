<?php



/* class pubcomda has interface elements*/
/* utilities has all the processing code */

class pubcomda extends utilities{ 
	
	const parentdir = 'Desktop';
	const usageTerms = "All Rights Reserved. No use without prior authorization.";
	const copyrightNotice = "Copyright Lewis & Clark, Portland, Oregon.";


	function __construct(){
	   
		date_default_timezone_set("America/Los_Angeles");
putenv("MAGICK_HOME=/opt/local/var/macports/software/ImageMagick");
putenv("PATH=" . getenv("MAGICK_HOME") . "/bin:" . getenv("PATH"));
putenv("DYLD_LIBRARY_PATH=" . getenv("MAGICK_HOME") . "/lib");

        $this->setCollections();
        //var_dump($this->collections);

		$this->controller();

	}
	
	
	function controller(){
		
		if (isset($_REQUEST["state"])){$state=$_REQUEST["state"];}
		else{$state="step1";}
		
		switch ($state){
			
			case "step1":				
				$this->step1();
				break;
			
            case "step2":
                $this->step2();
                break;
            
            
			case "processDirectory":
                $_SESSION["currentDirectory"]=$_REQUEST["directory"];
				$this->processDirectory();
                //$this->convertImages($_REQUEST["directory"]);
                
				break;
                
            case "convertImages":
                $this->convertImages($_REQUEST["directory"]);
                break;
                
                
            case "ftp":
                $this->ftpConnect();
                break; 

		}
	}
	

    function setCollections(){
           
        include ("collections.php");
        $this->collections=$collections;          
        
    }
    
    function step1(){
        
        ?>
        
        <h3>Step 1: Export Shoot Files and Metadata from Aperture to the Desktop</h3>
        
        
        
        
        <?php
        
    }
    
	function step2(){
		
		?>
		
		<h3>Step Two: Generate Omeka-ready CSV Files</h3>

<p>Choose the directory containing your shoot export files and metadata.txt file.</p>
            
			<form action="index.php" method="post">
			<select name="directory" id="expdir">
				<option value="">Select Directory</option>
				

			<?php
			$dir= pubcomda::parentdir;
			 if ($handle = opendir($dir)) {
			    while (false !== ($entry = readdir($handle))) {
			        if ($entry != "." && $entry != "..") {
			        	
						$p="$dir/$entry";
						if (is_dir($p)){echo "<option value='$entry'>$entry</option>";}
			
			        }
			    }
			    closedir($handle);
			}	

			?>
			</select>
			<input type="hidden" name="state" value="processDirectory">
			
			<p><input type="submit" value="Generate CSV Files" id="createCSV"></p>
			</form>


		
	

		

		  <?php
		
		
	}
	
	
	function photoshopInstructions(){
	    
        ?>
        
        <p>Now batch convert the images to jpegs using photoshop:</p>
        <p>
            <ul>
                <li>Select Image processor from File->Scripts </li>
                
                
            </ul>
            
            
        </p>
        
        
        
        
        <?php
	}
	
	

    







}


class utilities{
    
    
    function processDirectory(){
        
        if (isset($_REQUEST["directory"]) && !empty($_REQUEST["directory"])){
            $directory=$_REQUEST["directory"];
            $this->directory=$directory;

            //echo $directory;
            /* gets metadata array from metadata.txt*/
            if ($md_array=$this->metadataDotTextCheck($directory)){
                
                        $a=$this->md_parse($md_array);
                        //var_dump($a);

                    /* gets exifdata from directory    */
                    
                    $keys=array();  
                    $ex_array=array();
                    
                    
                    
                    $dir= pubcomda::parentdir."/$directory";    
                    if ($handle = opendir($dir)) {
        
                        while (false !== ($entry = readdir($handle))) {
                            if ($entry != "." && $entry != ".." && $entry != ".DS_Store" && $entry !="metadata.txt") {
                                //echo "$entry<br>";

                                $orig=$entry;
                                $b=explode(".", $entry);
                                $k=$b[0];
                                $fileType=$b[1];
                                array_push($keys,$k);
                                
                                $collinfo=$this->getFileCollection($k);
                                $full=$collinfo["full"];
       
                                
                                $exif=$this->exiftooldata($entry, $directory);

                                $a[$full][$k]["Dimensions"]=$exif["Dimensions"];
                                $a[$full][$k]["Archive File"]=$entry;
                                $a[$full][$k]["File Type"]=$fileType;
                                $a[$full][$k]["Date"]=$exif["Date"];
                                
                                

                            }
                                    
                                
                            
                        }
                    
                    
                    
                        closedir($handle);
                    }           
                    
                    //asort($a);
                    //asort($ex_array);         
        
                    
                    //var_dump($a);
                    
                    $this->collectionArrayParse($a);
            

            }
            else{
                
                echo "<p>There is no metadata.txt file in $directory. Please export a metadata file from Aperture to this directory, and make sure it is titled 'metadata.txt'.</p>";

                
            }
            

            echo "<p><a href='index.php'>Start Again</a></p>";
        }
        
        echo "<p><a href='index.php'>Go back and pick a directory.</a></p>";
        
        ?>

        
        
        <?php
        
        
        
        
    }   
    
	
	
	function metadataDotTextCheck($directory){
			$dir= pubcomda::parentdir."/$directory";    
			$md=$dir."/metadata.txt";
			//echo $md;
			
			if (file_exists($md)){
				$md_array=$this->parse_reports($md);
				return $md_array;
			}
			else{return false;}			

	}
    
    
    
    /* for a file name (no extension), like "CAM-B-0410-0023", returns array $array["prefix"]="CAM", $array["suffix"]="B", $array["full"]="CAM-B"*/
    function getFileCollection($file){
        $coll=array();
         $x=explode("-", $file);
        $f=$x[0];
        switch($f){
            
            case "L":
            case "G":            
            $suffix=$x[1];                
            $key=$f."-".$suffix;
            $sub=$x[2];                
            break;
                
            default:
            $key=$x[0];
            $sub=$x[1];
            break;    

        }
        $coll["prefix"]=$key;
        $coll["suffix"]=$sub;
        $coll["full"]="$key-$sub";
        return $coll;        
    }


    /*Interprets the file convention, like "CAM-B-0410-0023"*/
    function parseFilename($file){
        
        $z=$this->getFileCollection($file);
        
        $pre=$z["prefix"];
        $suf=$z["suffix"];
        $full=$z["full"];
        
        $c=strlen($suf);
                //echo "$key $sub $c";
        switch ($c){
            case 1:
            
            $val=$this->collections[$pre][$suf];
            break;

            case 2:
                $one=$suf[0];
                $two=$suf[1];
                $val=$this->collections[$pre][$one][$two];
                
                
            break;     
                
            case 3:
                $one=$suf[0];
                $two=$suf[1];
                $three=$suf[2];
                $val=$this->collections[$pre][$one][$two][$three];                                                

        }
        
        
        $r="$full||||$val";
        return $r; 

    }
    
    	
	

	function md_parse($md){
		
		$csv_prep=array();
		
		$coll_array=array();

		foreach ($md as $entry){
			
			$c=0;
			
			foreach ($entry as $field=>$value){
									
						
				 $field=iconv("UTF-16", "UTF-8",$field);		
				 $value=iconv("UTF-16", "UTF-8",$value);	
				
				
				if ($c==0){
					
					if (strlen($value)<10){$key=false;}
					else{$key=$value;}
					if ($key){
					//echo "<p>key: $value</p>";
                        
                        $r=$this->parseFilename($value);
                        $k=explode("||||", $r);
                        $coll=$k[0];
                        if (!in_array($coll, $coll_array)){
                           # array_push($coll_array, $coll);
                            
                        }
                        
                        $coll_array[$coll][$key]["Filename"]=$value;

						$csv_prep[$key]["Filename"]=$value;
						
					}
				}
				else{
					if ($key){
						
						//echo "<p>$c $field: $value</p>";
						
						
						
						switch ($field) {
							case "Title":   //title
								//echo "<p>$field: $value</p>";
								$csv_prep[$key]["Shoot"]=$value;
                                
                                $newdata=$this->formatShoot($value, $key);
                                
                                $coll_array[$coll][$key]["Shoot"]=$newdata;
								break;
							
							case "Contact Creator":
								$csv_prep[$key]["Photographer"]=$value;
                                $coll_array[$coll][$key]["Photographer"]=$value;
								break;
							
							case "Keywords":
							case "Instructions":
							case "City":
							case "State/Province":
							case "Country":
							case "Rating":
								$csv_prep[$key][$field]=$value;
                                $coll_array[$coll][$key][$field]=$value;
								break;
							
							default:
								//$csv_prep[$key][$field]=$value;
								break;
						}
						
						
						//echo "<p>$field: $value</p>";
					
					
					
					}
					
				}

				
				$c++;
			}
			

		}
	//	$this->collectionArrayParse($coll_array);
		
		//return $csv_prep;
		
		return $coll_array;
		
	}

	
	function parse_reports($filename){ 
         
            $mappings = array(); 
            $id = fopen($filename, "r"); //open the file 
            $data = fgetcsv($id, filesize($filename), "\t");  
             
            if(!$mappings){ 
                $mappings = $data; 
            } 
             
            while($data = fgetcsv($id, filesize($filename), "\t")){ 
                if($data[0]){ 
                    foreach($data as $key => $value) 
                        $converted_data[$mappings[$key]] = $value; 
                        $arr[] = $converted_data;  
                         
                }  
            }   
             
            fclose($id); //close file 
            //var_dump($arr);
            
            return $arr; 
        }  	
	
	function splitit($string){
		
		$r=explode("=>",$string);
		$val=$r[1];
		$val=rtrim($val, ",");
		return $val;

	}
	
    function formatShoot($shoot, $title){
        /* example: CAS 100609 Campus Details*/
        $x=explode(" ", $shoot);
        
        $school=array_shift($x);
        $shootdate=array_shift($x);
        $desc=implode(" ", $x);
        
        $y=explode("-", $title);
        $wrong=array_pop($y);
        $date=array_pop($y);
        
        $new=$school."-".$date."-".$desc;
        return $new;

    }
    
    
    
	function formatDate($d){
		
		$d=trim($d,'" ');
		//echo $d."<br>";
		//ex: 2008:04:30 22:18:17
		$x=explode(" ", $d);
		
		//var_dump($x);
		$y=$x[0];
	//	echo "<h1>$y</h1>";
		$z=explode(":",$y);
		$yyyy=$z[0];
		$mm=$z[1];
		$dd=$z[2];
	//	echo "<p>$mm $yyyy $dd</p>";
	   $date="$yyyy-$mm-$dd";
		//$date= date('F j, Y', mktime(0, 0, 0, $mm, $dd, $yyyy));
		return $date;
		
	}

	function exiftooldata($file, $folder){
			$exif=array();
			
			
		//$file="CAM-V-0905-0002.tif";
		//$folder="HowardHallRaw";
		$im=pubcomda::parentdir."/$folder/$file";


		
		$command="exiftool -php -ImageWidth -ImageHeight -DateTimeOriginal -MetadataDate $im";
		
		
		exec($command, $output, $return);
		
		//var_dump($output);
		
		//echo $output[3];
		
		$s=$output[1];
		$w=$output[2];
		$h=$output[3];
		$dt=$output[4];
		
		$source=$this->splitit($s);
		$wi=$this->splitit($w);
		$he=$this->splitit($h);
		$da=$this->splitit($dt);
	
	//	echo "<br>$source | $width | $height<br>";
		
		$width= intval($wi);
		$height=intval($he);
		
		$hd=round($height/300, 2, PHP_ROUND_HALF_EVEN);
		$wd=round($width/300, 2, PHP_ROUND_HALF_EVEN);
		
		$dim="$hd in. x $wd in.";
		$exif["Dimensions"]=$dim;
		
		
		$date=$this->formatDate($da);
		$exif["Date"]=$date;
		
		return $exif;
		
		//return $date;
		//return $dim;
		//echo $dim;
		
		
/*
original image resolution must be obtained/calculated 
 * before conversion to jpg
 * (height(pixels) / 300 = height in. x width(pixels) / 300 = width in.)
		
*/		
		
		
	}


    function collectionArrayParse($array){

           
                
           foreach ($array as $collection=>$data){
                       
               echo "<p>Collection: $collection</p>";    
               if ($csv=$this->writeCSV($data, $collection)){
                   $path=$this->getCollectionPath($collection);
                   echo "<p>File created: $csv<br>($path)</p>";
                   
                  
                   
                   
               }
                

                echo "<hr>";   
                   

           }     

    }
    
    function getCollectionPath($coll){
                
            
        $collections=$this->collections;
        $data=$this->getFileCollection($coll);
        $pre=$data["prefix"];
        $suf=$data["suffix"];
        
        $path="";
        if ($collections[$pre]["parentlabel"]){
            $path= $collections[$pre]["parentlabel"] ." -> ";
            
            
        }

        $r="";
        $c=strlen($suf);
                //echo "$key $sub $c";
        switch ($c){
            case 1:
            
            $r=$collections[$pre][$suf];
            break;

            case 2:
                $one=$suf[0];
                $two=$suf[1];
                
                $r=$collections[$pre][$one]["parentlabel"]. " -> ";
                $r.=$collections[$pre][$one][$two];
                
                
            break;     
                
            case 3:
                $one=$suf[0];
                $two=$suf[1];
                $three=$suf[2];
                 $r=$collections[$pre][$one]["parentlabel"]." -> ";
                $r.=$collections[$pre][$one][$two]["parentlabel"]." -> ";
 
                $r.=$collections[$pre][$one][$two][$three];                                                

        }
        $path.=$r;
        
        return $path;            
        
        
        
        
        
        
        
    }






	function writeCSV($array, $collection){
			
			//$fields=array();
			$directory=$this->directory;
			
			
			
		$dir= pubcomda::parentdir;
		$usageterms=pubcomda::usageTerms;
		$copyright=pubcomda::copyrightNotice;
		
		$csv=$collection."_".$directory.".csv";
		echo "<p>$csv</p>";
		$path="$dir/OmekaCSVfiles/$csv";
		
		echo count($array);	
		
		$fp = fopen($path, 'w+');
		
			
		$headings=array("Dublin Core:Title", "Item Type Metadata:Shoot", "Item Type Metadata:Keywords", "Item Type Metadata:Instructions", "Item Type Metadata:Date", "Item Type Metadata:Photographer", "Item Type Metadata:City", "Item Type Metadata:State/Province", 
		"Item Type Metadata:Country", "Item Type Metadata:Usage Terms", "Item Type Metadata:Copyright Notice", "Item Type Metadata:Rating", "Dublin Core:Type", "Item Type Metadata:Maximum File Dimensions (print)", "file");
		
		fputcsv($fp, $headings);
		
		
		foreach ($array as $key=>$md){
			
			$fields=array();
			
			array_push($fields, $md["Filename"]);
			array_push($fields, $md["Shoot"]);
			array_push($fields, $md["Keywords"]);
			array_push($fields, $md["Instructions"]);
			array_push($fields, $md["Date"]);
			array_push($fields, $md["Photographer"]);
			array_push($fields, $md["City"]);
			array_push($fields, $md["State/Province"]);
			array_push($fields, $md["Country"]);
			array_push($fields, $usageterms);
			array_push($fields, $copyright);
			array_push($fields, $md["Rating"]);
			array_push($fields, $md["File Type"]);
			array_push($fields, $md["Dimensions"]);
			$filepath="http://pubcomda.lclark.edu/tempfiles/".$md["Filename"].".jpg";
			array_push($fields, $filepath);
			//var_dump($md);
			
			
			fputcsv($fp, $fields);
			
		}
        if ($fp){return $csv;}
        else{return false;}

	}


    /* FTP functions*/
    function ftpConnect(){
       
       $directory= $_SESSION["currentDirectory"];
       $dt=pubcomda::parentdir;
        
       require_once("./ftpinfo.php");
         
        
        

        // set up a connection or die
        $conn_id = ftp_connect($ftp_server) or die("Couldn't connect to $ftp_server"); 
        
        
        
        
        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
        echo "<p>"/
        $dir= "$dt/$directory"; 
        echo $dir;   
        /*
        if ($handle = opendir($dir)) {

            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".." && $entry != ".DS_Store" && $entry !="metadata.txt") {
                        
                        $file="$dir/$entry";
                        $remote_file="/pubcomda/raw/$entry";
                      // upload a file
                    if (ftp_put($conn_id, $remote_file, $file, FTP_ASCII)) {
                     echo "successfully uploaded $file<br>";
                    } else {
                     echo "There was a problem while uploading $file. Use FireFTP!";
                    }                              
                    
                    
                }
            
            
            
            }
        
        
        
        } 
 */
 echo "</p>";
 
 
 
        

        
        // close the connection
        ftp_close($conn_id);
  
    }

/*
    function convertImages($directory){
        
            
            $dir= pubcomda::parentdir."/$directory";
                    
            if ($handle = opendir($dir)) {
                $c=0;
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != ".." && $entry != ".DS_Store" && $entry !="metadata.txt") {
                        //echo "$entry<br>";
                        $x=explode(".", $entry);
                        $pre=$x[0];
                        $newfile=$pre.".jpg";
                        
                        $orig="/Library/WebServer/Documents/pubcom/$dir/$entry";
                        
                        $dest="/Library/WebServer/Documents/pubcom/".pubcomda::parentdir."/converted/$newfile";
                       // echo "<p>$orig</p>";
                        
                        
                        $command="convert $entry -resize 50% -quality 100 ../converted/$newfile";
                    $command="convert $orig -resize 50% -quality 100 $dest";
                        echo "$command<br>";
                        //exec($command, $output, $return);

                        $c++;

                        
                    }
                            
                        
                    
                }
            
            
            
                closedir($handle);
            }           
                   
        echo "<p><a href='index.php'>Start Again</a></p>";
        
    }
        
 */  
		
}
?>