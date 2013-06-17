<?php


$input_array = array('a'=>"one", 'b'=>"two", 'c'=>"three", 'd'=>"four", 'e'=>"five");

$x=array_chunk($input_array, 6);


var_dump($x[0]);

?>