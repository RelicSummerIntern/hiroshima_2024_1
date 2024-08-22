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
                $deadline = \Carbon\Carbon::parse($post['deadline']);
                $diff = $currentTime->diff($deadline);
                @endphp
                <a href="{{ route('home') }}" style="text-decoration: none;">
                    <div class="Recruitment_slot">
                        <div style="text-align: center; width: 100%;">
                            <h2>{{ $post['title']}}</h2>
                        </div>
                        <div style="width: 100%; background-color: rgb(0, 0, 0); height: 2px;"></div>
                        <h3 style="margin-left: 20px; ">報酬：{{ $post['reward']}}円</h3>
                        <h3 style="margin-left: 20px; ">
                            残り時間：
                            @if ($currentTime->greaterThan($deadline))
                            期限切れ
                            @else
                            {{ $diff->days }} 日 {{ $diff->h }} 时 {{ $diff->i }} 分
                            @endif
                        </h3>
                        <h3 style="margin-left: 20px; ">場所：{{ $post['address']}}</h3>
                        <h5 style="margin-left: 20px; ">タグ：<span class="main_tag">{{ isset($tag['tag_name']) ? $tag['tag_name'] : 'タグがありません' }}</span></h5>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="left_line"></div>
            <div class="left-row_3">
                <div>
                    <!-- リンク修正！！！ -->
                    <a href="{{ route('home') }}" class="inline-block py-2 px-4 btn btn-primary text-decoration-none" style="font-size: 30px; font-weight: bold;">
                        {{ __('あなたの依頼を投稿') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="right-column">
            <div id="map"></div>
        </div>
    </div>

    <!-- Google map -->
    <script>
        // トップページのURLをJavaScriptに渡す
        var homeUrl = "{{ route('home') }}";
        window.homeUrl = homeUrl;
    </script>
    <script src="{{ asset('/js/map.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyATCiHn-q2ufKqlPMJaRqCvdQoK3_5zJk0&callback=initMap" async defer></script>

</x-app-layout>