<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-gray-800 leading-tight" style="font-size: 40px;">
            {{ __('新規投稿') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-10 sm:px-6 lg:px-8">
        <div class="my-4">
            <div class="bg-white shadow p-6 rounded-lg">
                <form action="{{ route('post.store') }}" method="post">
                    @csrf
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- タイトル -->
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">タイトル</label>
                        <input type="text" name="title" id="title" maxlength="20" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500" required>
                    </div>
                    <!-- 本文 -->
                    <div class="mb-4">
                        <label for="content" class="block text-gray-700 text-sm font-bold mb-2">内容</label>
                        <textarea name="content" id="content" rows="6" maxlength="200" class="w-full  border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500" style="resize: none;" required></textarea>
                    </div>
                    <!-- 報酬 -->
                    <div class="mb-4">
                        <label for="reward" class="block text-gray-700 text-sm font-bold mb-2">報酬</label>
                        <div class="flex items-center">
                            <textarea name="reward" id="reward" rows="1" class="w-[10%] border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500" style="resize: none;" required></textarea>
                            <span class="ml-2">円</span>
                        </div>
                    </div>
                    <!-- タグ -->
                    <div class="mb-4">
                        <label label for="tag_id" class="block text-gray-700 text-sm font-bold mb-2">タグ</label>
                        <select name="tag_id" id="tag_id" style="border-radius: 5px;">
                            <option value="">タグを選択</option>
                            <option value="1">手助け</option>
                            <option value="2">探し物</option>
                            <option value="3">その他</option>
                        </select>
                    </div>
                    <!-- 住所 -->
                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 text-sm font-bold mb-2">住所</label>
                        <input type="text" name="address" id="address" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500" required>
                    </div>
                    <!-- 期限 -->
                    <div class="mb-4" style="width: 165px;">
                        <label for="deadline" class="block text-gray-700 text-sm font-bold mb-2">期限</label>
                        <input type="datetime-local" name="deadline" id="deadline" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500">
                    </div>
                    <!-- ボタン -->
                    <div class="flex justify-end">
                        <button type="submit" class="py-2 px-4 btn btn-primary">投稿する</button>
                        <a href="{{ route('post.index', []) }}" class="py-2 px-4 ml-4 btn btn-secondary">キャンセル</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>