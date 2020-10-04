<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Post;

use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $posts = Post::paginate(15);
        $categories = Category::paginate(3);

        return view('home', compact(['posts','categories']));
    }

    public function displayCategory(Category $category){
        $posts = Post::where('category_id', '=', $category->id)->paginate(15);
        $categories = DB::table('categories')->paginate(3, ['*'], 'categories');

        return view('home', compact(['posts','categories']));
    }
}
