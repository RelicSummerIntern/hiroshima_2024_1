// bladeファイルから変数を取得
var homeUrl = window.homeUrl;
var page1 = window.page1;

const hiroshimaStation = {
    lat: 34.3963,
    lng: 132.4594
};

var markerData = [ // マーカーを立てる場所名・緯度・経度
    {
        name: '平和記念公園',
        lat: 34.392969358792556,
        lng: 132.4522613734255,
        reward: 100,
        url: page1
    }, {
        name: '広島PARCO',
        lat: 34.39231149487647,
        lng: 132.46196912400174,
        reward: 100
    }, {
        name: '広島東照宮',
        lat: 34.4041557914022,
        lng: 132.4755641284064,
        reward: 100
    }
];

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
                var userMarker = new google.maps.Marker({
                    position: userLocation,
                    map: map,
                    title: 'あなたの位置'
                });

                // マーカーをクリックしたときの処理
                userMarker.addListener('click', function() {
                    infoWindow.setPosition(userLocation);
                    infoWindow.setContent(`
    <div style="font-family: Arial, sans-serif; font-size: 16px; color: #333; padding: 10px; border: 2px solid #007bff; border-radius: 8px;">
        <h3 style="margin: 0; color: #007bff;">あなたの位置</h3>
        <p style="margin: 5px 0;">ここに位置情報が表示されます。</p>
        <a href="${homeUrl}" style="color: #007bff; text-decoration: none;" target="_blank">詳細はこちら</a>
    </div>
  `);
                    infoWindow.open(map, userMarker);
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
                                map.setZoom(15);
                                // マーカーの位置を更新
                                userMarker.setPosition(pos);
                            },
                            () => {
                                handleLocationError(true);
                            }
                        );
                    } else {
                        // Browser doesn't support Geolocation
                        handleLocationError(false);
                    }
                });

                // マーカーを立てる場所を巡回し、マーカーを作成
                markerData.forEach(function(data) {
                    var marker = new google.maps.Marker({
                        position: {
                            lat: data.lat,
                            lng: data.lng
                        },
                        map: map,
                        title: data.name,
                    });

                    marker.addListener('click', function() {
                        infoWindow.setPosition(marker.getPosition());
                        infoWindow.setContent(`<div style="font-family: Arial, sans-serif; font-size: 16px; color: #333; padding: 10px; border: 2px solid #007bff; border-radius: 8px;">
                        <h3 style="margin: 0; color: #007bff;">${data.name}</h3>
                        <p style="margin: 5px 0;">ここに位置情報が表示されます。</p>
                        <a href="${page1}" style="color: #007bff; text-decoration: none;" target="_blank">詳細はこちら</a>
                    </div>`);
                        infoWindow.open(map, marker);
                    });
                });
            },
            function() {
                // 位置情報取得失敗の場合
                handleLocationError(true);
            });
    } else {
        // ブラウザが位置情報取得に対応していない場合
        handleLocationError(false);
    }
}

function handleLocationError(browserHasGeolocation) {
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