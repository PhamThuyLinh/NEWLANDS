<?php 
 $price5 = "41100000000";

// echo $a = $price5 / 1000000000; 

if(strlen($price5)>6 and strlen($price5)<10){
	$a = $price5 / 1000000;
	echo $a1 = str_replace('.',',',$a);
	$a2 = $a1." ";
	
}

if(strlen($price5)>9){
	$b = $price5 / 1000000000;
	echo $b1 = str_replace('.',',',$b);
}



?>