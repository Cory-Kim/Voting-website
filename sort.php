<?php

require 'functions.php';



if($_GET['from'] == 'sortByUsername'){
  dropTable2();
  createTable2();
  table2ByUsername();
  dropTable1();
  createTable1();
  table1ByUsername();
  dropTable2();
  header('Location: index.php');
  
}


elseif($_GET['from'] == 'sortByVotes'){
  dropTable2();
  createTable2();
  table2ByVotes();
  dropTable1();
  createTable1();
  table1ByVotes();
  dropTable2();
  header('Location: index.php');
  
}

elseif($_GET['from'] == 'download'){
  file_put_contents("users.txt", "");
  downloadFile();
  header('Location: index.php');
}


?>