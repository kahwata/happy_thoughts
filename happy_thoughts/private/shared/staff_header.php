<?php
if(!isset($page_title)){$page_title = 'Staff Area';}
?>
<!doctype html>

<html lang="en">
  <head>
    <title>HT - <?php echo $page_title; ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo WWW_ROOT.'/stylesheets/staff.css'?>"/>
    <script src="../scripts.js"></script>
  </head>

  <body>

  	<header>
  		<h1>Happy Thoughts Staff Area</h1>
  	</header>
  	<navigation>
  		<ul>
  			<li><a href="<?php echo WWW_ROOT.'/staff/index.php';?>">Menu</a></li>
  		</ul>

  	</navigation>