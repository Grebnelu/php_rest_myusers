<?php 
  class User {
    private $conn;
    private $table = 'users';

    public $id;
    public $role_id;
    public $number_id;
    public $name;
    public $surname;
    public $birth_date;

    public function __construct($db) {
      $this->conn = $db;
    }

    public function read() {
      $query = 'SELECT r.name as rolename, u.id, u.role_id, u.number_id, u.name, u.surname, u.birth_date
                                    FROM ' . $this->table . ' u
                                LEFT JOIN
                                  role r ON u.role_id = r.id';
      
      $stmt = $this->conn->prepare($query);

      
      $stmt->execute();

      return $stmt;
    }

    public function read_single() {
          $query = 'SELECT r.name as rolename, u.id, u.role_id, u.number_id, u.name, u.surname, u.birth_date
                                    FROM ' . $this->table . ' u
                                LEFT JOIN
                                  role r ON u.role_id = r.id
                                    WHERE
                                      u.id = ?
                                    LIMIT 1';

          $stmt = $this->conn->prepare($query);

          $stmt->bindParam(1, $this->id);

          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          $this->role_id = $row['role_id'];
          $this->number_id = $row['number_id'];
          $this->name = $row['name'];
          $this->surname = $row['surname'];
          $this->birth_date = $row['birth_date'];
          $this->rolename = $row['rolename'];
    }

    public function create() {
          $query = 'INSERT INTO ' . $this->table . ' SET role_id = :role_id, number_id = :number_id, name = :name, surname = :surname';

          $stmt = $this->conn->prepare($query);

          $this->role_id = htmlspecialchars(strip_tags($this->role_id));
          $this->number_id = htmlspecialchars(strip_tags($this->number_id));
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->surname = htmlspecialchars(strip_tags($this->surname));

          $stmt->bindParam(':role_id', $this->role_id);
          $stmt->bindParam(':number_id', $this->number_id);
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':surname', $this->surname);

          if($stmt->execute()) {
            return true;
      }

      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    public function update() {
          $query = 'UPDATE ' . $this->table . '
                                SET role_id = :role_id, number_id = :number_id, name = :name, surname = :surname, birth_date = :birth_date
                                WHERE id = :id';

          $stmt = $this->conn->prepare($query);

          $this->role_id = htmlspecialchars(strip_tags($this->role_id));
          $this->number_id = htmlspecialchars(strip_tags($this->number_id));
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->surname = htmlspecialchars(strip_tags($this->surname));
          $this->birth_date = $this->birth_date;
          $this->id = htmlspecialchars(strip_tags($this->id));

          $stmt->bindParam(':role_id', $this->role_id);
          $stmt->bindParam(':number_id', $this->number_id);
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':surname', $this->surname);
          $stmt->bindParam(':birth_date', $this->birth_date);
          $stmt->bindParam(':id', $this->id);

          if($stmt->execute()) {
            return true;
          }

          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    public function delete() {
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          $stmt = $this->conn->prepare($query);

          $this->id = htmlspecialchars(strip_tags($this->id));

          $stmt->bindParam(':id', $this->id);

          if($stmt->execute()) {
            return true;
          }

          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }