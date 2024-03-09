<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        // Loop through all categories
        foreach ($categories as $key => $category) {
            $categories[$key]['parent_title'] = null; // sa simula palang naka null na toh para maready na mapoppulate ng data  :3 uwu
            // Check if a parent category exists (assuming 'parent_id' field)
            if (isset($category->parent_id)) { //search mo isset (means pag hindi sya empty eto gagawin...)
                $parent = Category::find($category->parent_id); //taga kuha ng category pag may laman based sa isset

                // If parent category is found and has a title
                if ($parent && $parent->title) {
                    $categories[$key]['parent_title'] = $parent->title; // Add 'parent' key with parent title
                } // Set 'parent' to null if parent not found
                
            }
        }
        
        // Return JSON response with the structured parent categories
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
        $category = Category::where('id', $id)->update($request->all());
        return response()->json([
            'message'=>'Category Updated Successfully!!',
            'category'=>$category
        ]);
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

    public function getCategoryTitle(Request $request)
    {
        $data = Category::get();
        return response()->json($data);
    }

    
}
