<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('自分の投稿一覧') }}
        </h2>
    </x-slot>

    <div class="tab_wrap">
	<input id="tab1" type="radio" name="tab_btn" checked>
	<input id="tab2" type="radio" name="tab_btn">
	<input id="tab3" type="radio" name="tab_btn">

	<div class="tab_area">
		<label class="tab1_label" for="tab1">依頼中</label>
		<label class="tab2_label" for="tab2">依頼完了</label>
		<label class="tab3_label" for="tab3">期限切れ</label>
	</div>
	<div class="panel_area">
		<div id="panel1" class="tab_panel">
            @if (!empty($postsOngoing))
                <div class="grid grid-cols-1 gap-4">
                    @foreach ($postsOngoing as $post)
                        <div class="bg-white shadow p-6 rounded-lg">
                            <h4 class="text-lg font-bold">{{ $post->title }}</h4>
                            <p class="text-gray-800">{{ $post->content }}</p>
                            <p class="text-gray-800">{{ $post->updated_at }}</p>

                            <div class="mt-4 flex">
                                <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-primary mr-2"
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
        @if (!empty($postsCompleted))
                <div class="grid grid-cols-1 gap-4">
                    @foreach ($postsCompleted as $post)
                        <div class="bg-white shadow p-6 rounded-lg">
                            <h4 class="text-lg font-bold">{{ $post->title }}</h4>
                            <p class="text-gray-800">{{ $post->content }}</p>
                            <p class="text-gray-800">{{ $post->updated_at }}</p>

                            <div class="mt-4 flex">
                                <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-primary mr-2"
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
		<div id="panel3" class="tab_panel">
			<p>panel3</p>
		</div>
	</div>
    </div>
</x-app-layout>
