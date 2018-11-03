<?php
    header('Content-Type: text/html; charset=UTF-8');
    session_start();
    if(isset($_SESSION['login'])==false)
    {
      header('Location: false.html');
    }
    require_once 'database_conf.php';

    $sql = 'INSERT INTO comments (comment, userId) VALUES (:comment, )';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name, \PDO::PARAM_STR);
    $stmt->bindValue(':comment', $comment, \PDO::PARAM_STR);
    $stmt->execute();
