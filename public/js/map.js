// 広島駅座標
const hiroshimaStation = {
    lat: 34.3963,
    lng: 132.4594
};

// bladeファイルから変数を取得
var homeUrl = window.homeUrl;

function initMap() {
    // 今の位置を取得
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var userLocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            // マップを表示かつ現在地に設定
            map = new google.maps.Map(document.getElementById('map'), {
                center: userLocation,
                zoom: 15
            });

            infoWindow = new google.maps.InfoWindow(); // 初期化 InfoWindow

            // 現在地にマーカーを設定
            marker = new google.maps.Marker({
                position: userLocation,
                map: map,
                title: 'あなたの位置'
            });

            // 为标记添加点击事件监听器
            marker.addListener('click', function() {
              infoWindow.setPosition(userLocation);
              infoWindow.setContent(`
                <div style="font-family: Arial, sans-serif; font-size: 16px; color: #333; padding: 10px; border: 2px solid #007bff; border-radius: 8px;">
                    <h3 style="margin: 0; color: #007bff;">あなたの位置</h3>
                    <p style="margin: 5px 0;">ここに位置情報が表示されます。</p>
                    <a href="${homeUrl}" style="color: #007bff; text-decoration: none;" target="_blank">詳細はこちら</a>
                </div>
              `);
              infoWindow.open(map, marker);
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

            map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(locationButton);
            locationButton.addEventListener("click", () => {
              // Try HTML5 geolocation.
              if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                  (position) => {
                    const pos = {
                      lat: position.coords.latitude,
                      lng: position.coords.longitude,
                    };
                    map.setCenter(pos);

                    // マーカーの位置を更新
                    marker.setPosition(pos);
                  },
                  () => {
                    handleLocationError(true, map.getCenter());
                  }
                );
              } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, map.getCenter());
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
    // 問題が発生した場合、広島駅に移動
    map.setCenter(hiroshimaStation);

    infoWindow.setPosition(hiroshimaStation);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
    infoWindow.open(map); // 問題が発生した場合，InfoWindowを表示

    // マーカーの位置を更新
    if (marker) {
        marker.setPosition(hiroshimaStation);
    } else {
        marker = new google.maps.Marker({
            position: hiroshimaStation,
            map: map,
            title: '広島駅'
        });
    }
}