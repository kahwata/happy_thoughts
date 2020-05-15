<?php  require_once('../private/initialize.php'); 

$id = $_GET['id'] ?? '1';

$page = find_page_by_id($id);
$content = find_content_by_page_id($page['id']);

$page_title = 'HOME'; 
include(SHARED_PATH . '/usr_header.php'); ?>

<div id="title" >
	<h1 id="main_title" style="color:black;">Pandemic: No Problem!</h1>
</div>

<div id="content">
	<?php while($content_item = mysqli_fetch_assoc($content)){
	if($content_item['visible']==1){ ?>
	<h3><?php echo $content_item["title"] ?></h3>
	<h4><?php echo $content_item["author"] ?></h4>
	<p><?php echo $content_item["entry"]  ?></p>
	<hr />
<?php }} ?>
<form  <?php if ($id == 2) {echo " style='display: block';";} else {echo "style='display: none';";}  ?>>
		Select a celeb:
		<select name="students" onchange="getThought(this.value)">

			<option value="">Select Celebertiy</option>
			<option value="0">Wiz Khalifa</option>
			<option value="1">Johnny Depp</option>
			<option value="2">Bjarne Stroustrup</option>
			<option value="3">Kim Kardashian</option>
			<option value="4">Thomas Jefferson</option>
			
				
			
		</select>
	</form>
		<div id="celebQuotes"></div>
<br class="clear" />
</div>
<div id="formatting">
	<center>
	<h3>Formatting Changes</h3>
	
	<button onclick="changeTextColor()">Change Title Color</button><br /><br /><br />
	<button onclick="changeFont()">Change Title Font</button><br /><br /><br />
	<button onclick="reset()">Reset</button>
	<br /><br />
	

</center>
	
</div>

 <?php include(SHARED_PATH . '/usr_footer.php'); ?>

