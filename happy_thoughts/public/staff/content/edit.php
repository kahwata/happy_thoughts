<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(WWW_ROOT.'/staff/subjects/index.php');
}
$id = $_GET['id'];

if(post_request()) {

  // Handle form values sent by new.php

  $content = [];
  $content['id'] = $id;
  $content['title'] = $_POST['title'] ?? '';
  $content['author'] = $_POST['author'] ?? '';
   $content['entry'] = $_POST['entry'] ?? '';
  $content['position'] = $_POST['position'] ?? '';
  $content['visible'] = $_POST['visible'] ?? '';
 $content['page_id'] = $_POST['page_id'] ?? '';
  $result = update_content($content);
   if($result === true) {
    redirect_to(WWW_ROOT.'/staff/content/show.php?id='. $id);
  }
  else{
    $errors = $result;
    
  }
} else {

  $content = find_content_by_id($id);


}
$content_set = find_all_content();
  $content_count = mysqli_num_rows($content_set);
  mysqli_free_result($content_set);

?>

<?php $page_title = 'Edit Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo WWW_ROOT. '/staff/content/index.php'; ?>">&laquo; Back to List</a>

  <div class="subject edit">
    <h1>Edit Subject</h1>
        <?php echo display_errors($errors); ?>
    <form action="<?php echo WWW_ROOT. '/staff/content/edit.php?id=' . htmlspecialchars(urlencode($id)); ?>" method="post">
      <dl>
        <dt>Page</dt>
        <dd>
          <select name="page_id">
          <?php
            $page_set = find_all_pages();
            while($page = mysqli_fetch_assoc($page_set)) {
              echo "<option value=\"" . htmlspecialchars($page['id']) . "\"";
              if($content["page_id"] == $page['id']) {
                echo " selected";
              }
              echo ">" . htmlspecialchars($page['title']) . "</option>";
            }
            mysqli_free_result($page_set);
          ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Title</dt>
        <dd><input type="text" name="title" value="<?php echo htmlspecialchars($content['title']); ?>" /></dd>
      </dl>
       <dl>
        <dt>Author</dt>
        <dd><input type="text" name="author" value="<?php echo htmlspecialchars($content['author']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
          <?php
            for($i=1; $i <= $content_count; $i++) {
              echo "<option value=\"{$i}\"";
              if($content["position"] == $i) {
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
          <input type="checkbox" name="visible" value="1"<?php if($content['visible'] == "1") { echo " checked"; } ?> />
        </dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd>
          <textarea name="entry" cols="60" rows="10"><?php echo htmlspecialchars($content['entry']); ?></textarea>
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Content" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
