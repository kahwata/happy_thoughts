<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(WWW_ROOT .'/staff/content/index.php');
}
$id = $_GET['id'];

if(post_request()) {

  $result = delete_content($id);
  redirect_to(WWW_ROOT. '/staff/content/index.php');

} else {
  $content = find_content_by_id($id);
}

?>

<?php $page_title = 'Delete Content'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo WWW_ROOT. '/staff/content/index.php'; ?>">&laquo; Back to List</a>

  <div class="content delete">
    <h1>Delete Content</h1>
    <p>Are you sure you want to delete this entry?</p>
    <p class="item"><?php echo htmlspecialchars($content['title']); ?></p>

    <form action="<?php echo WWW_ROOT .'/staff/content/delete.php?id=' . htmlspecialchars(urlencode($content['id'])); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Content" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
