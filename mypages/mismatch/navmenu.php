<?php
  echo '<hr>';
  if(isset($_SESSION['user_id'])){
    echo '&#10084; <a href="viewprofile.php">View Profile</a>       ';
    echo '&#10084; <a href="editprofile.php">Edit Profile</a>       ';
    echo '&#10084; <a href="logout.php">Log out '.$_SESSION['username'].'</a>       ';
    echo '&#10084; <a href="mymismatch.php">Mismatch me</a>       ';
  }
  else{
    echo '&#10084; <a href="login.php">Log in</a><br />';
    echo '&#10084; <a href="signup.php">Sign up</a><br />';
  }
  echo '<hr>';
?>