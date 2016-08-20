var app = angular.module('TeamProfile', []);

app.run(['$http', function ($http) {
    $http.defaults.headers.common['Authorization'] = 'Token token="4232914410a48cc406ff6ba9ed9a683e"';
    $http.defaults.headers.common['Accept'] = 'application/json;odata=verbose';
}]);

var playerDatabaseUrl = 'https://young-sands-56740.herokuapp.com/api/v1/';
var playerDatabaseUrlTeams = playerDatabaseUrl + 'teams/';
