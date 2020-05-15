<?php require_once('../../../private/initialize.php'); 

if(post_request()) {


  $content = [];

  $content['title'] = $_POST['title'] ?? '';
  $content['author'] = $_POST['author'] ?? '';
  $content['entry'] = $_POST['entry'] ?? '';
  $content['position'] = $_POST['position'] ?? '';
  $content['visible'] = $_POST['visible'] ?? '';
  $content['page_id'] = $_POST['page_id'] ?? '';


  $result = insert_content($content);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    redirect_to(WWW_ROOT.'/staff/content/show.php?id=' . $new_id);
  } else {
    $errors = $result;
  }

} else {
  // display the blank form
  $content = [];
  $content['title'] = '';
  $content['author'] = '';
  $content['entry'] = '';
  $content['position'] =  '';
  $content['visible'] = '';
  $content['page_id'] = '';
}

$content_set = find_all_content();
$content_count = mysqli_num_rows($content_set) + 1;
mysqli_free_result($content_set);



$page_title = 'Create Subject'; 
include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo WWW_ROOT.'/staff/content/index.php'; ?>">&laquo; Back to List</a>

  <div class="subject new">
    <h1>Create Subject</h1>
    <?php echo display_errors($errors); ?>
    <form action="<?php echo WWW_ROOT.'/staff/content/new.php';?>" method="post">
      <dl>
       <dt>Page</dt>
        <dd>
          <select name="page_id">
          <?php
            $pages_set = find_all_pages();
            while($page = mysqli_fetch_assoc($pages_set)) {
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
        <dd><input type="text" name="title" value="" /></dd>
      </dl>
      <dl>
      <dl>
        <dt>Author</dt>
        <dd><input type="text" name="author" value="" /></dd>
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
          <input type="checkbox" name="visible" value="1" />
        </dd>
      </dl>
        <dl>
        <dt>Content</dt>
        <dd>
          <textarea name="entry" cols="60" rows="10"></textarea>
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Content" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
