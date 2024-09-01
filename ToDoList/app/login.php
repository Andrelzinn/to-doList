<?php
    include("conn.php");

    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_POST["name"]) || isset($_POST["pass"])) {


        if (strlen($_POST["name"]) == 0) {
            echo 'Preencha seu Nome';
        } 
        else if (strlen($_POST['pass']) == 0) {
            echo 'Preencha sua Senha';
        } 
        else {
            $name = $mysqli->real_escape_string($_POST['name']);
            $pass = $mysqli->real_escape_string($_POST['pass']);

            $sql_code = "SELECT * FROM login WHERE name = '$name'";
            $sql_query = $mysqli->query($sql_code) or die('Falha na execução do código SQL: ' . $mysqli->error);

            $quantidade = $sql_query->num_rows;

            if ($quantidade > 0) {
                $user = $sql_query->fetch_assoc();
                $hashed_password = $user['password'];

                if (password_verify($pass, $hashed_password)) {
                   
                    $_SESSION['user'] = $user['name'];
                    header('Location: /ToDoList/public/index.php');
                    exit;
                } else {
                   
                    echo 'Usuário ou senha inválidos';
                }
            } else {
        
                echo 'Usuário ou senha inválidos';
            }
        }
    }

    $mysqli->close();
?>