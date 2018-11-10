<?php
    require_once 'database_conf.php';

    $sql = 'INSERT INTO users (id, name, password) VALUES (?,?,?)';
    $stmt = $pdo->prepare($sql);

    $data[] = $_POST['id'];
    $data[] = $_POST['name'];
    $data[] = $_POST['password'];

    $stmt->execute($data);

    header('Location: index.html');