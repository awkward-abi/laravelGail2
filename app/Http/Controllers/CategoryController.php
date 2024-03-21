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
            'title' => $request["category"]["title"],
            'description' => $request["category"]["description"],
            'updated_at' => now()
        ]); 
    
        //saving for the subcategory 
            foreach ($request['subcategories'] as $subcat) {
                $subcategories[] = [
                    'sub_title' => $subcat['subcategory'],
                    'created_at' => now()
                ];
            }
        SubCategory::insert($subcategories);
            //code review ko maya
            $category = Category::findOrFail($id);
            $subcategoriesId = SubCategory::pluck('id');
            // Retrieve the subcategory instances
            $subcategories = SubCategory::find($subcategoriesId);
            // Attach subcategories to the category
            $category->subcategories()->attach($subcategories->pluck('id'));  
    }
        

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id)->delete();
        return response()->json([
            'message'=> 'Why mo naman delete? :(',
            ]);
    }


    //
    public function destroySubCategory($categoryId, $subcategoryId) {
        dd($categoryId, $subcategoryId);
        // $category->subcategories()->detach($subcategory->id);
        // return response()->json();
      }
      
    

    public function getCategoryTitle(Request $request)
    {
        $data = Category::get();
        return response()->json($data);
    }

    public function showSubCategories($id){
        $categories = Category::where('id', $id)
                                ->with('subcategories') 
                                ->get();
        return response()->json($categories);
    }

    
}
