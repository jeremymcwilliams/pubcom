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

            case "step3":
                $this->step3();
                break;            
            
            case "step4":
                $this->step4();
                break;
			
			case "step5":
                $this->step5();
                break;

			case "step6":
                $this->step6();
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
        
        if ($_REQUEST["clear"]=="true"){
            $this->emptyConverted();
            $this->emptyCSVs();
            
            
        }
        
        ?>
        
        <h3>Step 1: Add metadata to images in Adobe Bridge</h3>
        <!--
        <p>(add some detailed instructions/screenshots here)</p>
        <p>Steps:</p>
        <ul>
            <li>Choose Shoot directory from Aperture</li>
            <li>Highlight all images</li>
            <li>Click "export originals", to a folder on the Desktop. Make sure the export settings are as follows:</li>
            	<ul>
            		<li>Subfolder Format: none</li>
            		<li>Name Format: Original File Name</li>
            	</ul>
            <li>With images still selected, choose File->export->metadata</li>
            <li>name the metadata file "metadata.txt", and save it to the same directory as the images.</li>
            <li>Go to <a href="index.php?state=step2">Step 2</a>.</li>
        </ul>
        -->
        
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
	
	
	function step3(){
	    
        ?>
        <h3>Batch Convert Images with Photoshop</h3>
        <p>Now batch convert the images to jpegs using photoshop:</p>
        <p>
            <ul>
                <li>In Photoshop, select Image Processor... from File->Scripts </li>
                <li>Below are settings you should use for the Image Processor.
                	<ul>
                		<li>In section 1, select the folder on your Desktop containing the raw image files from Aperture.</li>
                		<li>In section 2, select the 'coverted' folder on your Desktop, and make sure 'Keep folder structure' is checked.</li>
                		<li>In section 3, duplicate the settings as show below.</li>
                	</ul>
                <li>When settings are ready, click 'Run'. Photoshop will then create jpg versions of the raw image files.</li>	
                	 <br>
                	<img src='img/image_processor_specs.png'>
                	
                </li>
                
                
            </ul>
           <p>When finished, <a href='index.php?state=step4'>move on the step 4</a>.</p> 
            
        </p>
        
        
        
        
        <?php
	}

	function step4(){
		?>
		
		<h3>FTP Raw and Converted Images to Server</h3>
		
		<p>Part 1: FTP Raw images:</p>
		<ul>
			<li>In FireFox, open a new tab, and click the FireFTP bookmark icon.</li>
			<li>Click the drop-down menu in the upper left, select "pubcom-raw", and click 'Connect'.</li>
			<li>In the left window, open the folder containing the raw image files, select the image files, and click the right-pointing arrow.<br/> This will start the FTP process.<br><img src='img/fireftp1.png'></li>
			
		</ul>
		<p>Part 2: FTP Converted images:</p>
	
		<ul>
			<li>When the process above is complete, click 'Disconnect'. </li>
			<li>In the drop-down menu, select "pubcom-converted", and click "Connect".</li>
			<li>Select all the jpg images in the left-hand window, and click the right pointing arrow, starting the FTP process.</li>
			<li>When finished, move on to <a href='index.php?state=step5'>Step 5</a>.</li>
			
		</ul>
	
		
		<?php
		
	}
	
	function step5(){
	    ?> 
		<h3>Process CSV Files in Omeka</h3>
		
		<p>The following files must be processed in Omeka:</p>
		<ul>
		<?php
		
		if ($_SESSION["csvfiles"]){
    		
    		$files=$_SESSION["csvfiles"];
            asort($files);
            foreach ($files as $key){
                $file=$key["file"];
                $path=$key["path"];
                echo "<li><p><input type='checkbox' class='cb'><span> $file <br/>(Collection: $path)</span></p></li>";
    
            }

		
		?>
		</ul>

        <p>Using Firefox, go to the <a href='http://pubcomda.lclark.edu/admin' target='_blank'>pubcomda admin interface</a>, and sign in.
            
            <?php 
            
            if (file_exists("./omekainfo.php")){
                   require_once("./omekainfo.php");
                    echo "<br/>username: $username<br/>password $password";     
                    
                
            }
            
            ?>
            
            </p> 
            
            
        <p>For each file, follow the steps below:</p>
        <ul>
            <li>Click Csv Import on the left navigation menu.</li>
            <li>Upload CSV File: select one of the files to upload, from the 'OmekaCSVFiles. folder on the Desktop.</li>
            <li>Make sure "Automap Column Names to Elements" box is checked.</li>
            <li>Select Item Type: choose "PubcomDA Images".</li>
            <li>Select Collection: choose the collection associates with the CSV file. You may need to refer to the collection map, and/or refer to the collection .</li>
            <li>Click "Next".</li>
            <li>On the next page, make sure the "files" column is checked on the last row (file).</li>
            <li>Click "Import CSV File". Refresh the page after 30 seconds or so to check the progress.</li>
            <li>Once the status of the import is completed, click Csv Import on the menu, and repeat the process with the next file (or proceed to <a href='index.php?state=step6'>Step 6</a>).</li>
            
        </ul>


		<?php
		        }
        else{echo "<p>No files to process.</p>";}
	

		
		
	}
	
	function step6(){
		?>
		
		<h3>Clear Desktop</h3>
		
		<p>Prep the Desktop for the next batch:</p>
		<ul>
		    <li><span>Empty/archive OmekaCSVFiles directory.</span> </li>
		    <li><span>Empty "converted" directory.</span> </li>
		    
		    
		    
		</ul>
		
		<form action="index.php">
		    
		    <input type="hidden" name="clear" value="true">
		    <input type="submit" value="Clear both directories and start a new batch">
		    
		    
		    
		</form>
		
		<p>You'll have to manually drag <span style="font-style:italic;"></span><?php echo $_SESSION["currentDirectory"]; ?></span> to the trash.</p>
		
		
		
		<?php
		//$this->emptyConverted();
       // $this->emptyCSVs();
       // $this->emptyShootDirectory();
		
		//var_dump($_SESSION);
		
		
	}
	
	

    







}


