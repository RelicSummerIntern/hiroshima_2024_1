<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:10',
            'content' => 'required|string|max:200',
            'reward' => 'required|integer',
            'tag_name' => 'required|string',
            'address' => 'required|string',
            'deadline' => [
                'required',
                'date',
                'after:' . now()->addMinutes(4),
            ],
        ]);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->reward = $validatedData['reward'];
        $post->deadline = $validatedData['deadline'];
        $post->address = $validatedData['address'];
        $post->is_completed = '依頼中';
        $post->save();

        $posttag = new PostTag();
        $posttag->tag_name = $validatedData['tag_name'];
        $posttag->post_id = $post->id;
        $posttag->save();


        return redirect()->route('post.index')->with('success', '投稿が作成されました');
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
