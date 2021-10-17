<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Role.php';

  $database = new Database();
  $db = $database->connect();

  $role = new Role($db);

  $data = json_decode(file_get_contents("php://input"));

  $role->id = $data->id;

  if($role->delete()) {
    echo json_encode(
      array('message' => 'Role deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Role not deleted')
    );
  }
