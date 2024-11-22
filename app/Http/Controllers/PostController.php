<?php

namespace App\Http\Controllers;

// use Storage;
use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    //customer create page
    public function create(){
       //  $posts = Post::orderBy('created_at','desc')->paginate(3);
       // $posts = Post::where('id','<','6')->where('address','=','pyay')->get();
      // $posts = Post::pluck('title');
       //$posts = Post::select('title','price')->get();
      //$posts = Post::where('id','<','6')->get()->random();
       //$posts = Post::orderBy('price','desc')->get();
    //    $posts = Post::select('id','address','price')
    //    ->where('address','bago')
    //    ->whereBetween('price',[3000,5000])
    //    ->orderBy('price','desc')
    //    ->get();

    //$posts = Post::where('address','pyay')->exists();
       // $posts = Post::select('rating',DB::raw('COUNT(rating) as rcount'))->get();

    //   $posts = Post::paginate(5)->through(function($p){
    //     $p->title = strtoupper($p->title);
    //     $p->description = strtoupper($p->description);
    //     $p->price = $p->price *2;
    //     return $p;
    //   });

    //    dd($posts->toArray());

       // dd($_REQUEST['Key']);
        // $searchKey= $_REQUEST['searchKey'];

        // $posts = Post::when($_REQUEST['key'],function($p){
        //     $searchKey  = $_REQUEST['key'];
        //     $p->where('title','like','%'.$searchKey.'%');
        // })->get();
        // dd($posts->toArray());
        // //$posts = Post::where('title','like','%'.$searchKey.'%')->get()->toArray();

        // //dd($posts[0]['title']);
        // dd($posts);
        $posts = Post::when(request('searchKey'),function($query){
            $searchKey = $_REQUEST['searchKey'];
            $query->where('title','like','%'.$searchKey.'%')
            ->orWhere('description','like','%'.$searchKey.'%');
        })->orderBy('created_at','desc')->paginate(3);
        return view('create',compact('posts'));
    }

    //post create
    public function postCreate(Request $request){
        $this->postValidationCheck($request);
        //dd($request->hasFile('postImage')?'yes':'no');
        //dd($request->file('postImage'));
        $response= $this->getPostData($request); //array

        if($request->hasFile('postImage')){
           // $request->file('postImage')->store('myImage');
            $fileName = $request->file('postImage')->getClientOriginalName();
           $request->file('postImage')->storeAs('public',$fileName);
            //$response ထဲကို image တွက်မပါသေးတော့ ထပ်ထဲ့ဖို့
           $response['image']=$fileName;
        }
        Post::create($response); // insert into database
        // return view('create');
        //return back();
        // return redirect()->route('test');
        return redirect()->route('post#createPage')->with(['insertSuccess'=>'Post ဖန်တီးခြင်းအောင်မြင်ပါသည်']);
    }

    public function postDelete($id){
        //first way
        //Post::where('id','=',$id)->delete();
       // return redirect()->route('post#createPage');
        //second way
        $post = Post::find($id)->delete();

       return back();
    }

    //direct update page
    public function updatePage($id){
       $post = Post::where('id',$id)->get()->toArray();
       // $post = Post::where('id',$id)->first()->toArray();
       return view('update',compact('post'));
    }

    //edit page
    public function editPage($id){
        $post = Post::where('id',$id)->get()->toArray();

        return view('edit',compact('post'));
    }

    //update post
    public function update(Request $request){
        //dd($request->all());
        $this->postValidationCheck($request);
        $updateData = $this->getPostData($request);//array
        if($request->hasFile('postImage')){

            //delete
            $oldImage = Post::where('id',$request->postId)->first()->toArray();
            $oldImage = $oldImage['image'];
            if($oldImage != null){

              Storage::delete('public/'.$oldImage);
            }

            $fileName = uniqid().$request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs('public',$fileName);
            $updateData['image']=$fileName;



         }

        $id = $request->postId;
        // dd($id);
        // dd($updateData);
        Post::where('id',$id)->update($updateData);
        return redirect()->route('post#home')->with(['updateSuccess'=>'Update လုပ်ခြင်းအောင်မြင်ပါသည်']);;

    }
    //getupdate data
    // private function getUpdateData($request){
    //     return [
    //         'title'=> $request->updateTitle,
    //         'description' => $request->updateDescription
    //     ];

    // }


    //get post data
    private function getPostData($request){
        $data = [
            'title'=> $request->postTitle,
            'description' => $request ->postDescription,
            'updated_at' =>Carbon::now(),


        ];
        $data['price'] = $request->postFee == null ? 2000 : $request->postFee;
        $data['address'] = $request->postAddress == null ? 'Yangon' : $request->postAddress;
        $data['rating'] = $request->postRating == null ? 3 : $request->postRating;

        return $data;

    }

    //post validation check
    private function postValidationCheck($request){

            $validationMessage= [

                'postTitle.required' => 'post title လိုအပ်သည်။',
                'postDescription.required' => 'post description လိုအပ်သည်။',
                'postTitle.min' => 'must have at lease 3 characters.',
                'postFee.required'=>'post fees ဖြည့်ရန်လိုအပ်သည်',
                'postAddress.required'=>'post Address ဖြည့်ရန်လိုအပ်သည်',
                'postRating.required'=>'post Rating (0 to 5 )ဖြည့်ရန်လိုအပ်သည်',
                'postImage.mimes' => 'image must be Jpg, jpeg, png'
            ];

            Validator::make($request->all(),[
            'postTitle' =>'required|min:3|unique:posts,title',
            'postDescription'=>'required|min:10',

            'postImage' =>'mimes:jpg,jpeg,png|file'
            ],$validationMessage)->validate();

    }

    //eg
    public function eg(){
        return redirect()->route("example
        ");
    }

}
