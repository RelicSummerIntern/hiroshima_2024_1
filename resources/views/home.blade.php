<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-gray-800 leading-tight" style="font-size: 40px;">
            Real Quest
        </h2>
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
                @if($post['user_id'] == Auth::id() || $post['is_completed'] == 1 || $currentTime > $post['deadline'])
                @continue
                @else
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
                @endif
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
    <script src="{{ asset('js/map.js') }}"></script>
    <script>
        // トップページのURLをJavaScriptに渡す
        var homeUrl = "{{ route('home') }}";
        window.homeUrl = homeUrl;
        var page1 = "http://localhost/post/detail/2"
        window.page1 = page1;
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyATCiHn-q2ufKqlPMJaRqCvdQoK3_5zJk0&callback=initMap" async defer></script>

</x-app-layout>