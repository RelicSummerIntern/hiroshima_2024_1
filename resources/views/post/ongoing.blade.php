<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-gray-800 leading-tight" style="font-size: 40px;">
            {{ __('依頼詳細') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body mt-4">
                        <form method="POST" action="{{ route('post.update', $post->id) }}">
                            @csrf
                            @method('PATCH')

                            <div class="form-group row">
                                <!-- タイトル -->
                                <div class="col-md-6">
                                    <H1> {{ old('title', $post->title) }}</H1>
                                </div>
                            </div>

                            <div class="form-group my-4">
                                <p for="body" class="col-md-4 col-form-label text-md-right" style="font-weight: bold;">{{ __('内容') }}</p>
                                <div style="display: flex; align-items: baseline;">
                                    <p type="text" name="address" id="address" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500" required>{{ old('content', $post->content) }}</p>
                                </div>
                            </div>

                            <div class="form-group my-4">
                                <p for="body" class="col-md-4 col-form-label text-md-right" style="font-weight: bold;">{{ __('報酬') }}</p>
                                <div style="display: flex; align-items: baseline;">
                                    <p type="text" name="title" id="title" maxlength="20" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500" style="width: 100px; font-weight: bold;" required>{{ old('reward', $post->reward) }}</p>
                                    <span class="ml-2" style="font-weight: bold;">円</span>
                                </div>
                            </div>

                            <div class="form-group my-4">
                                <p for="body" class="col-md-4 col-form-label text-md-right" style="font-weight: bold;">{{ __('タグ') }}</p>
                                <p style="margin-left: 20px; ">タグ：<span class="main_tag">{{ old('address', $tag->tag_name) }}</span></p>
                            </div>

                            <div class="form-group my-4">
                                <p for="body" class="col-md-4 col-form-label text-md-right" style="font-weight: bold;">{{ __('住所') }}</p>
                                <p type="text" name="address" id="address" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500" required>{{ old('address', $post->address) }}</p>
                            </div>

                            <div class="form-group my-4" style="width: 200px;">
                                <p for="body" class="col-md-4 col-form-label text-md-right" style="font-weight: bold;">{{ __('期限') }}</p>
                                <p type="datetime-local" name="deadline" id="deadline" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500">{{ old('deadline', $post->deadline) }}</p>
                            </div>

                            <div class="col-md-6">
                                @error('body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                    </div>

                    <div class="form-group row mb-4">
                        <div class="col-md-8 offset-md-4 " style="margin: auto; display: flex; justify-content: space-around;">
                            <a href="{{ route('myposts') }}">
                                <button type="button" class="btn btn-primary" style="width: 150px; height: 60px; font-size: 20px; font-weight: bold;">
                                    {{ __('戻る') }}
                                </button>
                            </a>
                            <a href="{{ route('post.markAsComplete', ['id' => $post->id]) }}">
                                <button type="button" class="btn btn-primary" style="width: 150px; height: 60px; font-size: 20px; font-weight: bold;">
                                    {{ __('依頼完了') }}
                                </button>
                            </a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>