<?php
  $db_include = $_SERVER['DOCUMENT_ROOT']."/app/database.php";
  include($db_include);

  $player_id = $_POST['player_id'];

  $pdo = Database::connect();
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $stmt = $pdo->prepare("UPDATE players SET photo_url=:photo_url, aws_object_key=:aws_object_key WHERE id = :player_id");

  $stmt->bindParam(':photo_url', $_POST['photo_url']);
  $stmt->bindParam(':aws_object_key', $_POST['aws_object_key']);
  $stmt->bindParam(':player_id', $player_id);

  $persist_status = $stmt->execute();

  Database::disconnect();

?>
