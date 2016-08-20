app.service('Player', function($q, $http) {
  this.fetch = function(teamId) {
    var deferred = $q.defer();
    $http.get(playerDatabaseUrlTeams + teamId + "/players")
      .then(function(response){
        console.log(response.data);
        deferred.resolve(response.data);
      });
    return deferred.promise;
  };

  this.create = function(teamId, playerData) {
    var deferred = $q.defer();
    jPlayerData = JSON.stringify(playerData);
    $http.post(playerDatabaseUrlTeams + teamId + '/players', jPlayerData)
      .then(function(response){
        console.log(response.data);
        deferred.resolve(response.data);
      });
    return deferred.promise;
  };

  this.update = function(playerData) {
    var deferred = $q.defer();
    jPlayerData = JSON.stringify(playerData);
    $http.put(playerDatabaseUrlTeams + playerData.team_id + '/players/' + playerData.id, jPlayerData)
      .then(function(response){
        console.log(response.data);
        deferred.resolve(response.data);
      });
    return deferred.promise;
  };

  this.delete = function(playerData) {
    var deferred = $q.defer();
    jPlayerData = JSON.stringify(playerData);
    $http.delete(playerDatabaseUrlTeams + playerData.team_id + '/players/' + playerData.id)
      .then(function(response){
        console.log(response.data);
        deferred.resolve(response.data);
      });
    return deferred.promise;
  };
});
