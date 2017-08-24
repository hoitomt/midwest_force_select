app.service('Team', function($q, $http) {
  this.fetch = function(teamId) {
    var deferred = $q.defer();
    $http.get(playerDatabaseUrlTeams + teamId)
      .then(function(response){
        console.log(response.data);
        deferred.resolve(response.data);
      });
    return deferred.promise;
  };
});