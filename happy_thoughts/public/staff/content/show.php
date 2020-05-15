<?php require_once('../../../private/initialize.php'); ?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0

$content = find_content_by_id($id);

?>

<?php $page_title = 'Show Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo WWW_ROOT. '/staff/content/index.php'; ?>">&laquo; Back to List</a>

  <div class="subject show">

    <h1>Content Title: <?php echo htmlspecialchars($content['title']); ?></h1>

    <div class="attributes">
      <dl>
        <dt>Page:</dt>
        <dd><?php $page = find_page_by_id($content['page_id']);

        echo htmlspecialchars($page['title']); ?></dd>
      </dl>
      <dl>
      <dl>
        <dt>Author</dt>
        <dd><?php echo htmlspecialchars($content['author']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd><?php echo htmlspecialchars($content['position']); ?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd><?php echo $content['visible'] == '1' ? 'true' : 'false'; ?></dd>
      </dl>
         <dl>
        <dt>Entry</dt>
       <dd><?php echo htmlspecialchars($content['entry']); ?></dd>
      </dl>
    </div>

  </div>

</div>
