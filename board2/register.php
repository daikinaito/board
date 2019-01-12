<?php
error_reporting(0);
// smarty のライブラリを読み込みます
include_once __DIR__ . '/libs/Smarty.class.php';

// smartyを宣言して設定を書き加えます
$smarty = new Smarty();
$smarty->escape_html = true;
$smarty->template_dir = __DIR__ . '/templates';
$smarty->compile_dir = __DIR__ . '/templates_c';

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

    $smarty->assign('errors', []);
    $smarty->assign('message', []);

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
            $message = '登録されました。';
            $smarty->assign('message', $message);
        } else {
            $message = 'そのIDはすでに使われています。';
            $smarty->assign('message', $message);
        }
    } else {
        $smarty->assign('errors', $errors);
    }
    $smarty->display('register.tpl');
} catch (Exception $e) {
    var_dump($e);
}