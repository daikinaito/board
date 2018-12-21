<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>コメント画面</title>
    </head>

    <body>
        <h1>掲示板</h1>
        ようこそ{$name}さん
        <form action="insert.php" method="POST">
            <input type="text" name="comment"><br>
            <button type="submit">クリック</button>
        </form>
        {foreach $messages as $massage}
            {$message[name]}:{$message[comment]}
            <br>
        {/foreach}
        <a href="logout.php">ログアウト</a>
    </body>
</html>