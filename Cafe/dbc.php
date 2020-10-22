<?php
function dbc()
{
  $host = "localhost";
  $dbname = "";
  $user = "root";
  $pass = "root";


  $dns = "mysql:host=$host;dbname=$dbname;charset=utf8";

  try {
  $pdo = new PDO($dns, $user, $pass,
  // $pdo = new PDO('mysql:dbname=cafe;charset=utf8;host=localhost','root','root');


  [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ]);
  // echo 'success';
  return $pdo;
  } catch(PDOException $e) {
    exit($e->getMessage());
  }
   }

// dbc();