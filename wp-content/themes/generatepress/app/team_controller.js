function getTeamId() {
  return jQuery('#js-team-id').data('team_id');
};

function getTeamSlug() {
  return jQuery('#team-table').data('slug');
}

app.controller('TeamController', function($scope, Player) {

  init = function() {  
    $scope.players = [];
    var teamId = getTeamId();
    initTeamData(teamId);
  }
  init();
  
  function initTeamData(teamId) {
    var playersPromise = Player.fetch(teamId);
    playersPromise.then(function(players){
      for(i in players) {
        $scope.players.push(players[i]);
      }
    }, function(reason) {
      alert('Failed: ' + reason);
    });
  }

  $scope.playerLink = function(player) {
    var teamId = getTeamId();
    var teamSlug = getTeamSlug();
    return "/team/player/?player_id=" + player.id + "&team_id=" + teamId + "&team_slug=" + teamSlug;
  }
  
  $scope.newPlayerLink = function() {
    var teamId = getTeamId();
    return "/teams/player/?team_id=" + teamId + "&team_slug=" + getTeamSlug();
  }

  $scope.height = function(player) {
    var height = '';
    if(player.height_feet && player.height_feet > 0) {
      height += "" + player.height_feet + "' ";
      if(player.height_inches) {
        height += player.height_inches + '"'
      } else {
        height += '0"';
      }
    }

    return height;
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
});
