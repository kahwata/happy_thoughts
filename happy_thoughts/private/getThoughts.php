<?php
$query =$_GET["query"];

$xmlDocument = new DOMDocument();
$xmlDocument->load("thoughts.xml");


$xml = $xmlDocument->getElementsByTagName('thought');

for($i=0; $i<=$xml->length-1; $i++){

	if($xml->item($i)->nodeType==1){
			
		if($xml->item($i)->getElementsByTagName('id')->item(0)->nodeValue==$query){
			
			$choseStudent=($xml->item($i));
		}
	}
}

$studentData = ($choseStudent->childNodes);
for($i=2; $i<$studentData->length-1;$i++){
	if($studentData->item($i)->nodeType==1){
		if($i==3){
			echo "<h3>";
			echo $studentData->item($i)->childNodes->item(0)->nodeValue."</h3>";
		}
		elseif($i==5){
			echo "<h4>";
			echo $studentData->item($i)->childNodes->item(0)->nodeValue."</h4>";
		}
		elseif($i==7){
			echo "<p>";
			echo $studentData->item($i)->childNodes->item(0)->nodeValue."</p>";
		}	
	}
}
?>
