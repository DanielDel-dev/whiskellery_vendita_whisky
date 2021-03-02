<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();
        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('post.create', compact('tags','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create([
            'title'=> $request->input('title'),
            'body'=> $request->input('body'),
            'category_id'=> $request->input('category_id'),
            'price'=>$request->input('price'),
            'user_id' => Auth::id()
            ]);
            $tags=$request->input('tags');
            foreach ($tags as $tag) {
                $post->tags()->attach($tag);
            }
            $images=$request->file('images');
            foreach ($images as $image) {
                $path = $image->store('/public/img');
                $img=Image::create([
                    'url'=>$path,
                    'post_id'=>$post->id
                    ]);
                    
            }

            return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $posts = Post::all();
        $relatedPost = $posts->filter(function($el)use($post){
            return $el->category_id == $post->category->id;
        });
        
        return view('post.show',compact('post','relatedPost'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $tagsId = $post->tags->map(function($el){
            return $el->id;
        });
        return view('post.edit',compact('post','categories','tags','tagsId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->all());

        $postTags=$post->tags;

        $requestTags=collect($request->input('tags'));
        $requestTags->each(function($tag) use($postTags,$post){
            if (!$postTags->contains($tag)) {
                $post->tags()->attach($tag);
            }
        });

        return redirect(route('admin'))->with('message',"Post $post->title has been successfully modified");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect(route('admin'))->with('message',"Post $post->title has been successfully cancelled");
    }
    public function story()
    {
        return view('post.story');
    }
    public function contact()
    {
        return view('post.contact');
    }

    public function admin()
    {
        $posts = Post::orderBy('id','desc')->get();

        return view('admin', compact('posts'));
    }

    public function addComment($id, Request $request)
    {
        
        $post = Post::find($id);
        $comment = $post->comments()->create([
            'comment'=>$request->input('comment'),
            'user_id' => Auth::id()
        ]);


        return redirect(route('post.show',$post,$id));
    }


}
