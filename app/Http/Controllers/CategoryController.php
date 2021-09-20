<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // getting category list 
        $CategoryList=Category::paginate(10);
        
        return view('Category/category-list',['categorylist'=>$CategoryList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $CategoryData=Category::all();
        return view('Category/category-add',['category_data'=>$CategoryData]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation logic start from here 
        $attributeNames = array(
           'parent_id' => 'Parent Category',
           'name' => 'Name'     
        );
        Validator::make($request->all(), [
            'name' => 'required|max:255|unique:categories,name',
            'status' => 'required' 
        ])->setAttributeNames($attributeNames)->validate();

        try {
            // Finding User from table to update user data 
            $category = new Category;
            if($category){
                //Preparing parameters going to update 
                $category->name = $request->name;
                $category->parent_id = $request->parent_id;
                $category->status = $request->status;
                // updating data 
                
                $category->save();
                $request->session()->flash('success', 'Category added successfully!');

            }else{
                $request->session()->flash('error', 'Opps! Something went wrong');      
            }
        }catch(\Illuminate\Database\QueryException $e){
            $request->session()->flash('error', 'Opps! Something went wrong');  
        }
    
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        // get edit category data 
        $UpdatedCategory = Category::where('id', $id)->get();
        // getting all categories data 
        $CategoryData=Category::all();
    
        return view('Category/category-edit',['category_data'=>$CategoryData,'updated_category'=>$UpdatedCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation logic start from here 
        $attributeNames = array(
           'parent_id' => 'Parent Category',
           'name' => 'Name'     
        );
        Validator::make($request->all(), [
            'name' => ['required','max:255',Rule::unique('categories')->ignore($id)],
            'status' => 'required' 
        ])->setAttributeNames($attributeNames)->validate();

        try {
            // Finding Category from table to update user data 
            $category = Category::find($id);
            if($category){
                //Preparing parameters going to update 
                $category->name = $request->name;
                $category->parent_id = $request->parent_id;
                $category->status = $request->status;
                // updating data 
                
                $category->save();
                $request->session()->flash('success', 'Category updated successfully!');

            }else{
                $request->session()->flash('error', 'Opps! Something went wrong');      
            }
        }catch(\Illuminate\Database\QueryException $e){
            $request->session()->flash('error', 'Opps! Something went wrong');  
        }
    
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        try {
            Category::destroy($id);
            $request->session()->flash('success', 'Category deleted successfully!');
        }catch(\Illuminate\Database\QueryException $e){
            $request->session()->flash('error', 'Opps! Unable to delete this Category');  
        }

        return redirect()->route('category.index');
    }
}
