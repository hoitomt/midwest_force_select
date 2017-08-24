var app = angular.module('PlayerDb', ['ui.tinymce', 'ngSanitize']);

app.run(['$http', function ($http) {
    $http.defaults.headers.common['Authorization'] = 'Token token="4232914410a48cc406ff6ba9ed9a683e"';
    $http.defaults.headers.common['Accept'] = 'application/json;odata=verbose';
}]);

var playerDatabaseUrl = 'http://www.player-database.com/api/v1/';
var playerDatabaseUrlPlayers = playerDatabaseUrl + 'players/';
var playerDatabaseUrlTeams = playerDatabaseUrl + 'teams/';
