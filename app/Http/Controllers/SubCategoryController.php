<?php

namespace App\Http\Controllers;
use App\Models\Subcategory;

use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(){
        $subcategories = SubCategory::all();
        return response()->json($subcategories);
    }

    public function getCategoryTitle(Request $request)
    {
        $data = Subcategory::get();
        return response()->json($data);
    }
    
}