class utilities{
    
    
    function processDirectory(){
        
        $_SESSION["csvfiles"]="";
        
        
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
                    

                    
                    $this->collectionArrayParse($a);
            
                    echo "<p>Proceed to <a href='index.php?state=step3'>Step 3</a></p>";
            }

            

            #echo "<p><a href='index.php'>Start Again</a></p>";
        }
        
        #echo "<p><a href='index.php'>Go back and pick a directory.</a></p>";
        
        ?>

        
        
        <?php
        
        
        
        
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
									
						
				 $field=iconv("UTF-16", "UTF-8",utf8_encode($field));		
				 $value=iconv("UTF-16", "UTF-8",utf8_encode($value));	
				
				
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
								//$csv_prep[$key]["Shoot"]=$value;
                                
                                $newdata=$this->formatShoot($value, $key);
                                
                                $coll_array[$coll][$key]["Shoot"]=$newdata;
								break;
							
							case "Contact Creator":
								//$csv_prep[$key]["Photographer"]=$value;
                                $coll_array[$coll][$key]["Photographer"]=$value;
								break;
							
							case "Keywords":
                                
                                $keywords=str_replace(",", ", ", $value);
                                $keywords=rtrim($keywords);
                                
                                $coll_array[$coll][$key][$field]=$keywords;
                                
                                
                                break;
							case "Instructions":
							case "City":
							case "State/Province":
							case "Country":
							case "Rating":
								//$csv_prep[$key][$field]=$value;
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
		
		//$im='"$im"';

		
		$command="exiftool -php -ImageWidth -ImageHeight -DateTimeOriginal -MetadataDate \"$im\"";
		
		//echo "<p>$command</p>";
		
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
	
		//echo "<br>$source | $width | $height<br>";
		
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
            
            /* limit of entries per CSV file*/
           $limit=150;
           
           
            $c=0;    
           foreach ($array as $collection=>$data){
               
               $x=array_chunk($data, $limit);
               $s=count($x);
               if ($s==1){$z=0;}
               else{$z=1;}
               
  
               foreach ($x as $y){ 
               
               
                   if ($csv=$this->writeCSV($y, $collection, $z)){
                       $path=$this->getCollectionPath($collection);
                       echo "<p>File created: $csv<br>($path)</p>";
                       $_SESSION["csvfiles"][$c]["file"]=$csv;
                       $_SESSION["csvfiles"][$c]["path"]=$path;
                       $c++;
    
                   }
                   $z++;
               }
                

               // echo "<hr>";   
                   

           }     

    }
 
 
    function writeCSV($array, $collection, $suffix){
            
            //$fields=array();
            $directory=$this->directory;
            
            
            
        $dir= pubcomda::parentdir;
        $usageterms=pubcomda::usageTerms;
        $copyright=pubcomda::copyrightNotice;
        
        if ($suffix==0){
            $csv=$collection."_".$directory.".csv";
             
        }
        else{ /* adds a suffix if multiple files per collection */
            $csv=$collection."_".$directory."_".$suffix.".csv";
            
        }

        
        
        //echo "<p>$csv</p>";
        $path="$dir/OmekaCSVfiles/$csv";
        
        //echo count($array);   
        
        $fp = fopen($path, 'w+');
        
            
        $headings=array("Dublin Core:Title", "Item Type Metadata:Shoot", "Item Type Metadata:Keywords", "Item Type Metadata:Instructions", "Item Type Metadata:Date", "Item Type Metadata:Photographer", "Item Type Metadata:City", "Item Type Metadata:State/Province", 
        "Item Type Metadata:Country", "Item Type Metadata:Usage Terms", "Item Type Metadata:Copyright Notice", "Item Type Metadata:Rating", "Item Type Metadata:File Type", "Item Type Metadata:Maximum File Dimensions (print at 300dpi)", "file");
        
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








    
    function emptyConverted(){
        $converted=pubcomda::parentdir."/converted";
        $command="rm $converted/*.jpg";
        if (exec($command)){            
            return true;            
        }

    }
    
    function emptyCSVs(){
        $csvs=pubcomda::parentdir."/OmekaCSVfiles";
        $command="rm $csvs/*.csv";
        if (exec($command)){            
            return true;

        }

        
    }
    
/* OLD FUNCTIONS FROM INITIAL MIGRATION    */
/*  
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
  */  
/*
 *  function parse_reports($filename){ 
         
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
 */



 

 
		
}
?>