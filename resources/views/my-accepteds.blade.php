<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('自分の投稿一覧') }}
        </h2>
    </x-slot>

    <div class="tab_wrap">
	<input id="tab1" type="radio" name="tab_btn" checked>
	<input id="tab2" type="radio" name="tab_btn">

	<div class="tab_area">
		<label class="tab1_label" for="tab1">受諾待ち</label>
		<label class="tab2_label" for="tab2">進行中</label>
	</div>
	<div class="panel_area">
		<div id="panel1" class="tab_panel">
            @if (!empty($accepteds))
                <div class="grid grid-cols-1 gap-4">
                    @foreach ($acceptedsOngoing as $acceptedOngoing)
                        <div class="bg-white shadow p-6 rounded-lg">
                            <h4 class="text-lg font-bold">{{ $acceptedOngoing->post->title }}</h4>
                            <p class="text-gray-800">{{ $acceptedOngoing->post->content }}</p>
                            <p class="text-gray-800">{{ $acceptedOngoing->post->updated_at }}</p>

                            <div class="mt-4 flex">
                                <a href="{{ route('post.edit', ['id' => $acceptedOngoing->post->id]) }}" class="btn btn-primary mr-2"
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
            @if (!empty($accepteds))
                <div class="grid grid-cols-1 gap-4">
                    @foreach ($acceptedsCompleted as $acceptedCompleted)
                        <div class="bg-white shadow p-6 rounded-lg">
                            <h4 class="text-lg font-bold">{{ $acceptedCompleted->post->title }}</h4>
                            <p class="text-gray-800">{{ $acceptedCompleted->post->content }}</p>
                            <p class="text-gray-800">{{ $acceptedCompleted->post->updated_at }}</p>

                            <div class="mt-4 flex">
                                <a href="{{ route('post.edit', ['id' => $acceptedCompleted->post->id]) }}" class="btn btn-primary mr-2"
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
	</div>
    </div>
</x-app-layout>
