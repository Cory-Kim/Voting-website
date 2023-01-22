<!-- My SQL table name is polling -->

<?php

require 'functions.php';
$downVoteCount = 0;
$profiles = getAllProfiles();

if(!isset($_COOKIE['alreadyUser']))
{
  header('Location: new.php');
}

elseif (isset($_COOKIE['alreadyUser']))
{
  session_start();
  echo "Welcome " . $_SESSION['username'];
  echo "<br>";
  echo "<br>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link href="css/style.css" rel="stylesheet">
  <title> Comp3015 Final </title>
</head>
<body>

<?php

    echo '
    <a class="vote+" style="text-decoration: none" href="sort.php?from=sortByUsername">
    Sort by username
    </a>
    ';

    echo '<br>';

    echo '
    <a class="vote+" style="text-decoration: none" href="sort.php?from=sortByVotes">
    Sort by highest votes
    </a>
    ';

    echo '<br>';

    echo '
    <a class="vote+" style="text-decoration: none" href="sort.php?from=download">
    Download the file
    </a>
    ';

    echo '
    
    <table class="styled-table" width="90%" >
            
            
            
    <thead>

        <tr>
            <th>username</th>
            <th>comment</th>
            <th>votes</th>
            <th>+/-</th>
            <th>delete</th>
        </tr>

    </thead>
    
    ';

  foreach($profiles as $profile){
    echo '
            
            <tbody>
        
            <tr class="active-row">

                <td> '.$profile['username'].' </td>
                <td> '.$profile['comment'].' </td>
                <td> '.$profile['votes'].' </td>
                <td>
                  <a class="vote+" style="text-decoration: none" href="update.php?from=upVote&id='.$profile['username'].'">
                    +1
                  </a>

                  <a class="" style="text-decoration: none" href="update.php?from=downVote&id='.$profile['username'].'">
                    -1
                  </a>
                </td>
                <td>
                  <a class=""   href="delete.php?id='.$profile['username'].'">
                     Delete
                  </a>
                </td>

            </tr>

          ';
  }

  echo '
    </tbody>
  </table>

  ';
  exit();
?>


</body>
</html>