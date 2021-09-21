<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // getting product list 
        $ProductList=Product::paginate(10);
        
        return view('Product/product-list',['productlist'=>$ProductList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $CategoryData=Category::all();
        return view('Product/product-add',['category_data'=>$CategoryData]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $user_id = $user->id;
         // Validation logic start from here 
        $attributeNames = array(
           'category_id' => 'Category',
           'title' => 'Title'     
        );
        Validator::make($request->all(), [
            'title' => 'required|max:255|unique:products,title',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
            'status' => 'required' 
        ])->setAttributeNames($attributeNames)->validate();

        try {
            // Finding User from table to update user data 
            $product = new Product;
            if($product){
                //Preparing parameters going to update 
                $product->title = $request->title;
                $product->price = $request->price;
                $product->user_id =$user_id;
                $product->quantity = $request->quantity;
                $product->category_id = $request->category_id;
                $product->status = $request->status;
                // updating data 
                
                $product->save();
                $request->session()->flash('success', 'Project added successfully!');

            }else{
                $request->session()->flash('error', 'Opps! Something went wrong');      
            }
        }catch(\Illuminate\Database\QueryException $e){
            $request->session()->flash('error', 'Opps! Something went wrong');  
        }
    
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        try {
            Product::destroy($id);
            $request->session()->flash('success', 'Category deleted successfully!');
        }catch(\Illuminate\Database\QueryException $e){
            $request->session()->flash('error', 'Opps! Unable to delete this Category');  
        }

        return redirect()->route('product.index');
    }
}
