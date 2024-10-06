<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'Questionnaire';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');

  // Make sure the user is logged in before going any further.
  if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
  }

  // Show the navigation menu
  require_once('navmenu.php');

  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // If this user has never answered the questionnaire, insert empty reponses into the database
  $query = "SELECT * FROM mismatch_reponse WHERE user_id = '" . $_SESSION['user_id'] . "'";
  $data = mysqli_query($dbc, $query);
  if (mysqli_num_rows($data) == 0) {
    // First grab the list of topic IDs from the topic table
    $query = "SELECT topic_id FROM mismatch_topic ORDER BY category_id, topic_id";
    $data = mysqli_query($dbc, $query);
    $topicIDs = array();
    while ($row = mysqli_fetch_array($data)) {
      array_push($topicIDs, $row['topic_id']);
    }

    // Insert empty reponse rows into the reponse table, one per topic
    foreach ($topicIDs as $topic_id) {
      $query = "INSERT INTO mismatch_reponse (user_id, topic_id) VALUES ('" . $_SESSION['user_id']. "', '$topic_id')";
      mysqli_query($dbc, $query);
    }
  }

  // If the questionnaire form has been submitted, write the form reponses to the database
  if (isset($_POST['submit'])) {
    // Write the questionnaire reponse rows to the reponse table
    foreach ($_POST as $reponse_id => $reponse) {
      if(!($reponse == 1 || $reponse == 2)) continue;
      $query = "UPDATE mismatch_reponse SET reponse = '$reponse' WHERE reponse_id = '$reponse_id'";
      mysqli_query($dbc, $query) or die("Error querrying MySQL database");
    }
    echo '<p>Your reponses have been saved.</p>';
  }

  // Grab the reponse data from the database to generate the form
  $query = "SELECT mr.reponse_id, mr.topic_id, mr.reponse, mt.name AS topic_name, mc.name AS category_name ".
  " FROM mismatch_reponse AS mr ".
  " INNER JOIN mismatch_topic as mt USING(topic_id) ".
  " INNER JOIN mismatch_category as mc USING(category_id) ".
  " WHERE mr.user_id = '" . $_SESSION['user_id'] . "'";
  $data = mysqli_query($dbc, $query);
  $reponses = array();
  while ($row = mysqli_fetch_array($data)) { 
    array_push($reponses, $row);
    
  }

  mysqli_close($dbc);

  // Generate the questionnaire form by looping through the reponse array
  echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
  echo '<p>How do you feel about each topic?</p>';
  $category = $reponses[0]['category_name'];
  echo '<fieldset><legend>' . $reponses[0]['category_name'] . '</legend>';
  foreach ($reponses as $reponse) {
    // Only start a new fieldset if the category has changed
    if ($category != $reponse['category_name']) {
      $category = $reponse['category_name'];
      echo '</fieldset><fieldset><legend>' . $reponse['category_name'] . '</legend>';
    }

    // Display the topic form field
    echo '<label ' . ($reponse['reponse'] == NULL ? 'class="error"' : '') . ' for="' .                   $reponse['reponse_id'] . '">' . $reponse['topic_name'] . ':</label>';
    echo '<input type="radio" id="' . $reponse['reponse_id'] . '" name="' . $reponse['reponse_id'] . '" value="1" ' . ($reponse['reponse'] == 1 ? 'checked="checked"' : '') . ' />Love ';
    echo '<input type="radio" id="' . $reponse['reponse_id'] . '" name="' . $reponse['reponse_id'] . '" value="2" ' . ($reponse['reponse'] == 2 ? 'checked="checked"' : '') . ' />Hate<br />';
  }
  echo '</fieldset>';
  echo '<input type="submit" value="Save_Questionnaire" name="submit" />';
  echo '</form>';

  // Insert the page footer
  require_once('footer.php');
?>