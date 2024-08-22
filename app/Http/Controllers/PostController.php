<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostTag;
use App\Models\Acceptance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'desc')->get();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    // 投稿作成用
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:20',
            'content' => 'required|string|max:200',
            'reward' => 'required|integer',
            'tag_id' => 'required|integer',
            'address' => 'required|string',
            'deadline' => [
                'required',
                'datetime',
                'after:' . now()->addMinutes(4)->format('Y-m-d H:i:s'),
            ],
        ]);

        $post = new Post();
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->reward = $validatedData['reward'];
        $post->deadline = $validatedData['deadline'];
        $post->address = $validatedData['address'];
        $post->user_id = Auth::id();
        $post->save();

        $posttag = new PostTag();
        $posttag->tag_id = $validatedData['tag_id'];
        $posttag->post_id = $post->id;
        $posttag->save();

        $accepted = new Acceptance();
        $accepted->post_id = $post->id;
        $accepted->user_id = Auth::id();
        $accepted->is_completed = 0;
        $accepted->save();

        return redirect()->route('post.index')->with('success', '投稿が作成されました');
    }

    // home.blade.phpの投稿一覧表示用
    public function allPosts()
    {
        $acceptedPostIds = Acceptance::where('is_completed', 0)->pluck('post_id');

        if ($acceptedPostIds->isEmpty()) {
            $posts = collect(); // 空のコレクション
        } else {
            $posts = Post::whereIn('id', $acceptedPostIds)->orderBy('updated_at', 'desc')->get();
        }

        return view('home', compact('posts'));
    }


    public function myPosts()
    {
        $posts = Post::where('user_id', Auth::id())->orderBy('updated_at', 'desc')->get();
        return view('my-posts', compact('posts'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:10',
            'content' => 'required|text|max:200',
            'reward' => 'required|integer',
            'tag_name' => 'required|string',
            'address' => 'required|string',
            'deadline' => 'required|date',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];
        $post->save();

        return redirect()->route('myposts')->with('success', '投稿が更新されました');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('myposts')->with('success', '投稿が削除されました');
    }
}
