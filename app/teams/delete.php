<?php
  $db_include = $_SERVER['DOCUMENT_ROOT']."/app/database.php";
  include($db_include);

  $pdo = Database::connect();
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $roster_stmt = $pdo->prepare("DELETE FROM rosters WHERE team_id=:team_id");
  $roster_stmt->bindParam(':team_id', $_GET['team_id']);
  $roster_stmt->execute();

  $stmt = $pdo->prepare("DELETE FROM teams WHERE id=:team_id");

  $stmt->bindParam(':team_id', $_GET['team_id']);

  $stmt->execute();

  Database::disconnect();

  header("Location: http://".$_SERVER['HTTP_HOST']."/teams/index/");
?>
