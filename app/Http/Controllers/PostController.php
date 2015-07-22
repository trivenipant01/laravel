<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;


use App\Post;
use App\Tag;
use App\Log;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;

use Input;
use Response;
use Validator;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
	 public function __construct() {
        $this->beforeFilter('csrf', ['on' => '']);
     }
    public function index()
    {
        try{
           $posts = Post::with('tags')->get(); // returns a Collection of Post models
		   $statusCode = 200;
	    }catch (Exception $e){
           $statusCode = 400;
		}finally{
			return Response::json($posts, $statusCode);
		}


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
      return view('posts.create');
	  
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
	//die('hi');
      //print_r($request->all());
       $validation = Validator::make($request->all(),[ 
        'name' => 'required',
        'slug' => 'required|unique:posts',
		'body' => 'required',
     ]);

	   try {
	   if(!$validation->fails()){
			$newpost=Post::create(array(
				'name' => $request->get('name'),
				'slug' => $request->get('slug'),
				'body' => $request->get('body')
			));
			//print_r($newpost);
			if($newpost){
			   $admin_email=config('constants.ADMIN_EMAIL');
			   $admin_name=config('constants.ADMIN_NAME');
			   $website_email=config('constants.WEBSITE_EMAIL');
			   $message="New post created";
			   $data=array();
			   Mail::send('emails.welcome', $data, function($message) use ($data)
               {
                $message->from(config('constants.ADMIN_EMAIL'), config('constants.ADMIN_NAME'));
                $message->subject("New post added");
                $message->to(config('constants.ADMIN_EMAIL'));
               });
			   return Response::json(array('success' => true, 'last_insert_id' => $newpost->id), 200);
            
			}else{
			    return Response::json(array('success' => false, 'message' => 'there is some error'), 200);
			}
		}else{
            $errors = $validation->errors();
			return $errors->toJson();
			//return Response::json(array('success' => true, 'message' => 'there is some error'), 200);
		}
        }catch (HttpException $exception) {
		   //die('hh');
           $response = $exception->getMessage();
           $status   = $exception->getStatusCode();
		   return Response::json(array('success' => false, 'message' => $response), $status);
       }
      

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
	//$id=1;
      $page = Post::with('tags')->where('id', $id)->get();

        return Response::json(array(
            'status' => 'success',
            'pages' => $page->toArray()),
            200
        ); 
		}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        echo "this is edit";
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $input = Input::all();

        $post = Post::find($id);

        if ( isset($input['name']) ) {
            $post->name =$input['name'];
        }
        if ( isset($input['slug']) ) {
            $post->slug =$input['slug'];
        }
        if (isset($input['body']) ) {
            $post->body =$input['body'];
        }
        $post->save();

        return Response::json(array(
            'error' => false,
            'message' => 'Post Updated'),
            200
        );
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
       try{
	       $page = Post::find($id);
		   //if($page){
            $name="Post Id:".$page->id."| deleted";
			$data=array();
			$data['id']=$page->id;
			$data['name']=$page->name;
			$data['body']=$page->body;
			$data=serialize($data);
			if($page->delete()){
			   $log=new Log;
			   $log->action=$name;
			   $log->data=$data;
			   $log->save();
			   $response="Post Deleted";
			}else{
			  $response="Post Can not be delted at this time";
			}
			
		   //}else{
		     //$response="Post Not found";
		   //}
		   
       }catch (Exception $e) {
	       $response = $exception->getMessage();
           $status   = $exception->getStatusCode();
	  }finally{
			return Response::json(array(
            'error' => false,
            'message' => $response),
            200
        );
	  }
	   
    }
}
