<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Real Quest
            <br>
            リアル・クエスト
        </h2>
    </x-slot>

    <div class="main">
        <div class="left-column">
            <div class="left-row_1">周辺の依頼</div>
            <div class="left-row_2">Left Row 2 (Scrollable Content)</div>
            <div class="left-row_3">Left Row 3</div>
        </div>
        <div class="right-column">
            <div id="map"></div>
        </div>
    </div>

    <!-- Google map -->
    <script src="{{ asset('/js/map.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyATCiHn-q2ufKqlPMJaRqCvdQoK3_5zJk0&callback=initMap" async defer></script>

</x-app-layout>