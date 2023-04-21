<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $posts = POST::withTotalVisitCount()->get();
        if (!$userId)
            $posts = POST::where(['price' => 0])->withTotalVisitCount()->get();

        $count = Cache::remember(
            'count.posts.' . $userId,
            now()->addSeconds(30),
            function () use ($posts) {
                return Post::count();
            }
        );
        return view('posts.index', ['posts' => $posts, 'count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostFormRequest $request)
    {
        //
        $request->validated();
        $file = $request->file('image');
        $path = $file->store('uploads');

        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $path,
            'price' => $request->price,
        ]);

        return response()->json(['message' => 'Post Created Successfully'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $comments = $post->comments;
        $user = $post->user;
        return view('posts.post', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
    }
}
