<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreatePostMail;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $info_posts = Post::all();
        return view('admin.post.index', compact('info_posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.post.ipoteticocreate', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);


        if (array_key_exists('image', $data)) {
            $url_image = Storage::put('post_image', $data['image']);
            $data['image'] = $url_image;

        }

        $new_record = new Post();
        $new_record->fill($data);
        $new_record->save();

        //rivedire
        if (array_key_exists('tags', $data)) {
            $new_record->tags()->sync($data['tags']);
        }

        $mail= new CreatePostMail($new_record);
        $dexter = Auth::user()->email;
        //dd($dexter);
        Mail::to($dexter)->send($mail);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $single_post = Post::findOrFail($id);

        return view('admin.post.ipoteticoshow', compact('single_post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $file = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.ipoteticoedit', compact('file', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $infoP = $request->all();
        $post = Post::findOrFail($id);
        $post->update($infoP);

        if (array_key_exists('tags', $infoP)) {
            $post->tags()->sync($infoP['tags']);
        } else {
            $post->tags()->sync([]);
        }



        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postToDelete = Post::findOrFail($id);
        if($postToDelete->image){
            Storage::delete($postToDelete->image); // comando per eliminarlo dal computer/server
        }
        $postToDelete->tags()->sync([]);
        $postToDelete->delete();

        return redirect()->route('admin.index');
    }
}
