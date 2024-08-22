// bladeファイルから変数を取得
var homeUrl = window.homeUrl;
// var page1 = window.page1;
// var page2 = window.page2;
// var page3 = window.page3;

const hiroshimaStation = {
    lat: 34.3963,
    lng: 132.4594
};

var markerData = [ // マーカーを立てる場所名・緯度・経度
    {
        name: '荷物が重すぎ...',
        lat: 34.392969358792556,
        lng: 132.4522613734255,
        reward: 500,
        url: 1
    }, {
        name: '犬を探してほしい',
        lat: 34.39231149487647,
        lng: 132.46196912400174,
        reward: 100000,
        url: 2
    }, {
        name: '電球変えたい',
        lat: 34.4041557914022,
        lng: 132.4755641284064,
        reward: 1000,
        url: 3
    },{
        name: '買い物の代行',
        lat: 34.40024302267361,
        lng:  132.46624166670338,
        reward: 3000,
        url: 4
    },{
        name: '買い物の代行',
        lat: 34.39239213441988,
        lng:   132.4846344316151,
        reward: 5000,
        url: 5
    }
];

for (let i = 0; i < markerData.length; i++) {
    eval('var page' + (i + 1) + ' = window.page' + (i + 1));
}

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
                    title: 'あなたの位置',
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        fillColor: '#FF3200', // 设置图标填充颜色
                        fillOpacity: 1.0,
                        strokeColor: '#000000', // 设置图标边框颜色
                        strokeWeight: 2,
                        scale: 10 // 设置图标大小
                    }
                });

                // マーカーをクリックしたときの処理
                userMarker.addListener('click', function() {
                    infoWindow.setPosition(userLocation);
                    infoWindow.setContent(`
        <h3 style="margin: 0; color: #007bff;">あなたの位置</h3>
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
                        reward: data.reward,
                    });

                    let linkUrl;
                    for (let i = 0; i < markerData.length; i++) {
                        if (data.url === i + 1) {
                            linkUrl = eval('page' + (i + 1));
                        }
                    }

                    marker.addListener('click', function() {
                        infoWindow.setPosition(marker.getPosition());
                        infoWindow.setContent(`<div style="font-family: Arial, sans-serif; font-size: 16px; color: #333; padding: 10px; border: 2px solid #007bff; border-radius: 8px;">
                        <h3 style="margin: 0; color: #007bff;">${data.name}</h3>
                        <h2 style="margin: 5px 0;">${data.reward}円</h2>
                        <a href="${linkUrl}" style="color: #007bff; text-decoration: none;" target="_blank">詳細はこちら</a>
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