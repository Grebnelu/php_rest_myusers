<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Role.php';

  $database = new Database();
  $db = $database->connect();

  $role = new Role($db);

  $result = $role->read();
  
  $num = $result->rowCount();

  if($num > 0) {
        $role_arr = array();
        $role_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $role_item = array(
            'id' => $id,
            'name' => $name
          );

          // Push to data
          array_push($role_arr['data'], $role_item);
        }

        // JSON & output
        echo json_encode($role_arr);

  } else {
        // Not found
        echo json_encode(
          array('message' => 'No Roles Found')
        );
  }
