<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Role.php';
  
  $database = new Database();
  $db = $database->connect();

  $role = new Role($db);

  $data = json_decode(file_get_contents("php://input"));

  $role->name = $data->name;

  if($role->create()) {
    echo json_encode(
      array('message' => 'Role Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Role Not Created')
    );
  }
