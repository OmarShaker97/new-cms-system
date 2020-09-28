<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;


use App\Post;

class PostController extends Controller
{
    public function show(Post $post){

        return view('blog-post', ['post'=>$post]);
    }

    
    public function create(){

        
        $this->authorize('create', Post::class);

        return view('admin.posts.create');
    }

    public function store(Request $request){

        
        $this->authorize('create', Post::class);

        $inputs = request()->validate([
            'title'=>'required | min:8 | max:255',
            'post_image' => 'file',
            'body' => 'required'
        ]);

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images', 'public');
        }

        auth()->user()->posts()->create($inputs);

        session()->flash('post-create-message', 'Post was created successfully!');

        return redirect()->route('post.index');
        
    }

    public function index(){

        // $posts = Post::all();

        $posts = auth()->user()->posts()->paginate(5);

        Session::flash('message', 'Post was deleted');

        return view('admin.posts.index', ['posts' => $posts]);

    }

    public function edit(Post $post){

        $this->authorize('view', $post);

        return view('admin.posts.edit', ['post'=>$post]);

    }

    public function delete(Post $post, Request $request){

        // dd($post);

        $post->delete();

        session()->flash('post-delete-message', 'Post was deleted');

        return back();
    }

    public function update(Post $post){

        $inputs = request()->validate([
            'title'=>'required | min:8 | max:255',
            'post_image' => 'file',
            'body' => 'required'
        ]);
        
        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images', 'public');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $this->authorize('update', $post);

        $post->update();

        session()->flash('post-update-message', 'Post was updated!');
        
        return redirect()->route('post.index');
    }

}