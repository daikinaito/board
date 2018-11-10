<?php
    session_start();

    if(isset($_SESSION['login'])==false){
        header('Location: false.html');
    }
    header('Content-Type: text/html; charset=utf8');
    require_once 'database_conf.php';

    $sql = 'INSERT INTO comments (comment,userId) VALUES (:comment,:userId)';
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':comment', $_POST['comment'], \PDO::PARAM_STR);
    $stmt->bindValue(':userId', $_SESSION['id'], \PDO::PARAM_STR);

//    $data[] =  $_POST['comment'];
//    $data[] = $_SESSION['id'];
    $stmt->execute();
    header('Location: comment.php');