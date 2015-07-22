<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function showProfile($id)
    {
       $page = Post::find(4);
	   echo $page->name;
	   $ar=$page;
	   $ar->toArray();
	   print_r($ar);
	  // die;
	    $posts = Post::find(1)->tags->toArray();
		print_r($posts);
		$tags = ['zf2','yii'];
		$posts = Post::whereHas('tags', function($q) use ($tags)
		{
			$q->whereIn('name', $tags);
		})->get();
		$ids = $posts->count();
	    print_r($ids);
	    die;
		return view('user.profile');
    }
}
?>