<?php

  require 'Funciones.php';
  require 'DataBase.php';
  require __DIR__.'../vendor/autoload.php';

  //Conectamos la Base de Datos
  use Model\ActiveRecord;
  ActiveRecord::setDataBase( $DataBase );