<?php require_once('../../../private/initialize.php'); 


	
	$page_set = find_all_pages();


?>
<?php $page_title = 'Pages' ; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>


<div id="content">
	<div id="pages listing">
		<h1>Pages</h1>

		<div class="actions">
			<a class="action" href="<?php echo WWW_ROOT.'/staff/pages/new.php'; ?>">Create New Page</a>
		</div>

	<table class="list">
		<tr>
			<th>ID</th>
			<th>Position</th>
			<th>Title</th>
			<th>Visible</th>
			<th>&nbsp;</th><!--View-->
			<th>&nbsp;</th><!--Edit-->
			<th>&nbsp;</th><!--Delete-->
		</tr>
		<?php
		while($page = mysqli_fetch_assoc($page_set)) {
			?><tr>
			<td><?php echo htmlspecialchars($page['id']); ?></td>
			<td><?php echo htmlspecialchars($page['position']); ?></td>
			<td><?php echo htmlspecialchars($page['title']); ?></td>
			<td><?php echo $page['visible'] ? 'true' : 'false';?></td>
			<td><a class="action" href="<?php echo WWW_ROOT.'/staff/pages/show.php?id='. htmlspecialchars(urlencode($page['id'])); ?>">View</a></td>
			<td><a class="action" href="<?php echo WWW_ROOT.'/staff/pages/edit.php?id='. htmlspecialchars(urlencode($page['id'])); ?>">Edit</a></td>
			<td><a class="action" href="<?php echo WWW_ROOT.'/staff/pages/delete.php?id='. htmlspecialchars(urlencode($page['id'])); ?>">Delete</a></td>
			</tr>
			<?php
		}
		?>

	</table>
	

	</div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>