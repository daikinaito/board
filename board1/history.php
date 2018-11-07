<?php
    header('Content-Type: text/html; charset=UTF-8');
    session_start();
    if(isset($_SESSION['login'])==false)
    {
        header('Location: false.html');
    }
    require_once 'database_conf.php';

    $sql = 'SELECT comment FROM comments';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $messages = $stmt->fetchAll();

    foreach ($messages as $history)
//        $userId = $history['id'];
        $comment = $history['comment'];
        echo "$comment";