<?php

define('DB_HOST',     '127.0.0.1');
define('DB_PORT',     '9999');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'comp3015');

$downVoteCount = 0;

function connect()
{
    $link = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
    if (!$link)
    {
        echo mysqli_connect_error();
        die();
    }

    return $link;
}

  
function createTable1()
{
    $link    = connect();
    $query   = 'create table polling ( orderCreated integer primary key auto_increment, username varchar(20), comment varchar(250), votes integer default 0)';
    $success = mysqli_query($link, $query); 

    mysqli_close($link);
    return $success;
}

function dropTable1()
{
  $link    = connect();
  $query   = 'drop table polling';
  $success = mysqli_query($link, $query); 

  mysqli_close($link);
  return $success;
}

function createTable2()
{
    $link    = connect();
    $query   = 'create table polling2 (orderCreated integer primary key auto_increment, username varchar(20), comment varchar(250), votes integer default 0)';
    $success = mysqli_query($link, $query); 

    mysqli_close($link);
    return $success;
}

function dropTable2()
{
  $link    = connect();
  $query   = 'drop table polling2';
  $success = mysqli_query($link, $query); 

  mysqli_close($link);
  return $success;
}

function table2ByUsername()
{
  $link    = connect();
  $query   = 'insert into polling2 (username, comment, votes) select username, comment, votes from polling order by username';
  $success = mysqli_query($link, $query); 

  mysqli_close($link);
  return $success;
}

function table1ByUsername()
{
  $link    = connect();
  $query   = 'insert into polling (username, comment, votes) select username, comment, votes from polling2 order by username';
  $success = mysqli_query($link, $query); 

  mysqli_close($link);
  return $success;
}

function table2ByVotes()
{
  $link    = connect();
  $query   = 'insert into polling2 (username, comment, votes) select username, comment, votes from polling order by votes DESC';
  $success = mysqli_query($link, $query); 

  mysqli_close($link);
  return $success;
}

function table1ByVotes()
{
  $link    = connect();
  $query   = 'insert into polling (username, comment, votes) select username, comment, votes from polling2 order by votes DESC';
  $success = mysqli_query($link, $query); 

  mysqli_close($link);
  return $success;
}


function saveUser($data)
{
    $username   = trim($data['username']);
    $comment   = trim($data['comments']);

    $link    = connect();
    $query   = 'insert into polling(username, comment) values("'.$username.'","'.$comment.'")';
    $success = mysqli_query($link, $query); 

    mysqli_close($link);
    return $success;
}


function getAllProfiles()
{
    $link     = connect();
    $query    = 'select * from polling';
    $profiles = mysqli_query($link, $query);

    mysqli_close($link);
    return $profiles;
}

function deleteProfile($username)
{
  $link    = connect();
  $query   = 'delete from polling where username = "'.$username.'" ';
  $success = mysqli_query($link, $query);

  mysqli_close($link);
  return $success;
}

function upVote($username)
{
  $link    = connect();
  $query   = 'UPDATE polling SET votes = (votes + 1) WHERE username = "'.$username.'" ';
  $success = mysqli_query($link, $query);

  mysqli_close($link);
  return $success;
}

function downVote($username)
{
  $link    = connect();
  $query   = 'UPDATE polling SET votes = (votes - 1) WHERE username = "'.$username.'" ';
  $success = mysqli_query($link, $query);

  mysqli_close($link);
  return $success;
}

function saveDownVote($username)
{
  $link    = connect();
  $query   = 'insert into voteCount(username) values("'.$username.'")';
  $success = mysqli_query($link, $query);

  mysqli_close($link);
  return $success;
}

function updateDownVote($username)
{
  $link    = connect();
  $query   = 'UPDATE voteCount SET count = (count + 1) WHERE username = "'.$username.'" ';
  $success = mysqli_query($link, $query);

  mysqli_close($link);
  return $success;
}


function votelimitToOne($username)
{
  $link    = connect();
  $query   = 'update voteRestriction set count = case when count >= 1 then 1 when count = 0 then 0 when count <= -1 then -1 end where username =  "'.$username.'" ';
  $success = mysqli_query($link, $query);

  mysqli_close($link);
  return $success;
}

function getDownVoteCount($username){

  $link    = connect();
  $query   = 'SELECT count FROM voteCount WHERE username = "'.$username.'"';
  $success = mysqli_query($link, $query); 

  mysqli_close($link);

  return $success;
}



function resetDownVoteCount($username){
  $link    = connect();
  $query   = 'delete from voteCount where username = "'.$username.'" ';
  $success = mysqli_query($link, $query);

  mysqli_close($link);
  return $success;
}



function checkFormat($data){
  $valid = true;

  if( trim($data['username'])        == '' ||
      trim($data['comments'])        == '')
  {
    $valid = false;
  }

  elseif(!preg_match('/^[a-zA-Z]{1}[a-zA-Z0-9]{0,9}$/', trim($data['username'])))
  {
    $valid = false;
  }
  
  elseif(!preg_match('/^[a-zA-Z0-9\.\,\?\!\s]{1,500}$/', trim($data['comments'])))
  {
    $valid = false;
  }

  return $valid;
}

function checkIdUniquness($username)
{
  $uniqueness = true;
  $link     = connect();
  $query    = 'select * from polling';
  $result = mysqli_query($link, $query);

  while($row = mysqli_fetch_array($result)){
    if($username == $row['username']){
      $uniqueness = false;
    } 
  }
  mysqli_close($link);
  return $uniqueness;
}

function downloadFile()
{
  $fp = fopen('./users.txt', 'a+');

  $link     = connect();
  $query    = 'select * from polling';
  $result = mysqli_query($link, $query);

  while($row = mysqli_fetch_array($result)){
    fwrite($fp, $row['username'].'|'.$row['comment'].'|'. $row['votes']. PHP_EOL);
  }
  fclose($fp);
}



?>