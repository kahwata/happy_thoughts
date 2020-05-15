<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(WWW_ROOT .'/staff/pages/index.php');
}
$id = $_GET['id'];

if(post_request()) {

  $result = delete_page($id);
  redirect_to(WWW_ROOT. '/staff/pages/index.php');

} else {
  $page = find_page_by_id($id);
}

?>

<?php $page_title = 'Delete Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo WWW_ROOT. '/staff/pages/index.php'; ?>">&laquo; Back to List</a>

  <div class="page delete">
    <h1>Delete Page</h1>
    <p>Are you sure you want to delete this page?</p>
    <p class="item"><?php echo htmlspecialchars($page['title']); ?></p>
     <p>This will also delete all content on this page</p>
    <form action="<?php echo WWW_ROOT .'/staff/pages/delete.php?id=' . htmlspecialchars(urlencode($page['id'])); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Page" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
