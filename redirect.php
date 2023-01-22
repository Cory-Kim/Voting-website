<?php

require 'functions.php';


$user = trim($_POST['username']);
$comment = trim($_POST['comments']);



if(checkIdUniquness($_POST['username'])==true){
  if(checkFormat($_POST) && saveUser($_POST) && !isset($_SESSION['commentStatus'])){
    session_start();
    $_SESSION['existingUser'] = true;
    $_SESSION['username'] = $user;
    $_SESSION['commentStatus'] = true;
    setcookie('alreadyUser', true);
    header('Location: index.php?from=new&username='.$user);
    exit();
  }
}        

  setcookie('error', 'Unable to sign up at this time.', time() + 60 * 5);
  header('Location: new.php');
  exit();
 

?>