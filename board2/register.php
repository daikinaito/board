<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    require_once 'database_conf.php';

    $errors = [];
    if(isset($_POST['id']) && $_POST['id'] !== '' && is_numeric($_POST['id'])) {
       $id = $_POST['id'];
    } else {
        $errors[] = 'idが不正';
    }

    if(isset($_POST['name']) && $_POST['name'] !== '') {
        $id = $_POST['name'];
    } else {
        $errors[] = 'nameが不正';
    }

    if(isset($_POST['password']) && $_POST['password'] !== '') {
        $id = $_POST['password'];
    } else {
        $errors[] = 'passwordが不正';
    }


    if(empty($errors)) {
        $sql = 'SELECT * FROM users WHERE userId = :userId';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':userId', $_POST['id'], \PDO::PARAM_INT);
        $stmt->execute();

        if(empty($stmt->fetch())){
            $sql = 'INSERT INTO users (userId, name, password) VALUES (:userId, :name, :password)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':userId', $_POST['id'], \PDO::PARAM_INT);
            $stmt->bindValue(':name', $_POST['name'], \PDO::PARAM_STR);
            $stmt->bindValue(':password', $_POST['password'], \PDO::PARAM_STR);
            $stmt->execute();

            var_dump($stmt->fetch());
        } else {
            echo 'そのIDはすでに使われています。';
        }
    } else {
        echo '全ての値を入力してください';
    }

//    header('Location: index.html');
} catch (Exception $e) {
    var_dump($e);
}