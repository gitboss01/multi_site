<?php
require './vendor/autoload.php';
// Using Medoo namespace
use Medoo\Medoo;
// Initialize
$db = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'multi_site_db',
    'server' => 'localhost',
    'username' => 'root',
    'password' => '',
    'charset'=>'utf8'
]);