<?php
  // echo "Create Team<br />";

  $db_include = $_SERVER['DOCUMENT_ROOT']."/app/database.php";
  include($db_include);

  $pdo = Database::connect();
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $stmt = $pdo->prepare("UPDATE teams SET name=:name, coach=:coach, year=:year WHERE id = :team_id");

  $stmt->bindParam(':name', $_POST['name']);
  $stmt->bindParam(':coach', $_POST['coach']);
  $stmt->bindParam(':year', $_POST['year']);
  $stmt->bindParam(':team_id', $_POST['team_id']);

  $persist_status = $stmt->execute();

  // echo "Success: $persist_status";

  Database::disconnect();

  if(1 == $persist_status) {
    header("Location: http://".$_SERVER['HTTP_HOST']."/teams/index");
  } else {
    header("Location: http://".$_SERVER['HTTP_HOST']."/teams/edit");
  }

?>
