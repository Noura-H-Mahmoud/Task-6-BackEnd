<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $categories=CategoryResource::collection(Category::get());
        return $this->apiResponse($categories,'ok',200);
    }
    public function show($id){
        $category=Category::find($id);
        if($category){
            return $this->apiResponse(new CategoryResource ($category),'ok',200); 
        }
        return $this->apiResponse(null,'This Category Not Found',404);
    }
    public function store(StoreCategoryRequest $request){
        $category =Category::create($request->all());
        if($category){
            return $this->apiResponse(new CategoryResource ($category),'The Category Saved',201); 
        }
        return $this->apiResponse(null,'This Category Not Saved',400);
    }
    public function update(UpdateCategoryRequest $request, $id){
        $category=Category::find($id);
        if(!$category){
            return $this->apiResponse(null,'This Category Not Found',404);  
        }
        $category ->update($request->all());
        if($category){
            return $this->apiResponse(new CategoryResource ($category),'The Category Updated',201); 
        }
    }
    public function destroy($id){
        $category=Category::find($id);
        if(!$category){
            return $this->apiResponse(null,'This Category Not Found',404);  
        }
        $category->delete();
        if($category){
            return $this->apiResponse(null,'The Category Deleted',200); 
        }  
    }
}
