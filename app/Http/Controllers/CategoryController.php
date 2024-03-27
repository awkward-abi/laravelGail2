<?php

namespace App\Http\Controllers;



use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::create($request->post());
        return response()->json([
            'message' => 'Category Created Succesffully!!',
            'category'=> $category
        
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //return response()->json([]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id ,Request $request)
    {
        $category = Category::where('id', $id)->update([ 
            'title'       => $request["category"]["title"],
            'description' => $request["category"]["description"],
            'updated_at'  => now()
        ]); 
    
        foreach ($request['subcategories'] as $subcat) {
            $subcategories[] = [
                'sub_title' => $subcat['subcategory'],
            ];
        }

        $subCategoryIds = [];

        foreach ($subcategories as $subcat) {
            $subCategoryIds[] = \DB::table('sub_categories')->insertGetId($subcat);
        }

        $category = Category::findOrFail($id);
        $category->subcategories()->attach($subCategoryIds);  
    }
        
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->subcategories()->detach(); 
        $category->delete();

        return response()->json(['message' => 'Category deleted']);
    }

    public function getCategoryTitle(Request $request)
    {
        $data = Category::get();
        return response()->json($data);
    }

    
}
