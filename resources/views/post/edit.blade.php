<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('依頼投稿') }}
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
                                <div class="col-md-6">
                                    <p id="body" class="form-control @error('body') is-invalid @enderror" name="body" required>{{ old('body', $post->body) }}</p>
                                </div>
                            </div>

                            <div class="form-group my-4">
                                <p for="body" class="col-md-4 col-form-label text-md-right">{{ __('内容') }}</p>
                                <p id="body" class="form-control @error('body') is-invalid @enderror" name="body" required>{{ old('body', $post->body) }}</p>

                                <p for="body" class="col-md-4 col-form-label text-md-right">{{ __('報酬') }}</p>
                                <p id="body" class="form-control @error('body') is-invalid @enderror" name="body" required>{{ old('body', $post->body) }}</p>

                                <p for="body" class="col-md-4 col-form-label text-md-right">{{ __('タグ') }}</p>
                                <p id="body" class="form-control @error('body') is-invalid @enderror" name="body" required>{{ old('body', $post->body) }}</p>

                                <p for="body" class="col-md-4 col-form-label text-md-right">{{ __('住所') }}</p>
                                <p id="body" class="form-control @error('body') is-invalid @enderror" name="body" required>{{ old('body', $post->body) }}</p>

                                <p for="body" class="col-md-4 col-form-label text-md-right">{{ __('期限') }}</p>
                                <p id="body" class="form-control @error('body') is-invalid @enderror" name="body" required>{{ old('body', $post->body) }}</p>

                                <div class="col-md-6">
                                    @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <a href="{{ route('myposts') }}">
                                        <button type="button" class="btn btn-primary">
                                            {{ __('戻る') }}
                                        </button>
                                    </a>

                                    <button type="acceptance" class="btn btn-primary">
                                        {{ __('受諾') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>