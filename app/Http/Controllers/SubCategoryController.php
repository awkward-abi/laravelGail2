<?php

namespace App\Http\Controllers;
use App\Models\Subcategory;
use App\Models\Category;
use DB;
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

    public function show($id) {
        $categories = Category::where('id', $id)
                                ->with('subcategories') 
                                ->get();
        return response()->json($categories);
    }

    public function destroy($id)
    {
        $subcategory = Subcategory::find($id);

        if (!$subcategory) {
            return response()->json(['message' => 'Subcategory not found']);
        }

        DB::table('category_sub_category')
            ->where('sub_category_id', $id)
            ->delete();

        $subcategory->delete();

        return response()->json(['message' => 'Subcategory deleted successfully']);
    }
    
}
