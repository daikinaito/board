<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    require_once 'database_conf.php';

    $errors = [];
    if(isset($_POST['id']) && $_POST['id'] !== '' && is_numeric($_POST['id'])) {
       $id = $_POST['id'];
    } else {
        $errors[] = 'idが不正です';
    }

    if(isset($_POST['name']) && $_POST['name'] !== '') {
        $id = $_POST['name'];
    } else {
        $errors[] = '名前が不正です';
    }

    if(isset($_POST['password']) && $_POST['password'] !== '') {
        $id = $_POST['password'];
    } else {
        $errors[] = 'パスワードが不正です';
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
            echo '登録されました。';
            print '<a href="http://utology-internship3/board/board2/">ログイン画面へ</a><br />';
        } else {
            echo 'そのIDはすでに使われています。';
        }
    } else {
        foreach($errors as $value)
        echo $value . "<br>";
    }

//    header('Location: index.html');
} catch (Exception $e) {
    var_dump($e);
}