<?php

require 'functions.php';

session_start();


if($_SESSION['username'] != $_GET['id'] && !isset($_SESSION['voteCount']) )
{
  if($_GET['from'] == 'upVote'){
    upVote($_GET['id']);
    $_SESSION['voteCount'] = true;
    header('Location: index.php');
    exit();
  }

  elseif($_GET['from'] == 'downVote'){
  
      downVote($_GET['id']); 
      $_SESSION['voteCount'] = true;
      saveDownVote($_GET['id']);
      updateDownVote($_GET['id']);
  
    $row = mysqli_fetch_array(getDownVoteCount($_GET['id']));
    $downVoteCount = $row['count'];

    votelimitToOne($_GET['id']);

    if($downVoteCount >= 5){
      deleteProfile($_GET['id']);
      resetDownVoteCount($_GET['id']);
    }
    header('Location: index.php');
    exit();
  }
  
}

header('Location: index.php');
exit();



?>