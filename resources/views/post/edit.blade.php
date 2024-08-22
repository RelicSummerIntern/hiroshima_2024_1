<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
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
                                    <p id="body" class="form-control @error('body') is-invalid @enderror" name="content" required>{{ old('content', $post->content) }}</p>
                                </div>
                            </div>

                            <div class="form-group my-4">    
                                <p for="body" class="col-md-4 col-form-label text-md-right">{{ __('内容') }}</p>
                                <p name="content" id="content" rows="6" maxlength="200" class="w-full  border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500" style="resize: none;" required></p>
                            </div>
                               

                                <p for="body" class="col-md-4 col-form-label text-md-right">{{ __('報酬') }}</p>
                                <p name="reward" id="reward" rows="1" class="w-[10%] border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500" style="resize: none;" required></p>

                                <p for="body" class="col-md-4 col-form-label text-md-right">{{ __('タグ') }}</p>
                                <p style="margin-left: 20px; ">タグ：<span class="main_tag">ペット</span></p>  
                            
                                <p for="body" class="col-md-4 col-form-label text-md-right">{{ __('住所') }}</p>
                                <p type="text" name="address" id="address" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500" required></p>

                                <p for="body" class="col-md-4 col-form-label text-md-right">{{ __('期限') }}</p>
                                <p type="datetime-local" name="deadline" id="deadline" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500"></p>

                                <div class="col-md-6">
                                    @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4" style="margin: auto; display: flex; justify-content: space-around;">
                                    <a href="{{ route('myposts') }}">
                                        <button type="button" class="btn btn-primary" style="width: 150px; height: 60px; font-size: 20px; font-weight: bold;">
                                            {{ __('戻る') }}
                                        </button>
                                    </a>
                                    <a href="{{ route('myposts') }}">
                                        <button type="button" class="btn btn-primary" style="width: 150px; height: 60px; font-size: 20px; font-weight: bold;">
                                            {{ __('受諾') }}
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