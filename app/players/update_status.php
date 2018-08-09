<?php
  echo "Update Player Status<br />";

  $db_include = $_SERVER['DOCUMENT_ROOT']."/app/database.php";
  include($db_include);

  $team_id = $_POST['team_id'];
  $player_id = $_POST['player_id'];
  
  var_dump($_REQUEST);

  $pdo = Database::connect();
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $stmt = $pdo->prepare("UPDATE players SET active=:active WHERE id = :player_id");

  $is_active = filter_var($_POST['active'], FILTER_VALIDATE_BOOLEAN);

  echo "$is_active<br />";

  $stmt->bindParam(':active', $is_active);
  $stmt->bindParam(':player_id', $player_id);

  $persist_status = $stmt->execute();

  Database::disconnect();

  if(1 == $persist_status) {
    header("Location: http://".$_SERVER['HTTP_HOST']."/teams/players/show/?player_id=".$player_id);
  } else {
    header("Location: http://".$_SERVER['HTTP_HOST']."/teams/show/?team_id=".$team_id);
  }

?>
