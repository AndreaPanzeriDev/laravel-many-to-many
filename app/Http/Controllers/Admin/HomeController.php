<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $info_posts = Post::all();
        return view('admin.post.index', compact('info_posts'));
    }
}
