<?php
  session_start();
  session_destroy();
  header("Location: /ToDoList/public/login.html");
  exit;

?>