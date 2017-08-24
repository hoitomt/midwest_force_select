function getQueryParams() {
  var queryParams = {}
  var urlQueryParams = location.search.replace('?', '').split('&')
  jQuery.each(urlQueryParams, function(i, queryParam) {
    var keyValue = queryParam.split('=');
    queryParams[keyValue[0]] = keyValue[1];
  });
  return queryParams;
}

function getPlayerId() {
  var queryParams = getQueryParams();
  return queryParams['player_id'];
};

function getTeamSlug() {
  var queryParams = getQueryParams();
  return queryParams['team_slug'];
}

function getTeamId() {
  var queryParams = getQueryParams();
  return queryParams['team_id'];
};

app.controller('PlayerController', function($scope, Player, Team) {
  
  $scope.setProfilePhotoLink = function(url){
    jQuery('a#medium-image-link').attr('href', url);
  }
  
  $scope.setProfilePhoto = function() {
    var photo = "http://www.midwestforceselect.com/wp-content/uploads/2016/08/girl_silhouette.png";
    if($scope.player && $scope.player.profile_photo) {
      photo = $scope.player.profile_photo.photo.profile.url;
      $scope.setProfilePhotoLink($scope.player.profile_photo.photo.medium.url);
    }
    jQuery('#player-profile-photo')
        .attr('src', photo)
        .width(200);
  }
  
  $scope.setBreadcrumbTeamLink = function() {
    var teamSlug = getTeamSlug();
    var linkHref = "/teams/" + teamSlug + "/";
    jQuery('a#breadcrumb-team').attr("href", linkHref);
  }
  
  $scope.showEditPlayerForm = function() {
    $scope.showEditableFields = true;
  }
  
  $scope.hideEditPlayerForm = function() {
    $scope.showEditableFields = false;
  }

  function initPlayerData(playerId) {
    var playerPromise = Player.fetchPlayer(playerId);
    playerPromise.then(function(player){
      $scope.player = player;
      $scope.setProfilePhoto();
    }, function(reason) {
      alert('Failed: ' + reason);
    });
  }
  
  function initTeamData(teamId) {
    var teamPromise = Team.fetch(teamId);
    teamPromise.then(function(team){
      $scope.team = team;
      $scope.setBreadcrumbTeamLink();
    }, function(reason) {
      alert('Failed: ' + reason);
    });
  }

  $scope.height = function(player) {
    var height = '';
    if(player && player.height_feet && player.height_feet > 0) {
      height += "" + player.height_feet + "' ";
      if(player.height_inches) {
        height += player.height_inches + '"'
      } else {
        height += '0"';
      }
    }

    return height;
  }

  $scope.uploadFile = function(files) {
    console.log("Upload File");
    // When uploading, uploading f
    var f = files[0];

    Player.uploadPlayerPhoto(f).then(function(response){
      console.log("Photo Upload Success", response);
      // response is the player_photo.to_json from the api
      // response.id is the id of the player_photo record
      $scope.player.profile_photo = response;
      // $scope.player.photo_id = response.id;
      $scope.setProfilePhoto();
    }, function(reason){
      console.log("Photo Upload Failure", reason);
    });
  }

  $scope.editPlayer = function(player) {
    var photo = "http://www.midwestforceselect.com/wp-content/uploads/2016/08/girl_silhouette.png";
    if(player.profile_photo) {
      photo = player.profile_photo.photo.profile.url;
    }
    jQuery('#uploaded-photo')
          .attr('src', photo)
          .width(200);
    $scope.player = player;
    $scope.showNewPlayerForm = true;
  }

  $scope.submit = function() {
    var _this = this;
    console.log("Submit", $scope.player);

    if($scope.player.id) {
      // Update an existing player
      Player.update($scope.player).then(function(player){
        console.log("Player Updated", player);
      }, function(reason){
        alert('Updating a player failed' + reason)
      });
    } else {
      var teamId = getTeamId();
      Player.create(teamId, $scope.player).then(function(player){
        console.log("Player Added", player);
      }, function(reason) {
        alert('Creating a player failed' + reason);
      });
    } 
    
    $scope.hideEditPlayerForm();
  }
  
  init = function() {    
    var playerId = getPlayerId();
    var teamId = getTeamId();
    if(playerId) {
      $scope.showEditableFields = false;
      initPlayerData(playerId);
      initTeamData(teamId);
    } else {
      // Assume it is the new player screen
      $scope.player = {};
      $scope.player.team_id = teamId;
      $scope.setProfilePhoto();
      $scope.showEditableFields = true;
      initTeamData(teamId);
    }
  }
  init();
});
