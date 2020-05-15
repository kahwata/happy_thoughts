<?php
 require_once('initialize.php');



$content_set = find_all_content();



//get the q parameter from URL
$q=$_GET["q"];

//lookup all links from the xml file if length of q>0
if (strlen($q)>0) {
  $hint="";
  while($content = mysqli_fetch_assoc($content_set)) {
        
      //find a link matching the search text
      if (stristr($content['title'],$q,false)) {
        if ($hint=="") {
          $hint="<a href='" . 
          WWW_ROOT.'/staff/content/show.php?id='. $content['id'] . 
          " target='_blank'>" . 
          $content['title'] . "</a>";
        } else {
          $hint=$hint . "<br /><a href='" . 
          WWW_ROOT.'/staff/content/show.php?id='. $content['id'] . 
          " target='_blank'>" . 
          $content['title'] . "</a>";
        }
      }
    }
  }
  else{
    $hint="";
  }


// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($hint=="") {
  $response="no suggestion";
} else {
  $response=$hint;
}

//output the response
echo $response;
?>