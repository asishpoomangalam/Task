<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$products=Product::all();
		
		return view('admin.products.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('admin.products.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$product=new Product;
		if($files=$request->file('image')){
        request()->validate([

            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();

        request()->image->move(public_path('images'), $imageName);
		$product->image=$imageName;
		}		
		
		$product->title=$request->input('title');
		$product->description=$request->input('description');
		
		$product->price=$request->input('price');
		$product->qty=$request->input('qty');
		
		$product->save();
		
		return redirect('/products')->with('status','Data added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$product=Product::findOrfail($id);
		return view('admin.products.edit')->with('product',$product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$product=Product::find($id);
		if($files=$request->file('image')){
        request()->validate([

            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();

        request()->image->move(public_path('images'), $imageName);
		$product->image=$imageName;
		}	
		if($request->input('remove')=="Y")
		{
		$path = public_path()."/images/".$product->image;
		unlink($path);
		$product->image="";
		}	
		
		$product->title=$request->input('title');
		$product->description=$request->input('description');
		
		$product->qty=$request->input('qty');
		$product->price=$request->input('price');
		
		$product->update();
		
		return redirect('/products')->with('status','Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$product=Product::findOrfail($id);
		
		$product->delete();
		return redirect('/products')->with('status','Data deleted successfully.');
    }
}
