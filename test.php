<?php

include ("phpclasses/collections.php");

$pre="PEO";
$suf="C1b";

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

echo $path;
?>