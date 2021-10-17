<?php

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Role.php';

  $database = new Database();
  $db = $database->connect();

  $role = new Role($db);

  $role->id = isset($_GET['id']) ? $_GET['id'] : die();

  $role->read_single();

  $role_arr = array(
    'id' => $role->id,
    'name' => $role->name
  );

  // Make JSON
  print_r(json_encode($role_arr));
