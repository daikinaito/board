<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>新規登録画面</title>
    </head>

    <body>
        <form action="register.php" method="POST" autocomplete="off">
            <a>IDは半角数字で入力してください</a>
            <br>
            <input type="text" name="id" placeholder="ID"><br>
            <input type="text" name="name" placeholder="名前"><br>
            <input type="text" name="password" placeholder="パスワード"><br>
            <button type="submit">登録</button>
        </form>
        {if $message}
            {$message}
        {/if}
        <ul>
            {if $errors}
                {foreach $errors as $error}
                    <li>{$error}</li>
                {/foreach}
            {/if}
        </ul>
        <a href="index.php">ログイン画面へ</a>
    </body>
</html>