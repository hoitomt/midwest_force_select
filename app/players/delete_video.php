<?php
  $db_include = $_SERVER['DOCUMENT_ROOT']."/app/database.php";
  include($db_include);
  
  $player_id = $_GET['player_id'];

  $pdo = Database::connect();
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $roster_stmt = $pdo->prepare("DELETE FROM player_videos WHERE id=:id");
  $roster_stmt->bindParam(':id', $_GET['id']);
  $roster_stmt->execute();

  Database::disconnect();

  header("Location: http://".$_SERVER['HTTP_HOST']."/teams/players/show/?player_id=".$player_id);
?>
