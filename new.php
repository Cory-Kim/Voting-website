<?php

require 'functions.php';



if(isset($_COOKIE['error']))
{
    $message = '<div class="alert alert-danger text-center">'
        . $_COOKIE['error'] .
        '</div>';

    setcookie('error', null);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link href="css/style.css" rel="stylesheet">
</head>
<body>
  
<h1> Simple Polling System </h1>

<form action="redirect.php" method="post">

<div class="userID">
  <input 
        value=""
        name="username"
        placeholder="Username"
        type="text"
        autofocus
  />
</div>

<div>
    <textarea name="comments" rows="7" cols="70" id="comments" style="font-family:sans-serif;font-size:1.0em;"></textarea>
  </div>
  <input type="submit" value="Submit">
</form>


</body>
</html>