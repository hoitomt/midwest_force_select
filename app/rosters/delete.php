<?php
  $db_include = $_SERVER['DOCUMENT_ROOT']."/app/database.php";
  include($db_include);

  $pdo = Database::connect();
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $stmt = $pdo->prepare("DELETE FROM rosters WHERE id=:roster_id");

  $stmt->bindParam(':roster_id', $_GET['roster_id']);

  $stmt->execute();

  Database::disconnect();

  header("Location: http://".$_SERVER['HTTP_HOST']."/teams/show/?team_id=".$_GET['team_id']);
?>
