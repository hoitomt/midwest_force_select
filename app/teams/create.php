<?php
  // echo "Create Team<br />";

  $db_include = $_SERVER['DOCUMENT_ROOT']."/app/database.php";
  include($db_include);

  $form_data = $_POST;

  $pdo = Database::connect();
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $stmt = $pdo->prepare("INSERT INTO teams (name, coach, year) VALUES (:name, :coach, :year)");

  $stmt->bindParam(':name', $form_data['name']);
  $stmt->bindParam(':coach', $form_data['coach']);
  $stmt->bindParam(':year', $form_data['year']);

  $persist_status = $stmt->execute();

  // echo "Success: $persist_status";

  Database::disconnect();

  if(1 == $persist_status) {
    header("Location: http://".$_SERVER['HTTP_HOST']."/teams/index");
  } else {
    header("Location: http://".$_SERVER['HTTP_HOST']."/teams/new");
  }

?>
