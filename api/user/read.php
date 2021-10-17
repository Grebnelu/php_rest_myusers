<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Users.php';

  $database = new Database();
  $db = $database->connect();

  $post = new User($db);
  $result = $post->read();
  $num = $result->rowCount();

  if($num > 0) {
    $posts_arr = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $post_item = array(
        'id' => $id,
        'role_id' => $role_id,
        'number_id' => html_entity_decode($number_id),
        'name' => $name,
        'surname' => $surname,
        'rolename' => $rolename,
        'birth_date' => $birth_date
      );

      // Push to data
      array_push($posts_arr, $post_item);
      // array_push($posts_arr['data'], $post_item);
    }

    // JSON & output
    echo json_encode($posts_arr);

  } else {
    // No Users
    echo json_encode(
      array('message' => 'No Users Found')
    );
  }
