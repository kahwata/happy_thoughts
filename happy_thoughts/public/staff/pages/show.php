<?php require_once('../../../private/initialize.php'); ?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0

$page = find_page_by_id($id);

?>

<?php $page_title = 'Show Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo WWW_ROOT.'/staff/pages/index.php'; ?>">&laquo; Back to List</a>

  <div class="page show">

    <h1>Page: <?php echo htmlspecialchars($page['title']); ?></h1>

    <div class="attributes">
   
        <dt>Title</dt>
        <dd><?php echo htmlspecialchars($page['title']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd><?php echo htmlspecialchars($page['position']); ?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd><?php echo $page['visible'] == '1' ? 'true' : 'false'; ?></dd>
      </dl>
    </div>


  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
  