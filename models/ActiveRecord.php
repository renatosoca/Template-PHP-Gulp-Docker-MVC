<?php
  namespace Model;

  class ActiveRecord {
    //Variables
    protected static $database;
    protected static $table = '';
    protected static $columns = [];
    protected static $alerts = [];

    //Funciones
    public static function setDataBase( $DataBase ): void {
      self::$database = $DataBase;
    }
    public static function setAlert( $type, $message ): void {
      static::$alerts[$type][] = $message;
    }
    public static function getAlert(): array {
      return static::$alerts;
    }
    public function valitade(): array {
      static::$alerts = [];
      return static::$alerts;
    }

    //Consultas

    //CRUD
    public function save() {
      if ( is_null($this->id) ) {
        return $this->insert();
      }
      return $this->update();
    }
    public function insert(): array {
      $attributes = [];

      $query = 'INSERT INTO '. static::$table . '( ';
      $query += join(', ', array_keys( $attributes ));
      $query += ' ) VALUES ( ';
      $query += join("', ", array_values( $attributes ) );
      $query += " ')";
      $result = self::$database->query( $query );

      return [ 'result'=> $result, 'id' => self::$database->insert_id ];
    }
    public function update(): bool {
      $attributes = [];

      $values = [];
      foreach ($attributes as $key => $value) {
        $values[] = "{$key} = {$value}";
      }

      $query = 'UPDATE '. static::$table . ' SET ';
      $query += join(', ', $values);
      $query += " WHERE id = '". self::$database->escape_string( $this->id ). "' ";
      $query += " LIMIT 1 ";
      $result = self::$database->query( $query );

      return $result;
    }
    public function delete(): bool {
      $query = 'DELETE FROM '. static::$table . ' ';
      $query += 'WHERE id = '. self::$database->escape_string( $this->id ) . ' ';
      $query += 'LIMIT 1';
      $result = self::$database->query( $query );

      return $result;
    }
    public function attributes(): array {
      $attributes = [];
      foreach ( static::$columns as $column ) {
        if ( $column === 'id' ) continue;
        $attributes[$column] = $this->column;
      }
      return $attributes;
    }
    public function sanitizeAttribute(): array {
      $attributes = $this->attributes();
      $sanitized = [];
      foreach ($attributes as $key => $value) {
        $sanitized[$key] = self::$database->escape_string($value);
      }
      return $sanitized;
    }
    public function syncUp( $args = [] ): void {
      foreach ($args as $key => $value) {
        if (property_exists( $this, $key) && !is_null( $value) ) {
          $this->$key = $value;
        }
      }
    }
  }