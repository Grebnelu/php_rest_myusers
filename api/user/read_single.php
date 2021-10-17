<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Users.php';

  $database = new Database();
  $db = $database->connect();

  $user = new User($db);

  $user->id = isset($_GET['id']) ? $_GET['id'] : die();

  $user->read_single();

  $user_arr = array(
    'id' => $user->id,
    'role_id' => $user->role_id,
    'number_id' => $user->number_id,
    'name' => $user->name,
    'surname' => $user->surname,
    'rolename' => $user->rolename,
    'birth_date' => $user->birth_date
  );

  // Make JSON
  print_r(json_encode($user_arr));