<?php
  $db_include = $_SERVER['DOCUMENT_ROOT']."/app/database.php";
  include($db_include);
  
  $pdo = Database::connect();
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $stmt = $pdo->prepare("INSERT INTO player_videos (player_id, video_url, description) VALUES(:player_id, :video_url, :description)");

  $stmt->bindParam(':player_id', $_POST['player_id']);
  $stmt->bindParam(':video_url', $_POST['video_url']);
  $stmt->bindParam(':description', $_POST['description']);

  $persist_status = $stmt->execute();

  Database::disconnect();

  header("Location: http://".$_SERVER['HTTP_HOST']."/teams/players/show/?player_id=".$_POST['player_id']);
?>
