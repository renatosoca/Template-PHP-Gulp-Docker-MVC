<?php
  namespace Models;

  class ActiveRecord {
    //Variables
    protected static $database;
    protected static string $table = '';
    protected static array $columns = [];
    protected static array $alerts = [];

    //Funciones
    public static function setDataBase( $DataBase ): void {
      self::$database = $DataBase;
    }
    public static function setAlert( string $type, string $message ): void {
      static::$alerts[$type][] = $message;
    }
    public static function getAlert(): array {
      return static::$alerts;
    }
    public function valitade(): array {
      static::$alerts = [];
      return static::$alerts;
    }

    //Consultas Definidas
    public static function findAll(): array {
      $query = "SELECT * FROM ". static::$table;
      $result = self::consultSQL( $query );
      return $result;
    }
    public static function findById( int $id ): array {
      $query = "SELECT * FROM ". static::$table . " WHERE id = {$id} LIMIT 1";
      $result = self::consultSQL( $query );
      return array_shift( $result );
    }
    public static function findOne( string $column, string $value ): array {
      $query = "SELECT * FROM ". static::$table . " WHERE {$column} = '{$value}' LIMIT 1 ";
      $result = self::consultSQL( $query );
      return array_shift( $result );
    }
    public static function findLimit( $limit ): array {
      $query = "SELECT * FROM ". static::$table . " ORDER BY id DESC LIMIT {$limit} ";
      $result = self::consultSQL( $query );
      return $result;
    }
    public static function findPaginate( $pages, $offset): array {
      $query = "SELECT * FROM ". static::$table ." ORDER BY id DESC LIMIT {$pages} OFFSET {$offset} " ;
      $resultado = self::consultSQL( $query) ;
      return $resultado;
    }
    public static function findOrderBy( string $column, string $order ): array {
      $query = "SELECT * FROM ". static::$table ." ORDER BY {$column} {$order}";
      $resultado = self::consultSQL( $query );
      return  $resultado;
    }
    public static function findOrderLimit( string $column, string $order, $limit ) {
      $query = "SELECT * FROM ". static::$table ." ORDER BY {$column} {$order} LIMIT {$limit}";
      $resultado = self::consultSQL($query);
      return  $resultado;
    }
    public static function findOneMore( array $data = [] ): array {
      $query = "SELECT * FROM ". static::$table ." WHERE ";
      foreach ($data as $key => $value) {
        if ($key === array_key_last( $data )) {
          $query .= " {$key} = '{$value}'";
        } else {
          $query .= " {$key} = '{$value}' AND ";
        }
      }
      $resultado = self::consultSQL($query);
      return  $resultado  ;
    }
    public static function findTotal( string $column = '', string $value = '' ): array {
      $query = "SELECT COUNT(*) FROM ". static::$table;
      if($column) {
        $query .= " WHERE {$column} = {$value}";
      }
      $result = self::$database->query( $query );
      $total = $result->fetch_array();

      return array_shift($total);
    }
    public static function findTotalMore(array $data = [] ) {
      $query = "SELECT COUNT(*) FROM ". static::$table ." WHERE";
      foreach ($data as $key => $value) {
        if ($key === array_key_last( $data )) {
          $query .= " {$key} = '{$value}'";
        } else {
          $query .= " {$key} = '{$value}' AND ";
        }
      }
      $result = self::$database->query($query);
      $total = $result->fetch_array();
      return array_shift($total);
    }
    //Insertar en la Base de Datos
    public static function consultSQL( string $query ): array {
      $result = self::$database->query( $query );

      $container = [];
      while ( $register = $result->fetch_assoc() ) {
        $container[] = static::createObjects( $register );
      }
      $result->free();
      return $container;
    }
    public static function createObjects( array $register ): object {
      $object = new static;
      foreach ($register as $key => $value) {
        if ( property_exists( $object, $key ) ) {
          $object->$key = $value;
        }
      }
      return $object;
    }

    //CRUD
    public function save() {
      if ( is_null($this->id) ) {
        return $this->insert();
      }
      return $this->update();
    }
    public function insert(): array {
      $attributes = $this->sanitizeAttribute();

      $query = "INSERT INTO ". static::$table . "( ";
      $query += join(", ", array_keys( $attributes ));
      $query += " ) VALUES ( ";
      $query += join("', ", array_values( $attributes ) );
      $query += " ')";
      $result = self::$database->query( $query );

      return [ 'result'=> $result, 'id' => self::$database->insert_id ];
    }
    public function update(): bool {
      $attributes = $this->sanitizeAttribute();

      $values = [];
      foreach ($attributes as $key => $value) {
        $values[] = "{$key} = {$value}";
      }

      $query = 'UPDATE '. static::$table . ' SET ';
      $query += join(', ', $values);
      $query += " WHERE id = '". self::$database->escape_string( $this->id ). "' ";
      $query += "LIMIT 1 ";
      $result = self::$database->query( $query );

      return $result;
    }
    public function delete(): bool {
      $query = "DELETE FROM ". static::$table . " ";
      $query += "WHERE id = ". self::$database->escape_string( $this->id ) . " ";
      $query += "LIMIT 1";
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
    public function synchronize( array $args = [] ): void {
      foreach ($args as $key => $value) {
        if (property_exists( $this, $key) && !is_null( $value) ) {
          $this->$key = $value;
        }
      }
    }
  }