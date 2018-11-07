<?php

    if (isset($_POST['id']) and isset($_POST['password'])){
        require_once 'database_conf.php';
        header('Content-Type: text/html; charset=utf8');
        // $pdo = new PDO($dsn,$DBUSER, $DBPASSWD);
        $db = new PDO($dsn, $dbUser, $dbPass);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'select password,name from users where id = ?';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(1, $_POST['id']);
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