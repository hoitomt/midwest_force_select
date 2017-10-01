<?php
  //echo "Create Roster<br />";

  $db_include = $_SERVER['DOCUMENT_ROOT']."/app/database.php";
  include($db_include);

  $team_id = $_POST['team_id'];
  $player_ids = $_POST['player_ids'];
  
  $pdo = Database::connect();
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $stmt = $pdo->prepare("INSERT INTO rosters (team_id, player_id) VALUES (:team_id, :player_id)");

  foreach($player_ids as &$player_id) {
    $stmt->bindParam(':team_id', $team_id);
    $stmt->bindParam(':player_id', $player_id);
    $persist_status = $stmt->execute();
  }

  Database::disconnect();

  if(1 == $persist_status) {
    header("Location: http://".$_SERVER['HTTP_HOST']."/teams/show/?team_id=".$team_id);
  } else {
    header("Location: http://".$_SERVER['HTTP_HOST']."/teams/players/new/?team=".$team_id);
  }

?>
