function initMap() {
    // 今の位置を取得
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var userLocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            // マップを表示かつ現在地に設定
            var map = new google.maps.Map(document.getElementById('map'), {
                center: userLocation,
                zoom: 15
            });

            const locationButton = document.createElement("button");
            locationButton.textContent = "現在地";

            locationButton.style.backgroundColor = "#fff";
            locationButton.style.border = "2px solid #000";
            locationButton.style.borderRadius = "3px";
            locationButton.style.boxShadow = "0 2px 6px rgba(0,0,0,0.3)";
            locationButton.style.cursor = "pointer";
            locationButton.style.fontSize = "16px";
            locationButton.style.lineHeight = "38px";
            locationButton.style.textAlign = "center";
            locationButton.style.width = "100px";
            locationButton.style.marginBottom = "20px";

            map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
            locationButton.addEventListener("click", () => {
              // Try HTML5 geolocation.
              if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                  (position) => {
                    const pos = {
                      lat: position.coords.latitude,
                      lng: position.coords.longitude,
                    };
          
                    infoWindow.setPosition(pos);
                    infoWindow.setContent("Location found.");
                    infoWindow.open(map);
                    map.setCenter(pos);
                  },
                  () => {
                    handleLocationError(true, infoWindow, map.getCenter());
                  }
                );
              } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
              }
            });
        }, 
        function() {
            // 位置情報取得失敗の場合
            handleLocationError(true, map.getCenter());
        });
    } else {
        // ブラウザが位置情報取得に対応していない場合
        handleLocationError(false, map.getCenter());
    }
}

function handleLocationError(browserHasGeolocation, pos) {
    var infoWindow = new google.maps.InfoWindow({
        map: map
    });
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
}