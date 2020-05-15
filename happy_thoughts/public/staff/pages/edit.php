<?php

require_once('../../../private/initialize.php'); 
if(!isset($_GET['id'])){
  redirect_to(WWW_ROOT.'/staff/subjects/index.php');
}
$id = $_GET['id'];

if (post_request()){


// Handle form values sent by new.php
$page = [];
  $page['id'] = $id;
  $page['title'] = $_POST['title'] ?? '';
  $page['position'] = $_POST['position'] ?? '';
  $page['visible'] = $_POST['visible'] ?? '';

  $result = update_page($page);
  if($result === true) {
    redirect_to(WWW_ROOT.'/staff/pages/show.php?id='. $id);
  }
  else{
    $errors = $result;
    
  }



}
else{
   $page = find_page_by_id($id);

  
}
$page_set = find_all_pages();
  $page_count = mysqli_num_rows($page_set);
  mysqli_free_result($page_set);
$page_title = 'Edit Page' ; 
 include(SHARED_PATH . '/staff_header.php'); ?>



<div id="content">

  <a class="back-link" href="<?php echo WWW_ROOT.'/staff/pages/index.php'; ?>" >&laquo; Back to List</a>

  <div class="page new">
    <h1>Edit Page</h1>

    <?php echo display_errors($errors); ?>
  
    <form action="<?php echo WWW_ROOT. '/staff/pages/edit.php?id=' . htmlspecialchars(urlencode($id));?>" method="post">
      
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
          <input type="checkbox" name="visible" value="1"<?php if($page['visible'] == "1") { echo " checked"; } ?> />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Page" />
      </div>
    </form>

</div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>