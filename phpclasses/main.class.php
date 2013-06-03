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




		$this->controller();

	}
	
	
	function controller(){
		
		if (isset($_REQUEST["state"])){$state=$_REQUEST["state"];}
		else{$state="start";}
		
		switch ($state){
			
			case "start":				
				$this->start();
				break;
			
			case "processDirectory":
				//$this->processDirectory();
                $this->convertImages($_REQUEST["directory"]);
                
				break;
                
            case "convertImages":
                $this->convertImages($_REQUEST["directory"]);
                break;

		}
	}
	

	function start(){
		
		?>
		
		<h3>Step One: Select a Directory from your Desktop</h3>

			<form action="index.php" method="post">
			<select name="directory">
				<option value="">Pick a directory!</option>
				

			<?
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
			
			<input type="submit" value="select">
			</form>


		
		<?

	}
	
	
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
                        
                        
                        $command="convert $entry -resize 50% -quality 100 ../converted/$newfile";
                    
                        echo "$command<br>";
                        //exec($command, $output, $return);
        
        
        
        
        
            
                  
                        $c++;

                        
                    }
                            
                        
                    
                }
            
            
            
                closedir($handle);
            }           
                   
        echo "<p><a href='index.php'>Start Again</a></p>";
        
	}
    
    
	function processDirectory(){
		
		if (isset($_REQUEST["directory"]) && !empty($_REQUEST["directory"])){
			$directory=$_REQUEST["directory"];

			//echo $directory;

			if ($md_array=$this->metadataDotTextCheck($directory)){
				
				$a=$this->md_parse($md_array);
				//var_dump($a);

			//var_dump($a);
			
			$keys=array();	
			$ex_array=array();
				
			if ($handle = opendir($dir)) {

			    while (false !== ($entry = readdir($handle))) {
			        if ($entry != "." && $entry != ".." && $entry != ".DS_Store" && $entry !="metadata.txt") {
			        	echo "$entry<br>";
						
						$orig=$entry;
						$b=explode(".", $entry);
						$k=$b[0];
						$fileType=$b[1];
						array_push($keys,$k);
						
						
						$dim=$this->exiftooldata($entry, $directory);
						
						$ex_array[$k]["Dimensions"]=$dim;
						$ex_array[$k]["Archive File"]=$entry;
						$ex_array[$k]["File Type"]=$fileType;
						
						
						
						
			        }
			        		
			        	
			        
			    }
			
			
			
			    closedir($handle);
			}			
			
			asort($a);
			asort($ex_array);			

			
			var_dump($a);
			
			foreach ($keys as $k){
				

				
				$d=$ex_array[$k]["Dimensions"];
				$shoot=$a[$k]["Shoot"];
				echo "<p>$d $shoot</p>";
				
				
			}				
				
				
				
				
				
				
				
				
			}
			else{
				
				echo "<p>There is no metadata.txt file in $directory. Please export a metadata file from Aperture to this directory, and make sure it is titled 'metadata.txt'.</p>";

				
			}
			

		
			
			
			echo "<p><a href='index.php'>Start Again</a></p>";
		}
		
		echo "<p><a href='index.php'>Go back and pick a directory.</a></p>";
		
	}






}


class utilities{
	
	
	function metadataDotTextCheck($directory){
			$dir= pubcomda::parentdir."/$directory";    
			$md=$dir."/metadata.txt";
			echo $md;
			
			if (file_exists($md)){
				$md_array=$this->parse_reports($md);
				return $md_array;
			}
			else{return false;}			

	}	
	

	function md_parse($md){
		
		$csv_prep=array();
		
		
		foreach ($md as $entry){
			
			$c=0;
			
			foreach ($entry as $field=>$value){
									
						
				 $field=iconv("UTF-16", "UTF-8",$field);		
				 $value=iconv("UTF-16", "UTF-8",$value);	
				
				
				if ($c==0){
					
					if (strlen($value)<10){$key=false;}
					else{$key=$value;}
					if ($key){
					echo "<p>key: $value</p>";
						$csv_prep[$key]["Filename"]=$value;
						
					}
				}
				else{
					if ($key){
						
						echo "<p>$c $field: $value</p>";
						
						
						
						switch ($field) {
							case "Title":   //title
								//echo "<p>$field: $value</p>";
								$csv_prep[$key]["Shoot"]=$value;
								break;
							
							case "Contact Creator":
								$csv_prep[$key]["Photographer"]=$value;
								break;
							
							case "Keywords":
							case "Instructions":
							case "City":
							case "State/Province":
							case "Country":
							case "Rating":
								$csv_prep[$key][$field]=$value;
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
		
		
		return $csv_prep;
		
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
	
	function formatDate($d){
		
		$d=trim($d,'" ');
		echo $d."<br>";
		//ex: 2008:04:30 22:18:17
		$x=explode(" ", $d);
		
		var_dump($x);
		$y=$x[0];
		echo "<h1>$y</h1>";
		$z=explode(":",$y);
		$yyyy=$z[0];
		$mm=$z[1];
		$dd=$z[2];
		echo "<p>$mm $yyyy $dd</p>";
		$date= date('F j, Y', mktime(0, 0, 0, $mm, $dd, $yyyy));
		return $date;
		
	}

	function exiftooldata($file, $folder){
		//$file="CAM-V-0905-0002.tif";
		//$folder="HowardHallRaw";
		$im=pubcomda::parentdir."/$folder/$file";


		
		$command="exiftool -php -ImageWidth -ImageHeight -DateTimeOriginal $im";
		
		
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
		$date=$this->formatDate($da);
		return $date;
		//return $dim;
		//echo $dim;
		
		
/*
original image resolution must be obtained/calculated 
 * before conversion to jpg
 * (height(pixels) / 300 = height in. x width(pixels) / 300 = width in.)
		
*/		
		
		
	}

	function writeCSV(){
		
		$csv="nameoffile.csv";
		
		$headings=array("Filename", "Shoot", "Keywords", "Instructions", "Date", "Photographer", "City", "State/Province", 
		"Country", "Usage Terms", "Copyright Notice", "Rating", "File Type", "File Size", "file");
		$fp = fopen($csv, 'w+');
	  array_push($fields, $title);
	  array_push($fields, $subject);
	  /*...*/		
		
	      fputcsv($fp, $fields);
		  
		  empty($fields);		
		
	}
		
}

?>