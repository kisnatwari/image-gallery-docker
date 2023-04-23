<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $posts = POST::withTotalVisitCount()->paginate(12);
        if (!$userId)
            $posts = POST::where(['price' => 0])->withTotalVisitCount()->paginate(12);

        Cache::remember(
            'count.posts.' . $userId,
            now()->addSeconds(30),
            function () use ($posts) {
                return Post::count();
            }
        );
        if (Auth::user())
            return view('posts.index', ['posts' => $posts]);
        else
            return view('guest-posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('posts.create');
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
        return redirect("/");
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
        $posts = Post::where('user_id', Auth::id())->withTotalVisitCount()->paginate(12);
        return view("dashboard")->with('posts', $posts);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::where('user_id', Auth::id())->find($id);
        if (!$post)
            return redirect("/");
        return view("posts.edit")->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => "required|min:1",
            'description' => "required|min:1",
            'price' => "required|numeric"
        ]);
        $post = Post::where('user_id', Auth::id())->find($id);
        if (!$post) {
            return redirect("/");
        }
        $oldImagePath = $post->image_path;
        if ($request->file('image')) {
            $file = $request->file('image');
            $path = $file->store('/public/uploads');
            Storage::delete($oldImagePath);
            $post->image_path = $path;
        }
        $post->title = $request->title;
        $post->description = $request->description;
        $post->price = $request->price;
        $post->save();

        return redirect("/dashboard");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (Auth::id() == $post->user->id) {
            $imagePath = $post->image_path;
            $post->delete();/* 
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            } */
            return redirect('/');
        } else {
            die('Delete Failed');
        }
    }


    public function showTrash()
    {
        if (!auth()->check())
            return redirect('/');
        $posts = Post::where('user_id', Auth::id())->onlyTrashed()->get();
        return view("trash")->with('posts', $posts);
    }

    public function forceDelete($id)
    {
        $post = Post::where(['user_id' => Auth::id()])->onlyTrashed()->find($id);
        $imagePath = $post->image_path;
        if ($post) {
            if (Storage::exists($imagePath))
                Storage::delete($imagePath);
            $post->forceDelete();
        }
        return redirect()->back();
    }

    public function restore($id)
    {
        $post = Post::where(['user_id' => Auth::id()])->onlyTrashed()->find($id);
        if ($post)
            $post->restore();
        return redirect()->back();
    }
}
