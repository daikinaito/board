<?php
// smarty のライブラリを読み込みます
include_once __DIR__ . '/libs/Smarty.class.php';

// smartyを宣言して設定を書き加えます
$smarty = new Smarty();
$smarty->escape_html = true;
$smarty->template_dir = __DIR__ . '/templates';
$smarty->compile_dir = __DIR__ . '/templates_c';

if (isset($_POST['id']) and isset($_POST['password'])){
    require_once 'database_conf.php';
    header('Content-Type: text/html; charset=utf8');
//        $db = new PDO($dsn, $dbUser, $dbPass);
//        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
//        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'select password,name from users where userId = :userId';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':userId', $_POST['id'], \PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $password = $row['password'];
    $name = $row['name'];
    $post_password = $_POST['password'];



    if($password === $_POST['password']){
        session_start();
        $_SESSION['id'] = $_POST['id'];
        $_SESSION['login'] = 1;
        $_SESSION['name'] = $name;
        header('Location: comment.php');
    }else{
        $message = 'IDまたはパスワードが間違っています。';
        $smarty->assign("message", $message);
    }
}
$smarty->display('login.tpl');