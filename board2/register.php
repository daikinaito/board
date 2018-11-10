<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    require_once 'database_conf.php';

    $sql = 'INSERT INTO users (userId, name, password) VALUES (:userId, :name, :password)';
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':userId', $_POST['id'], \PDO::PARAM_INT);
    $stmt->bindValue(':name', $_POST['name'], \PDO::PARAM_STR);
    $stmt->bindValue(':password', $_POST['password'], \PDO::PARAM_STR);
    $hoge = $stmt->execute();

    var_dump($hoge);


//    header('Location: index.html');
} catch (Exception $e) {
    var_dump($e);
}