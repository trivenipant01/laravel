<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use App\Tag;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;

use Input;
use Response;
use Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try{
           $posts = Tag::get(); // returns a Collection of Post models
		    //print_r($posts);
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
         $validation = Validator::make($request->all(),[ 
               'name' => 'required|unique:tags',
        ]);

	   try {
	   if(!$validation->fails()){
			$newtag=Tag::create(array(
				'name' => $request->get('name'),
			));
			//print_r($newpost);
			if($newtag){
			   $admin_email=config('constants.ADMIN_EMAIL');
			   $admin_name=config('constants.ADMIN_NAME');
			   $website_email=config('constants.WEBSITE_EMAIL');
			   $message="New tag created";
			   $data=array();
			   Mail::send('emails.welcome', $data, function($message) use ($data)
               {
                $message->from(config('constants.ADMIN_EMAIL'), config('constants.ADMIN_NAME'));
                $message->subject("New tag added");
                $message->to(config('constants.ADMIN_EMAIL'));
               });
			   return Response::json(array('success' => true, 'last_insert_id' => $newtag->id), 200);
            
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
        $tag = Tag::where('id', $id)
                    ->take(1)
                    ->get();

        return Response::json(array(
            'status' => 'success',
            'tag' => $tag->toArray()),
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
        //
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

        $tag = Tag::find($id);

        if ( isset($input['name']) ) {
            $tag->name =$input['name'];
        }
        $tag->save();

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
	       $tag = Tag::find($id);
		    if($tag->delete()){
			   $response="Tag Deleted";
			}else{
			  $response="Tag Can not be delted at this time";
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
