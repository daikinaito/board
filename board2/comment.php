<?php
    // smarty のライブラリを読み込みます
    include_once __DIR__ . '/libs/Smarty.class.php';

    // smartyを宣言して設定を書き加えます
    $smarty = new Smarty();
    $smarty->escape_html = true;
    $smarty->template_dir = __DIR__ . '/templates';
    $smarty->compile_dir = __DIR__ . '/templates_c';

    session_start();

    if(isset($_SESSION['login'])==false){
            header('Location: false.html');
    }

    $name=$_SESSION['name'];

    $smarty->assign('name', $name);

    header('Content-Type: text/html; charset=utf8');
    require_once 'database_conf.php';

    $sql = 'SELECT comment,name  FROM comments,users WHERE comments.userId=users.userId';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $messages = $stmt->fetchAll();

    $smarty->assign("messages", $messages);

//    foreach($messages as $result){
//        echo $result['name'];
//        echo ':';
//        echo $result['comment'];
//        echo '<br>';
//    }

    $smarty->display('comment.tpl');