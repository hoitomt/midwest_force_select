<?php
  // echo "Create Team<br />";

  $db_include = $_SERVER['DOCUMENT_ROOT']."/app/database.php";
  include($db_include);

  $form_data = $_POST;
  $team_id = $form_data['team_id'];

  $pdo = Database::connect();
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $stmt = $pdo->prepare("INSERT INTO players (name, number, team_id, height_feet, height_inches, position, school, year, athletic_accomplishments, colleges_interested, gpa) VALUES (:name, :number, :team_id, :height_feet, :height_inches, :position, :school, :year, :athletic_accomplishments, :colleges_interested, :gpa)");

  $stmt->bindParam(':name', $form_data['name']);
  $stmt->bindParam(':number', $form_data['number']);
  $stmt->bindParam(':team_id', $team_id);
  $stmt->bindParam(':height_feet', $form_data['height_feet']);
  $stmt->bindParam(':height_inches', $form_data['height_inches']);
  $stmt->bindParam(':position', $form_data['position']);
  $stmt->bindParam(':school', $form_data['school']);
  $stmt->bindParam(':year', $form_data['graduating_year']);
  $stmt->bindParam(':athletic_accomplishments', $form_data['athletic_accomplishments']);
  $stmt->bindParam(':colleges_interested', $form_data['colleges_interested']);
  $stmt->bindParam(':gpa', $form_data['gpa']);

  $player_persist_status = $stmt->execute();
  if(1 != $player_persist_status) {
    header("Location: http://".$_SERVER['HTTP_HOST']."/teams/players/new/?team_id=".$team_id);
  }
  
  $last_id_stmt = $pdo->query("SELECT LAST_INSERT_ID()");
  $player_id = $last_id_stmt->fetchColumn();
  
  $roster_stmt = $pdo->prepare("INSERT INTO rosters (player_id, team_id) VALUES (:player_id, :team_id)");

  $roster_stmt->bindParam(':player_id', $player_id);
  $roster_stmt->bindParam(':team_id', $team_id);

  $roster_persist_status = $roster_stmt->execute();
  
  Database::disconnect();

  if(1 == $roster_persist_status) {
    header("Location: http://".$_SERVER['HTTP_HOST']."/teams/show/?team_id=".$team_id);
  } else {
    header("Location: http://".$_SERVER['HTTP_HOST']."/teams/players/new/?team_id=".$team_id);
  }

?>
