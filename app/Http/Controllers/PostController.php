<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
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
        if (Auth::user())
            return view('posts.index', ['posts' => $posts, 'count' => $count]);
        else
            return view('guest-posts.index', ['posts' => $posts, 'count' => $count]);
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
        $request->validated();
        $file = $request->file('image');
        $path = $file->store('/public/uploads');
        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $path,
            'price' => $request->price,
        ]);

        session()->flash('success', 'Image uploaded successfully!');
        return redirect("/posts");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $id = $post->id;
        $post = Post::where('id', $id)->withTotalVisitCount()->first();
        $comments = $post->comments;
        if ($comments->isNotEmpty()) {
            $comments = $comments->toQuery()->latest()->get();
        }
        $post->visit()->customInterval(now()->addSeconds(30))->withIp()->withUser();
        if (Auth::user())
            return view('posts.post', compact('post', 'comments'));
        else if (!$post->price > 0)
            return view('guest-posts.post', compact('post', 'comments'));
        else
            return redirect("/");
    }

    /**
     * Display the posts from logged in user.
     */
    public function myPost()
    {
        if (!Auth::user())
            return redirect('/');
        $posts = Post::where('user_id', Auth::id())->withTotalVisitCount()->get();
        return view("dashboard")->with('posts', $posts);
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
    public function destroy(Post $post)
    {
        if (Auth::id() == $post->user->id) {
            $post->delete();
            return redirect('/posts');
        } else {
            die('Delete Failed');
        }
    }
}
