<?php require_once('../../../private/initialize.php'); ?>

<?php
	
	$content_set = find_all_content();


?>

<?php $page_title = 'Subjects'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="subjects listing">
    <h1>Content</h1>

    <div class="actions">
      <a class="action" href="<?php echo WWW_ROOT.'/staff/content/new.php';?>">Create New Content</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Page</th>
        <th>Position</th>
        <th>Visible</th>
  	    <th>Title</th>
        <th>Author</th>
        <th>Entry</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>content

      <?php while($content = mysqli_fetch_assoc($content_set)) { ?>
        <tr>
          <td><?php echo htmlspecialchars($content['id']); ?></td>
          <td><?php $page = find_page_by_id($content['page_id']);
               echo htmlspecialchars($page['title']); ?>
          <td><?php echo htmlspecialchars($content['position']); ?></td>
          <td><?php echo $content['visible'] == 1 ? 'true' : 'false'; ?></td>
    	    <td><?php echo htmlspecialchars($content['title']); ?></td>
          <td><?php echo htmlspecialchars($content['author']); ?></td>
          <td><?php echo htmlspecialchars($content['entry']); ?></td>
          <td><a class="action" href="<?php echo WWW_ROOT.'/staff/content/show.php?id='. htmlspecialchars(urlencode($content['id'])); ?>">View</a></td>
          <td><a class="action" href="<?php echo WWW_ROOT.'/staff/content/edit.php?id='. htmlspecialchars(urlencode($content['id'])); ?>">Edit</a></td>
       <td><a class="action" href="<?php echo WWW_ROOT.'/staff/content/delete.php?id='. htmlspecialchars(urlencode($content['id'])); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

  		<?php
  		mysqli_free_result($content_set);
?>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
