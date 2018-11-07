<?php
    header('Content-Type: text/html; charset=UTF-8');
    session_start();
    if(isset($_SESSION['login'])==false)
    {
      header('Location: false.html');
    }
    require_once 'database_conf.php';
    
    $sql = 'SELECT * FROM `board`';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $messages = $stmt->fetchAll();
