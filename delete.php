<?php
require 'functions.php';

session_start();

if($_SESSION['username'] == $_GET['id'])
{
    deleteProfile($_GET['id']);
    resetDownVoteCount($_GET['id']);
    
    $_SESSION = [];
    setcookie('alreadyUser', null);
    session_destroy();
    header('Location: index.php');
    exit();
}

header('Location: index.php');
exit();