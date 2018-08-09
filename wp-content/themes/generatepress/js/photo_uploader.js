dataUrlToBlob = function(dataurl) {
    var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
    while(n--){
        u8arr[n] = bstr.charCodeAt(n);
    }
    return new Blob([u8arr], {type:mime});
}

var uploadFileToS3Oriented = function(playerId) {
  var imageFile = document.getElementById('select-player-photo').files[0];
  
  var orientedImage = loadImage(
    imageFile,
    function (canvas) {
      jQuery('#player-profile-photo')
    	   .attr('src', canvas.toDataURL())
      var imageBlog = dataUrlToBlob(canvas.toDataURL("image/png"));
      addPhotoMfs(imageBlog, playerId);
    },
    {
      maxWidth: 150,
      orientation: true,
      canvas: false
    }
  );
}

var uploadFileToS3 = function(playerId) {
  var files = document.getElementById('select-player-photo').files;
  if (!files.length) {
    return alert('Please choose a file to upload first.');
  }
  
  var file = files[0]
  var reader = new FileReader();
              
  reader.onload = function (e) {
    jQuery('#player-profile-photo')
    .attr('src', e.target.result)
    .width(150);
  };

  reader.readAsDataURL(file);
  
  addPhotoMfs(file, playerId);
}

var addPhotoMfs = function(file, playerId) {
  var fileName = file.name;
  var albumPhotosKey = 'player_profile_photos/' + encodeURIComponent(playerId) + '/';

  var photoKey = albumPhotosKey + 'profile_photo';
  s3.upload({
    Key: photoKey,
    Body: file,
    ACL: 'public-read'
  }, function(err, data) {
    if (err) {
      return alert('There was an error uploading your photo: ', err.message);
    }
    var imageUrl = data.Location;
    console.log('Successfully uploaded photo.');
    updatePlayerRecord(playerId, imageUrl, photoKey);
  });
}

var updatePlayerRecord = function(playerId, photoUrl, awsObjectKey) {
  var photoParams = {
    player_id: playerId,
    photo_url: photoUrl, 
    aws_object_key: awsObjectKey
  };
  
  jQuery.post("/app/players/upload_photo.php", photoParams, function(data) {
    console.log("Uploaded");
  }).fail(function(err) {
    console.log("Error: ", err);
  });
}

var albumBucketName = 'midwest-force-select-photos';
var bucketRegion = 'us-east-1';
var IdentityPoolId = 'us-east-1:3475bc32-ee94-416f-9b4c-5beecfd61776';

AWS.config.update({
  region: bucketRegion,
  credentials: new AWS.CognitoIdentityCredentials({
    IdentityPoolId: IdentityPoolId
  })
});

var s3 = new AWS.S3({
  apiVersion: '2006-03-01',
  params: {Bucket: albumBucketName}
});

