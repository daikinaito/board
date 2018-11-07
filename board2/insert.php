<?php
    session_start();

    if(isset($_SESSION['login'])==false){
        header('Location: false.html');
    }
    header('Content-Type: text/html; charset=utf8');
    require_once 'database_conf.php';

    $db = new PDO($dsn, $dbUser, $dbPass);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'INSERT INTO comments (comment,userId) VALUES (?,?)';
    $stmt = $db->prepare($sql);
    $data[] =  $_POST['comment'];
    $data[] = $_SESSION['id'];
    // $stmt->bindValue(':name', $name, \PDO::PARAM_STR);
    // $stmt->bindValue(':comment', $comment, \PDO::PARAM_STR);
    $stmt->execute($data);
    header('Location: comment.php');