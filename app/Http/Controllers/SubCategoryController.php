<?php

namespace App\Http\Controllers;
use App\Models\Subcategory;
use App\Models\Category;

use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index($id){
        $categories = Category::where('id',$id)
                ->with('subcategories') 
                ->get();
        return response()->json($categories);
    }

    public function getCategoryTitle(Request $request)
    {
        $data = Subcategory::get();
        return response()->json($data);
    }
    
}
