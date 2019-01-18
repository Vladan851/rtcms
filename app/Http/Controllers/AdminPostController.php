<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Photo;
use App\Http\Requests\PostCreateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Category;
use App\Comment;
use App\CommentReplay;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$posts = Post::all();
        
        $posts = Post::all();
        
        //return response()->json($posts, 200);
        return view('admin.posts.index', compact('posts'));
    }
    
    public function getPosts()
    {
        //
        //$posts = Post::all();
        
        $posts = Post::paginate(10);
        
        return response()->json($posts);
        
        
        //return array('posts' => $posts);
        
       //return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       $cat = Category::pluck('name', 'id')->all();

        //$cat = [0, 1, 2];
        
        return view('admin.posts.create', compact('cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        //       
        $input = $request->all();
        
        $input['url'] = '/'.$this->slug($input['title']);
        
        $input['count'] = 0;
        
        if($file = $request->file('photo_id')){
            
            $path = time().$file->getClientOriginalName();
            
            $file->move('images', $path);
            
            $photo = Photo::create(['path'=>$path]);
            
            $input['photo_id'] = $photo->id;
            
        }

        $user = Auth::user();
        
        $user->posts()->create($input);
        
        Session::flash('alert-success', 'The post has been created.');
        
        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('admin.posts.show');
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
        $post = Post::findOrFail($id);
        
        $cat = Category::pluck('name', 'id')->all();
        
        return view('admin.posts.edit', compact('post','cat'));
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
        //
        $input = $request->all();
        
        if($file = $request->file('photo_id')){
            
            $path = time().$file->getClientOriginalName();
            
            $file->move('images', $path);
            
            $photo = Photo::create(['path'=>$path]);
            
            $input['photo_id'] = $photo->id;
            
        } 
        
        $input['user_id'] = Auth::user()->id;
        
        $post = Post::findOrFail($id);
        
        $post->update($input);
        
        //Ako hocemo da samo onaj user koji je unio post moze da ga i edituje i obrise
       // Auth::user()->posts()->whereId($id)->first()->update($input);
        
        Session::flash('alert-success', 'The post has been updated.');
        
        return redirect('/admin/posts');
        
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
        $post = Post::findOrFail($id);
        
        if($post->photo){
            
            unlink(public_path() . $post->photo->path);
        
        }
        
        $photo = Photo::where('id', $post->photo_id);
        
        $photo->delete();
        
        $post->delete();        
        
        Session::flash('alert-danger', 'The post has been deleted.');
        
        return redirect('/admin/posts');
    }
    
    //rucno pravljenje slugga u kontroleru
    function slug($str){
        
        $table = array(
        'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
        'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
        'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
        'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
        'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
        'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
        'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
        'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r',
        );

        $str = strtr($str, $table);
        
	$str = strtolower(trim($str));
	$str = preg_replace('/[^a-z0-9-]/', '-', $str);
	$str = preg_replace('/-+/', "-", $str);
	return $str;
    }
    
    public function post($slug){
        
        //$post = Post::findOrFail($id);
        
        $post = Post::findBySlugOrFail($slug);
        
        
        $comments = $post->comments->where('is_active',1);
        
        $cats = Category::all();
                
        return view('post', compact('post', 'cats', 'comments', ''));
        
    }
    
}
