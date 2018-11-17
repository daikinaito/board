<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    require_once 'database_conf.php';

    $id = $_POST['id'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    if(isset($id) and isset($name) and isset($password)){
        var_dump($id);
        if (is_numeric($id)) {
            $sql = 'SELECT * FROM users WHERE userId = :userId';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':userId', $_POST['id'], \PDO::PARAM_INT);
            $stmt->execute();
            var_dump($stmt->fetch());
            echo '2';
            if(empty($stmt->fetch())){
                echo '3';
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
            echo 'IDは半角数字で入力してください';
        }
    } else {
        echo '全ての値を入力してください';
    }




//    header('Location: index.html');
} catch (Exception $e) {
    var_dump($e);
}