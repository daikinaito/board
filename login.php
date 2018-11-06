<?php
try {
    ini_set('display_errors', 1);
    ini_set('error_reporting', E_ALL);

    header('Content-Type: text/html; charset=UTF-8');
    if (isset($_POST['id']) and isset($_POST['password'])) {
        require_once 'database_conf.php';
        $pdo = new \PDO($dsn, $DBUSER, $DBPASSWD, array(\PDO::ATTR_EMULATE_PREPARES => false));
        // $db = new PDO($dsn, $dbUser, $dbPass);
        $sql = 'SELECT password,name FROM users WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $_POST['id']);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $password = $row['password'];
        $name = $row['name'];

        if ($password === $_POST['password']) {
            session_start();
            $_SESSION['id'] = $_POST['id'];
            $_SESSION['login'] = 1;
            $_SESSION['name'] = $name;
            header('Location: input.html');
        }
    } else {
        $message = 'IDまたはパスワードが間違っています。';
        echo $message;
    }
}catch(Exception $e){
    echo $e->getMessage();
    exit();
}
?>