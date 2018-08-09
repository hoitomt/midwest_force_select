<?php
  // echo "Create Team<br />";

  $db_include = $_SERVER['DOCUMENT_ROOT']."/app/database.php";
  include($db_include);

  $pdo = Database::connect();
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  
  $my_date_time = DateTime::createFromFormat('m/d/Y', $_POST['date']);
  $formatted_date = $my_date_time->format('Y/m/d');

  $stmt = $pdo->prepare("INSERT INTO box_scores (player_id, opponent, date, total_points, assists, rebounds, one_point_attempt, one_point_make, two_point_attempt, two_point_make, three_point_attempt, three_point_make, created_at) VALUES (:player_id, :opponent, :date, :total_points, :assists, :rebounds, :one_point_attempt, :one_point_make, :two_point_attempt, :two_point_make, :three_point_attempt, :three_point_make, NOW())");

  $stmt->bindParam(':player_id', $_POST['player_id']);
  $stmt->bindParam(':opponent', $_POST['opponent']);
  $stmt->bindParam(':date', $formatted_date);
  $stmt->bindParam(':total_points', $_POST['total_points']);
  $stmt->bindParam(':assists', $_POST['assists']);
  $stmt->bindParam(':rebounds', $_POST['rebounds']);
  $stmt->bindParam(':one_point_attempt', $_POST['one_point_attempt']);
  $stmt->bindParam(':one_point_make', $_POST['one_point_make']);
  $stmt->bindParam(':two_point_attempt', $_POST['two_point_attempt']);
  $stmt->bindParam(':two_point_make', $_POST['two_point_make']);
  $stmt->bindParam(':three_point_attempt', $_POST['three_point_attempt']);
  $stmt->bindParam(':three_point_make', $_POST['three_point_make']);

  $box_score_persist_status = $stmt->execute();

  if(1 == $box_score_persist_status) {
    header("Location: http://".$_SERVER['HTTP_HOST']."/gametime-performers");
  } else {
    header("Location: http://".$_SERVER['HTTP_HOST']."/gametime-performers/new");
  }

?>
