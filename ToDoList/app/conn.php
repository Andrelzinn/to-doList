<?php
   $host = 'localhost';
   $username = 'root';
   $password = '';
   $dbname = 'users';

   $mysqli = new mysqli($host, $username, $password, $dbname);

   if ($mysqli->connect_error) {
       die('Falha na Conexão: ' . $mysqli->connect_error);
   }



?>