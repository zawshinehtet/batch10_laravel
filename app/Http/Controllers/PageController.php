<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; //namespace
use App\Category;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{

 public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);    //login winn lr ma win lar sisss twar kwint shi ma shi (construct sa run dal)
                                        //create and stoue method pal ma load chin dr
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()        //post table htal ka data twe ko swal htode  //read
    {
        //
        $posts = Post::orderBy('title','desc')->get();  //title ka Z to A por mal

        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()                //get route ka 
    {
        $categories = Category::all();                   //category model ko help taung     HTODE DR (array htewt)
        // dd($categories);
        //
        //echo 'Call View of Create Form Here!';
        return view('post.createform',compact('categories'));   //data ko view si po yin (compact) // view bat ka $ nat catch

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)      //post route ka     
    {
        //
        // dd($request); form input ka name nat siss ''=>''
        //Validation
        $request->validate([
            'title' => 'required|min:5',
            'content' => 'required|min:10',
            'photo' => 'required|mimes:jpeg,png',
            'category' => 'required'
        ]);
        //upload file
        if($request->hasfile('photo')){
            $photo = $request->file('photo');
            $name =  time().'.'.$photo->getClientOriginalExtension();                       ;
            $photo->move(public_path().'/storage/image/',$name);
            $photo = '/storage/image/'.$name;
        }else{
            $photo = '';
        }

        //data insert into post table(obj saut pi htat)
        $post = new Post();
        $post->title =  request('title');             //model htal ka fillable() htal ka key lay twe (yellow)
        $post->body = request('content');               //posttable colname=request('yellow')
        $post->image = $photo;
        $post->category_id = request('category');
        $post->user_id = Auth::id();                         
        //$post->status = true ;
        $post->save();

        // Redriect  (pyan nhyon dat nay yar)
        return redirect()->route('firstpage');//route name in webphp

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)           //detail readmore ko click yin id pr lar lo d mhar la $id nat auto pr
    {
        //
        $post = Post::find($id);      //table id nat siss      //find() method ka condition sis pay dr (database htal ka swal htode dr)
        // $post = Post::where('status',1)->first();
        return view('post.detail',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);    //old data value htat pay dr
        $categories = Category::all();//edit form mhr looping pat htar lo
        return view('post.edit',compact('categories','post'));//ho form bat ka $categories $post lo pyan call
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)           //form ka new data ka $request
    {
        //
        //dd($request);
         //Validation
        $request->validate([
            'title' => 'required|min:5',
            'content' => 'required|min:10',
            'photo' => 'sometimes|required|mimes:jpeg,png',   //photo ma choice la ya dl (sometimes|)
            'category' => 'required'
        ]);
        
        if($request->hasfile('photo')){
            $photo = $request->file('photo');
            $name =  time().'.'.$photo->getClientOriginalName();                         //$photo->getClientOriginalName();
            $photo->move(public_path().'/storage/image/',$name);
            $photo = '/storage/image/'.$name;
        }else{
            $photo = request('oldphoto');
        }

        //data Update
        // $post = new Post($id);           //d lo lal update loat lo ya dl
        $post =  Post::find($id);       //edit form ka pay lite dat id 
        $post->title =  request('title');             
        $post->body = request('content');             
        $post->image = $photo;
        $post->category_id = request('category');
        $post->user_id = Auth::id();
        
        $post->save();

        
        return redirect()->route('firstpage');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
        $post = Post::find($id);
        $post->delete();
        // redirect
        return redirect()->route('firstpage');
    }
}
