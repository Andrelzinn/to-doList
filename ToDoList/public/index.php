<?php
    session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: /ToDoList/login.html");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#1E1E1E">

    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />

    <link rel="stylesheet" href="/TodoList/styles/main.css">
    <title>To-do List</title>
</head>

<body>
    <ul class="menu-items">
        <li class="menu-item"><a id="todo-link1" class="link" target="_blank" href="index.php">Home</a></li>
        <li class="menu-item"><a id="todo-link2" class="link" target="_blank" href="https://www.infolivros.org/livros-pdf-gratis/superacao-pessoal/gestao-do-tempo/">Library</a></li>
        <li class="menu-item"><a id="todo-link3" class="link" target="_blank" href="app/logout.php">Logout</a></li>
    </ul>
    <div id="header">
        <div class="flexrow-container">
            <div class="standard-theme theme-selector"></div>
            <div class="light-theme theme-selector"></div>
        </div>
        <h1 id="title">Make it happen.<div id="border"></div></h1>
    </div>

  <div id="form">
        <form>
            <input class="todo-input" type="text" placeholder="Take a Task.">
            <button class="todo-btn" type="submit">I Got This!</button>
        </form>
    </div>

        <p><span id="datetime"></span></p>
    </div>

  <div id="myUnOrdList">
        <ul class="todo-list">
           
        </ul>
    </div>
    <script src="/TodoList/scripts/main.js" type="text/javascript"></script>
    <script src="/TodoList/scripts/time.js"></script>
</body>
</html>
