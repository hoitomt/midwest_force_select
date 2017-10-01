<?php
  // echo "Create Team<br />";

  $db_include = $_SERVER['DOCUMENT_ROOT']."/app/database.php";
  include($db_include);

  $team_id = $_POST['team_id'];
  $player_id = $_POST['player_id'];

  $pdo = Database::connect();
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $stmt = $pdo->prepare("UPDATE players SET name=:name, number=:number, height_feet=:height_feet, height_inches=:height_inches, position=:position, school=:school, year=:year, athletic_accomplishments=:athletic_accomplishments, colleges_interested=:colleges_interested, gpa=:gpa WHERE id = :player_id");

  $stmt->bindParam(':name', $_POST['name']);
  $stmt->bindParam(':number', $_POST['number']);
  $stmt->bindParam(':height_feet', $_POST['height_feet']);
  $stmt->bindParam(':height_inches', $_POST['height_inches']);
  $stmt->bindParam(':position', $_POST['position']);
  $stmt->bindParam(':school', $_POST['school']);
  $stmt->bindParam(':year', $_POST['graduating_year']);
  $stmt->bindParam(':athletic_accomplishments', $_POST['athletic_accomplishments']);
  $stmt->bindParam(':colleges_interested', $_POST['colleges_interested']);
  $stmt->bindParam(':gpa', $_POST['gpa']);
  $stmt->bindParam(':player_id', $player_id);

  $persist_status = $stmt->execute();

  Database::disconnect();

  if(1 == $persist_status) {
    header("Location: http://".$_SERVER['HTTP_HOST']."/teams/show/?team_id=".$team_id);
  } else {
    header("Location: http://".$_SERVER['HTTP_HOST']."/teams/players/edit/?player=".$player_id);
  }

?>
