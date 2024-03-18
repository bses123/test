<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('blog.index',[
        'posts'=>Post::orderBy('updated_at','desc')->paginate(5)
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
     {   $request->validated();

        Post::create([
           'title'=>$request->title,
           'excerpt'=>$request->excerpt,
           'body'=>$request->body,
          'image_path'=>$this->storeImage($request),
          'is_published'=>$request->is_published==='on',
          'min_to_read'=>$request->min_to_read
        ]);
        return redirect(route('blog.index'));
     

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('blog.show',[
          'post'=>Post::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('blog.edit',[
          'post'=>Post::where('id',$id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $request, $id)
    {
       $request->validated();
       $post=Post::find($id);
       $post->title=$request->title;
       $post->excerpt=$request->excerpt;
       $post->body=$request->body;
       
       $post->is_published=$request->is_published==='on';
      
       if ($request->hasFile('image_path')){
        $post->image_path = $this->storeImage($request);
       }
       
       
       $post->save();

      
  
      //  Post::where('id',$id)->update($request->except('_token', '_method'));
   

       
       return redirect(route('blog.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect(route('blog.index'))->with('status','The blog is deleted');
    }

    private function storeImage($request){
    
      $extension = $request->image_path->extension();
      $newImageName = uniqid().'.'.$extension;
     return $request->image_path->move(public_path('images'), $newImageName);

    
    }
}
