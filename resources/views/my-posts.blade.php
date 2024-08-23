<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-gray-800 leading-tight" style="font-size: 40px;">
            {{ __('自分の投稿一覧') }}
        </h2>
    </x-slot>

    <div class="tab_wrap">
        <input id="tab1" type="radio" name="tab_btn" checked>
        <input id="tab2" type="radio" name="tab_btn">
        <input id="tab3" type="radio" name="tab_btn">

        <div class="tab_area">
            <label class="tab1_label" for="tab1">受諾待ち</label>
            <label class="tab2_label" for="tab2">進行中</label>
            <label class="tab3_label" for="tab3">依頼完了</label>
        </div>
        <div class="panel_area">
            <div id="panel1" class="tab_panel">
                @if (!empty($postsAccepting))
                <div class="grid grid-cols-1 gap-4">
                    @foreach ($postsAccepting as $postAccepting)
                    <div class="bg-white shadow p-6 rounded-lg">
                        <h2 class="font-bold">{{ $postAccepting->title }}</h2>
                        <p class="text-gray-800" style="font-size: 25px;">{{ $postAccepting->content }}</p>
                        <p class="text-gray-800">{{ $postAccepting->updated_at }}</p>

                        <div class="mt-4 flex">
                            <a href="{{ route('post.edit', ['id' => $postAccepting->id]) }}" class="btn btn-primary mr-2"
                                role="button">
                                {{ __('編集') }}
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="flex justify-center items-center h-full">
                    <p class="text-lg text-gray-600">投稿はありません。</p>
                </div>
                @endif
            </div>
            <div id="panel2" class="tab_panel">
                @if (!empty($postsOngoing))
                <div class="grid grid-cols-1 gap-4">
                    @foreach ($postsOngoing as $postOngoing)
                    <div class="bg-white shadow p-6 rounded-lg">
                        <h2 class="font-bold">{{ $postOngoing->title }}</h2>
                        <p class="text-gray-800" style="font-size: 25px;">{{ $postOngoing->content }}</p>
                        <p class="text-gray-800">{{ $postOngoing->updated_at }}</p>

                        <div class="mt-4 flex">
                            <a href="{{ route('post.edit', ['id' => $postOngoing->id]) }}" class="btn btn-primary mr-2"
                                role="button">
                                {{ __('詳細') }}
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="flex justify-center items-center h-full">
                    <p class="text-lg text-gray-600">投稿はありません。</p>
                </div>
                @endif
            </div>
            <div id="panel3" class="tab_panel">
                @if (!empty($postsOngoing))
                <div class="grid grid-cols-1 gap-4">
                    @foreach ($postsCompleted as $postCompleted)
                    <div class="bg-white shadow p-6 rounded-lg">
                        <h2 class="font-bold">{{ $postCompleted->title }}</h2>
                        <p class="text-gray-800" style="font-size: 25px;">{{ $postCompleted->content }}</p>
                        <p class="text-gray-800">{{ $postCompleted->updated_at }}</p>

                        <div class="mt-4 flex">
                            <a href="{{ route('post.acceptanceDetails', ['id' => $postCompleted->id]) }}" class="btn btn-primary mr-2"
                                role="button">
                                {{ __('詳細') }}
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="flex justify-center items-center h-full">
                    <p class="text-lg text-gray-600">投稿はありません。</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>