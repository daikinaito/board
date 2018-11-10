<?php
    session_start();

    if(isset($_SESSION['login'])==false){
        header('Location: false.html');
    }
    $name=$_SESSION['name'];
    echo 'ようこそ';
    echo $name;
    echo 'さん'; 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>コメント画面</title>
    </head>

    <body>
        <h1>掲示板</h1>
        <form action="insert.php" method="POST">
            <input type="text" name="comment"><br>
            <button type="submit">クリック</button>
        </form>
    <?php
        header('Content-Type: text/html; charset=utf8');
        require_once 'database_conf.php';
//        $db = new PDO($dsn, $dbUser, $dbPass);
//        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
//        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT comment,name  FROM comments,users WHERE comments.userId=users.userId';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $messages = $stmt->fetchAll();

        foreach($messages as $result){
            echo $result['name'];
            echo ':';
            echo $result['comment'];
            echo '<br>';
        }

    ?>
        <a href="logout.php">ログアウト</a>
    </body>
</html>