<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Category;
use App\Comment;

class PostController extends Controller
{
    public function show(Post $post){
        $comments = Comment::where('post_id', $post->id)->get();
        return view('blog-post', compact('post','comments'));
    }

    
    public function create(){

        
        $this->authorize('create', Post::class);

        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request){
        
        $this->authorize('create', Post::class);

        //dd($request);

        $inputs = request()->validate([
            'title'=>'required | min:8 | max:255',
            'post_image' => 'file',
            'body' => 'required',
            'category_id' => 'required'
        ]);

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
            request('post_image')->move('images', $inputs['post_image']);
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

        $categories = Category::all();

        return view('admin.posts.edit', ['post'=>$post, 'categories'=>$categories]);

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
            'body' => 'required',
            'category_id' => 'required'
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
