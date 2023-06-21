<?php

use App\Models\Model;
use Dotenv\Dotenv;

require __DIR__.'/../../helpers/generals.php';
require __DIR__.'/../../database/Connection.php';
require __DIR__.'/../../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__.'/../../');
$dotenv->safeLoad();

$connect = new Connection();
$connect = $connect->connect();

Model::setDataBase( $connect );