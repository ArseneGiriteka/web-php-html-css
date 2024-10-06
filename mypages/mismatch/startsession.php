<?php
  session_start();

  if(!isset($_SESSION['user_id'])){
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      // code...
      $username = $_COOKIE['username'];
      $user_id = $_COOKIE['user_id'];
    }
  }
?>