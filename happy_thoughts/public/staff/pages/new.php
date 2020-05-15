<?php  require_once('../../../private/initialize.php'); 
if(post_request()) {

 $page = [];
  $page['title'] = $_POST['title'] ?? '';
  $page['position'] = $_POST['position'] ?? '';
  $page['visible'] = $_POST['visible'] ?? '';

  $result = insert_page($page);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    redirect_to(WWW_ROOT.'/staff/pages/show.php?id=' . $new_id);
  } else {
    $errors = $result;
  }

} else {

  $page = [];
  $page['title'] =  '';
  $page['position'] = '';
  $page['visible'] = '';

}

$page_set = find_all_pages();
$page_count = mysqli_num_rows($page_set) + 1;
mysqli_free_result($page_set);

$page_title = 'Create Page' ; 
include(SHARED_PATH . '/staff_header.php'); ?>


<div id="content">

  <a class="back-link" href="<?php echo WWW_ROOT.'/staff/pages/index.php'; ?>" >&laquo; Back to List</a>

  <div class="subject new">
    <h1>Create Page</h1>
 <?php echo display_errors($errors); ?>
    <form id="main form" action="<?php echo WWW_ROOT.'/staff/pages/new.php'; ?>" method="post">
      <dl>
    	<dl>
        <dt>Title</dt>
        <dd><input type="text" name="title" value="<?php echo htmlspecialchars($page['title']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
           <select name="position">
            <?php
              for($i=1; $i <= $page_count; $i++) {
                echo "<option value=\"{$i}\"";
                if($page["position"] == $i) {
                  echo " selected";
                }
                echo ">{$i}</option>";
              }
            ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1"<?php if($page['visible']  == "1") { echo " checked"; } ?> />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Page" />
      </div>
    </form>
</div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>