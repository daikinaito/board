<?php
    header('Content-Type: text/html; charset=UTF-8');

    session_start();

    if(isset($_COOKIE[session_name()])==true)
    {
        setcookie(session_name(),'',time()-42000,'/');
    }

    session_destroy();
    header('Location: index.php');