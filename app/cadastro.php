<?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'users';

    $mysqli = new mysqli($host, $username, $password, $dbname);

    if ($mysqli->connect_error) {
        die('Falha na Conexão' . $mysqli->connect_error);
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['password'];

        $cripted_pass = password_hash($pass, PASSWORD_BCRYPT);

        $sql = "INSERT INTO login (name, password, email) VALUES ('$name', '$cripted_pass', '$email')";

        if (mysqli_query($mysqli, $sql)){
            header("Location: /ToDoList/public/login.html");
        }

    }else{
        echo "Não Foi possivel enviar os dados";
    }

    $mysqli->close();