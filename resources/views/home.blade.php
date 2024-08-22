<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Real Quest
            <br>
            リアル・クエスト
        </h2>
        <a href="{{ route('home') }}" style="text-decoration: none;">
            <image src="{{ asset('images/myPage.png') }}" x="0" y="0" width="60" height="60" />
        </a>
    </x-slot>

    <div class="main">
        <div class="left-column">
            <div class="left-row_1">周辺の依頼</div>
            <div class="left_line"></div>
            <div class="left_narrow_down">
                <select name="tag_id" id="tag_id" class="form-control">
                    <option value="">タグで条件絞り</option>
                    <option value="1">手助け</option>
                    <option value="2">探し物</option>
                    <option value="3">その他</option>
                </select>
                <select name="order" id="order" class="form-control">
                    <option value="1">新しい順</option>
                    <option value="2">古い順</option>
                    <option value="3">高い順</option>
                    <option value="4">安い順</option>
                </select>
            </div>
            <div class="left-row_2">
                @php
                $currentTime = \Carbon\Carbon::now();
                @endphp

                @foreach($combined as [$post, $tag])
                @php
                $deadline = \Carbon\Carbon::parse($post['deadline'])->format('Y/m/d H:i:s');
                @endphp
                <a href="{{ route('post.detail', ['id' => $post['id']]) }}" style="text-decoration: none;">
                    <div class="Recruitment_slot">
                        <div style="text-align: center; width: 100%;">
                            <h2>{{ $post['title']}}</h2>
                        </div>
                        <div style="width: 100%; background-color: rgb(0, 0, 0); height: 2px;"></div>
                        <h3 style="margin-left: 20px;">報酬：{{ $post['reward']}}円</h3>
                        <h3 style="margin-left: 20px;">残り時間：</h3>
                        <h3 style="margin-left: 20px;">
                            <div class="countdown" data-target-time="{{ $deadline }}">
                                <span class="countdown-day">0</span>日
                                <span class="countdown-hour">0</span>時間
                                <span class="countdown-min">0</span>分
                                <span class="countdown-sec">0</span>秒
                            </div>
                        </h3>
                        <h3 style="margin-left: 20px;">場所：{{ $post['address']}}</h3>
                        <h5 style="margin-left: 20px;">タグ：<span class="main_tag">{{ $tag['tag_name'] ?? 'タグがありません' }}</span></h5>
                    </div>
                </a>
                @endforeach

            </div>
            <div class="left_line"></div>
            <div class="left-row_3">
                <div>
                    <!-- リンク修正！！！ -->
                    <a href="{{ route('post.create') }}" class="inline-block py-2 px-4 btn btn-primary text-decoration-none" style="font-size: 30px; font-weight: bold;">
                        {{ __('あなたの依頼を投稿') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="right-column">
            <div id="map"></div>
        </div>
    </div>
    <script>
        let countdown = setInterval(function() {
            document.querySelectorAll('.countdown').forEach(function(elem) {
                const now = new Date() //今の日時
                const targetTime = new Date(elem.getAttribute("data-target-time")) //ターゲット日時を取得
                const remainTime = targetTime - now //差分を取る（ミリ秒で返ってくる

                // 指定の日時を過ぎていたらスキップ
                if (remainTime < 0) return true

                const difDay = Math.floor(remainTime / 1000 / 60 / 60 / 24) % 365
                const difHour = Math.floor(remainTime / 1000 / 60 / 60) % 24
                const difMin = Math.floor(remainTime / 1000 / 60) % 60
                const difSec = Math.floor(remainTime / 1000) % 60

                // 残りの日時を上書き
                elem.querySelectorAll('.countdown-day')[0].textContent = difDay
                elem.querySelectorAll('.countdown-hour')[0].textContent = difHour
                elem.querySelectorAll('.countdown-min')[0].textContent = difMin
                elem.querySelectorAll('.countdown-sec')[0].textContent = difSec
            });
        }, 1000) //1秒間に1度処理
    </script>

    <!-- Google map -->
    <script>
        var addressList = '{{$address}}';
        console.log(addressList);

        const hiroshimaStation = {
            lat: 34.3963,
            lng: 132.4594
        };

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

                        // マーカーをクリックしたときの処理
                        marker.addListener('click', function() {
                            infoWindow.setPosition(userLocation);
                            infoWindow.setContent(`
                <div style="font-family: Arial, sans-serif; font-size: 16px; color: #333; padding: 10px; border: 2px solid #007bff; border-radius: 8px;">
                    <h3 style="margin: 0; color: #007bff;">あなたの位置</h3>
                    <p style="margin: 5px 0;">ここに位置情報が表示されます。</p>
                    <a href="{{ route('home') }}" style="color: #007bff; text-decoration: none;" target="_blank">詳細はこちら</a>
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
                                        map.setZoom(15);
                                        // マーカーの位置を更新
                                        marker.setPosition(pos);
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
                    },
                    function() {
                        // 位置情報取得失敗の場合
                        handleLocationError(true);
                    });
            } else {
                // ブラウザが位置情報取得に対応していない場合
                handleLocationError(false);
            }
            if (addressList && addressList.length > 0) {
                addressList.forEach(function(address) {
                    geocodeAddress(address, function(location) {
                        new google.maps.Marker({
                            position: location,
                            map: map,
                            title: address
                        });
                    });
                });
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
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyATCiHn-q2ufKqlPMJaRqCvdQoK3_5zJk0&callback=initMap" async defer></script>

</x-app-layout>