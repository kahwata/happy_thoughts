<?php require_once('../../private/initialize.php'); ?>

<?php $page_title = 'Main Menu' ; ?>
<?php include(SHARED_PATH.'/staff_header.php'); ?>
  	

  	<div id="content">
  		<div id="main-menu">
  			<h2>Main Menu</h2>
  			<ul>
  				<li><a href="pages/index.php">Pages</a>
  				</li>
  				<li><a href="content/index.php">Content</a>
  			</ul> 
  	</div>
    <h2>Search Content Entries</h2>
    <form>
<input type="text" size="30" onkeyup="showResult(this.value)">
<div id="livesearch"></div>
</form>
</div>

 <a style="text-decoration: underline;" href="<?php echo WWW_ROOT. '/index.php'; ?>">Website Home Page</a>

<?php include(SHARED_PATH. '/staff_footer.php'); ?>
