function getTeamId() {
  var teamId = jQuery('#js-team-id').data('team_id');
  return teamId;
};

app.controller('PlayerController', function($scope, Player) {
  $scope.players = [];
  $scope.showNewPlayerForm = false;

  init = function() {
    console.log("Run the init function");
    var teamId = getTeamId();
    var playersPromise = Player.fetch(teamId);
    playersPromise.then(function(players){
      for(i in players) {
        $scope.players.push(players[i]);
      }
    }, function(reason) {
      alert('Failed: ' + reason);
    });
  }
  init();

  function resetPlayerForm() {
    $scope.player = {};
  }

  $scope.playerLink = function(player) {
    return "team/player/?player_id=" + player.id
  }

  $scope.deletePlayer = function(player) {
    console.log("Delete a player", player);

    var index = $scope.players.indexOf(player);
    $scope.players.splice(index, 1);

    var _this = this;
    Player.delete(player).then(function(response){
      console.log("Player Deleted", response)
    }, function(reason){
      alert('Updating a player failed' + reason)
    });
  }

  $scope.editPlayer = function(player) {
    console.log("Edit a player", player);
    $scope.player = player;
    $scope.showNewPlayerForm = true;
  }

  $scope.newPlayer = function() {
    if($scope.showNewPlayerForm == true) {
      $scope.showNewPlayerForm = false;
      resetPlayerForm();
    } else {
      console.log("Add a new player");
      $scope.showNewPlayerForm = true;
    }
  }

  $scope.submit = function() {
    var _this = this;
    console.log($scope.player);
    if($scope.player.id) {
      // Update an existing player
      Player.update($scope.player).then(function(player){
        console.log("Player Updated", player)
      }, function(reason){
        alert('Updating a player failed' + reason)
      });
    } else {
      var teamId = getTeamId();
      Player.create(teamId, $scope.player).then(function(player){
        _this.players.push(player);
      }, function(reason) {
        alert('Creating a player failed' + reason);
      });
    }

    $scope.showNewPlayerForm = false;
    resetPlayerForm();
  }
});
