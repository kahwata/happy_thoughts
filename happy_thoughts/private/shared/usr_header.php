<?
require_once('functions.php');
require_once('database.php');
require_once('query_functions.php');
require_once('validation_functions.php');
if(!isset($page_title)){$page_title = 'Quarrantine Thoughts';}



 $page_count = mysqli_num_rows($page_set);

?>
<!doctype html>

<html lang="en">
  <head>
    <title>HT - <?php echo $page_title; ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo WWW_ROOT.'/stylesheets/user.css'?>"/>
    <script src="scripts.js"></script>
  </head>

  <body>

  	<header>
  		<h1>Happy Thoughts</h1>
      <img src="<?php echo WWW_ROOT. '/images/smile.png';?>">
  	</header>
  	<navigation>
      <div id="title">
      <h2>PAGES</h2>
    </div>
  		<ul>
        
        <?php $page_set = find_all_pages(); 
       while($page = mysqli_fetch_assoc($page_set)) {
       if($page['visible']==1){
       ?> 

       <li class="<?php if($id===$page['id']){echo 'selected';} ?>"><a  href="<?php echo WWW_ROOT.'/index.php?id='.$page['id']; ?>"><?php echo $page['title'] ?>
        </a></li>
        
      <?php } }?>

  		</ul>

  	</navigation>