<?php

  // Subjects

  function find_all_content() {
    global $db;

    $sql = "SELECT * FROM content ";
    $sql .= "ORDER BY page_id ASC, position ASC";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_content_by_id($id) {
    global $db;

    $sql = "SELECT * FROM content ";
    $sql .= "WHERE id='" . query_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $content = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $content; // returns an assoc. array
  }
    function find_content_by_page_id($id) {
    global $db;

    $sql = "SELECT * FROM content ";
    $sql .= "WHERE page_id='" . query_escape($db, $id) . "' ";
    $sql .= "ORDER BY position ASC";
     $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result; // returns an assoc. array
  }

  function validate_content($content) {
    $errors = [];

    // content title
    if(is_blank($content['title'])) {
      $errors[] = "Content title cannot be blank.";
    } elseif(!has_length($content['title'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Content title must be between 2 and 255 characters.";
    }
    //page title
    if(is_blank($content['page_id'])) {
      $errors[] = "Page cannot be blank.";
    }
    //content author
     if(is_blank($content['author'])) {
      $errors[] = "Content author cannot be blank.";
    } elseif(!has_length($content['author'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Content author must be between 2 and 255 characters.";
    }

    // position
    // Make sure we are working with an integer
    $postion_int = (int) $content['position'];
    if($postion_int <= 0) {
      $errors[] = "Position must be greater than zero.";
    }
    if($postion_int > 999) {
      $errors[] = "Position must be less than 999.";
    }

    
    return $errors;
  }

  function insert_content($content) {
    global $db;

    $errors = validate_content($content);
    if(!empty($errors)) {
      return $errors;
    }

    $sql = "INSERT INTO content ";
    $sql .= "(title, author, position, page_id, visible, entry) ";
    $sql .= "VALUES (";
    $sql .= "'" . query_escape($db, $content['title']) . "',";
    $sql .= "'" . query_escape($db, $content['author']) . "',";
    $sql .= "'" . $content['position'] . "',";
    $sql .= "'" . $content['page_id'] . "',";
    $sql .= "'" . $content['visible'] . "',";
    $sql .= "'" . query_escape($db, $content['entry']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_content($content) {
    global $db;

    $errors = validate_content($content);
    if(!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE content SET ";
    $sql .= "title='" . query_escape($db, $content['title']) . "', ";
    $sql .= "author='" . query_escape($db, $content['author']) . "', ";
    $sql .= "position='" . $content['position'] . "', ";
    $sql .= "page_id='" . $content['page_id'] . "', ";
    $sql .= "visible='" . $content['visible'] . "', ";
    $sql .= "entry='" . query_escape($db, $content['entry']) . "' ";
    $sql .= "WHERE id='" . query_escape($db, $content['id']) . "' ";
    $sql .= "LIMIT 1";
echo $sql;
    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }

  }

  function delete_content($id) {
    global $db;

    $sql = "DELETE FROM content ";
    $sql .= "WHERE id='" . query_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  // Pages

  function find_all_pages() {
    global $db;

    $sql = "SELECT * FROM pages ";
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_page_by_id($id) {
    global $db;

    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE id='" . query_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $page = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $page; // returns an assoc. array
  }

  function validate_page($page) {
    $errors = [];

    // subject_id
    

    // menu_name
    if(is_blank($page['title'])) {
      $errors[] = "Title cannot be blank.";
    } elseif(!has_length($page['title'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }

    // position
    // Make sure we are working with an integer
    $postion_int = (int) $page['position'];
    if($postion_int <= 0) {
      $errors[] = "Position must be greater than zero.";
    }
    if($postion_int > 999) {
      $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $page['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
      $errors[] = "Visible must be true or false.";
    }

    return $errors;
  }

  function insert_page($page) {
    global $db;

    $errors = validate_page($page);
    if(!empty($errors)) {
      return $errors;
    }

    $sql = "INSERT INTO pages ";
    $sql .= "(position, title, visible) ";
    $sql .= "VALUES (";
    $sql .= "'" . $page['position'] . "',";
    $sql .= "'" . query_escape($db, $page['title']) . "',";
    $sql .= "'" . $page['visible'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_page($page) {
    global $db;

    $errors = validate_page($page);
    if(!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE pages SET ";
    $sql .= "position='" . $page['position'] . "', ";
    $sql .= "title='" . query_escape($db, $page['title']). "', ";
    $sql .= "visible='" . $page['visible'] . "' ";
    $sql .= "WHERE id='" . query_escape($db, $page['id']) . "' ";
    $sql .= "LIMIT 1";
    echo $sql;
    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }

  }

  function delete_page($id) {
    global $db;

    $content_set = find_all_content();
    while($content = mysqli_fetch_assoc($content_set)){
      if($content['page_id']==$id){
        delete_content($content['id']);
      }
    }
    $sql = "DELETE FROM pages ";
    $sql .= "WHERE id='" . query_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

?>
