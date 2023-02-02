<?php

  $DataBase = mysqli_connect('localhost', 'root', '', 'ecommerce');

  if (!$DataBase) {
    echo 'Error al Conectarse con la Base de Datos';
    echo 'Código del error: '. mysqli_connect_errno();
    echo 'Descripción del error: '.mysqli_connect_error();
    exit;
  }