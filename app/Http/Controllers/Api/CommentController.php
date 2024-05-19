<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    use ApiResponseTrait;
    public function index(Request $request)
    {
        $comments=Comment::all();
        $request->validate([
            'post_id' =>'integer|required',
           ]);
           $q=Comment::query();
    if ($request->post_id)
        $q->where('post_id',$request->post_id);
        $comments=$q->get();
        return CommentResource::collection($comments);
    }
    public function store(StoreCommentRequest $request){
        $comment = Comment::create([
            'body' => $request->body,
            'post_id' => $request->post_id,
            'user_id' => Auth::id(), 
        ]);
    
        if($comment){
            return $this->apiResponse(new CommentResource ($comment),'The Comment Saved',201); 
        }
    
        return $this->apiResponse(null,'This Comment Not Saved',400);
    }    
    public function update(UpdateCommentRequest $request,$id){
        $comment=Comment::find($id);
        if(!$comment){
            return $this->apiResponse(null,'This Comment Not Found',404);  
        }
        if ($comment->user_id != auth()->id()) {
            return $this->apiResponse(null, 'You are not authorized to update this Comment', 403);
        }
        $comment ->update($request->all());
        if($comment){
            return $this->apiResponse(new CommentResource($comment),'The Comment Update',201); 
        }
    }
    public function destroy($id){
        $comment=Comment::find($id);
        if(!$comment){
            return $this->apiResponse(null,'This Comment Not Found',404);  
        }
        if ($comment->user_id != auth()->id()) {
            return $this->apiResponse(null, 'You are not authorized to delete this Comment', 403);
        }
        $comment->delete();
        if($comment){
            return $this->apiResponse(null,'The Comment Deleted',200); 
        }  
    }
}
