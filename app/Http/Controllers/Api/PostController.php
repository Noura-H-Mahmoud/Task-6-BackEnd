<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    use ApiResponseTrait;
    public function index(Request $request)
    {
        $categories=Category::all();
        $request->validate([
            'category_id' =>['integer'],
           ]);
           $q=Category::query();
    if ($request->category_id)
        $q->where('category_id',$request->category_id);
        $categories=$q->get();
        return CategoryResource::collection($categories);
    }
    public function show($id){
        // $post= Post::find($id);
        $post=Post::find($id);
        if($post){
            return $this->apiResponse(new PostResource ($post),'ok',200); 
        }
        return $this->apiResponse(null,'This Post Not Found',404);
    }
    public function store(StorePostRequest $request){
        $post =Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(), 
        ]);
        if($post){
            return $this->apiResponse(new PostResource ($post),'The Post Save',201); 
        }
        return $this->apiResponse(null,'This Post Not Saved',400);
    }
    
    public function update(UpdatePostRequest $request,$id){
        $post=Post::find($id);
        if(!$post){
            return $this->apiResponse(null,'This Post Not Found',404);  
        }
        if ($post->user_id != auth()->id()) {
            return $this->apiResponse(null, 'You are not authorized to update this post', 403);
        }
        $post ->update($request->all());
        if($post){
            return $this->apiResponse(new PostResource ($post),'The Post Update',201); 
        }
    }
    public function destroy($id){
        $post = Post::find($id);
        if (!$post) {
            return $this->apiResponse(null, 'This Post Not Found', 404);  
        }
        if ($post->user_id != auth()->id()) {
            return $this->apiResponse(null, 'You are not authorized to delete this post', 403);
        }
        $post->delete();
        return $this->apiResponse(null, 'The Post Deleted', 200);
    }
}
