<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Models\Post;

class PostController extends Controller
{
    //


    public function index()
    {
        $posts = auth()->user()->posts()->paginate(5);
        // $posts = Post::all();
        return view('admin.posts.index',['posts'=>$posts]);
    }

    // public function index()
    // {
    //      return view('blog-post');
    // }

    // public function show($id)
    // {
    //     dd($id);
        
    //     return view('home');
    // }

    public function show(Post $post)
    {    
        return view('blog-post',['post'=>$post]);
    }

    public function create()
    {
        $this->authorize('create',Post::class);
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        // auth()->user();

        $this->authorize('create',Post::class);

        $inputs =$request->validate
        ([
            'title'=>'required|min:8|max:255',
            'post_image'=>'file',
            'body'=>'required'
        ]);
        if(request('post_image'))
        {
            $inputs['post_image'] = request('post_image')->store('images');
        }

        // dd($request->input('post_image'));

        auth()->user()->posts()->create($inputs);

        Session::flash('post-created-message','Post with title '.$inputs['title']  .' has been created');

        return redirect()->route('post.index');

        // dd(request()->all());
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        
        $post->delete();
        Session::flash('message','Post has been deleted');
        return back();
    }

    public function edit(Post $post)
    {
        $this->authorize('view',$post);

        return view('admin.posts.edit',['post'=>$post]);
    }

    public function update(Post $post)
    {
        auth()->user();

        $inputs =request()->validate
        ([
            'title'=>'required|min:8|max:255',
            'post_image'=>'file',
            'body'=>'required'
        ]);

        if(request('post_image'))
        {
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }
        Session::flash('post-updated-message','Post with title '.$inputs['title']  .' has been updated');

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $this->authorize('update', $post);

        return redirect()->route('post.index');
        // dd($request->input('post_image'));
        auth()->user()->posts()->save($post);

    }

   


}
