<?php

  require 'Funciones.php';
  require 'DataBase.php';
  require __DIR__.'/../vendor/autoload.php';

  use Models\ActiveRecord;
  ActiveRecord::setDataBase( $DataBase );