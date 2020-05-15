<?php

require_once('initialize.php');

$content = find_careers_given_major(1);

$q=$_GET["q"];

while($item = mysqli_fetc_assoc($content)){

	if($item['id']==$q){
		echo $item;
	}

}


?>