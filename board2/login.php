<?php

    if (isset($_POST['id']) and isset($_POST['password'])){
        require_once 'database_conf.php';
        header('Content-Type: text/html; charset=utf8');
//        $db = new PDO($dsn, $dbUser, $dbPass);
//        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
//        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'select password,name from users where userId = :userId';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':userId', $_POST['id'], \PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $password = $row['password'];
        $name = $row['name'];

        if($password === $_POST['password']){
            session_start();
            $_SESSION['id'] = $_POST['id'];
            $_SESSION['login'] = 1;
            $_SESSION['name'] = $name;
            header('Location: comment.php');
        }else{
            $message = 'IDまたはパスワードが間違っています。';
            echo $message;
        }
    }