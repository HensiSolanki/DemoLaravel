<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Products\StoreProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::select(
                'products.id',
                'products.image',
                'products.product_name',
                'products.description',
                DB::raw("products.image AS image_thumb_url"),
                'users.username'
            )->join('users', 'users.id', '=', 'products.user_id');

            return Datatables::of($products)
                ->make(true);
        }
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {

            $image = $request->file('image')->store('products');
            $filename = basename($image);
            $img = Image::make($request->file('image'))->resize(150, 150, function ($const) {
                $const->aspectRatio();
            })->save();
            Storage::put('products/thumbnails/' . $filename, $img);
            $products = new Product;
            $products->image = $filename;
        }
        $products->product_name = $request->name;
        $products->description = $request->detail;
        $products->user_id = $request->user()->id;
        $products->save();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::find($id);
        return view('admin.product.show', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::find($id);
        return view('admin.product.edit', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $products = Product::find($id);
        $products->product_name = $request->name;
        $products->description = $request->detail;

        if ($request->hasFile('image')) {
            if (Storage::exists('products/thumbnails/' . $products->image)) {
                Storage::disk()->delete('products/thumbnails/' . $products->image);
            }
            if (Storage::exists('products/' . $products->image)) {
                Storage::disk()->delete('products/' . $products->image);
            }
            $image = $request->file('image')->store('products');
            $filename = basename($image);
            $img = Image::make($request->file('image'))->resize(150, 150, function ($const) {
                $const->aspectRatio();
            })->save();
            Storage::disk()->put('products/thumbnails/' . $filename, $img);

            $products->image = $filename;
        }
        $products->update();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::find($id);
        $products->delete();
    }
}
