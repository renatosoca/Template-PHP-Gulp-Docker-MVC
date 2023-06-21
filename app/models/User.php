<?php
  namespace App\Models;

  class User extends Model {
    protected static string $table = 'users';
    protected static array $columnsDB = ['id', 'name', 'lastname'];

    public string $id;
    public string $name;
    public string $lastname;

    public function __construct( array $args = [] ) {
      $this->id = $args['id'] ?? '';
      $this->name = $args['name'] ?? '';
      $this->lastname = $args['lastname'] ?? '';
    }
  }
