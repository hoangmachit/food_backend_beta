<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $products = Product::orderBy('status', 'DESC')->get();
        return view('admin.product.index', [
            'products' => $products
        ]);
    }
    public function create(Request $request)
    {
        $data = $request->product;
        $data['price'] = !empty($data['price']) ? (int)$data['price'] : 0;
        $data['user_id'] = Auth::user()->id;
        $data['status'] = !empty($data['status']) ? (int) $data['status'] : 0;
        $product = Product::create($data);
        if ($request->image) {
            $imageName = $product->id . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/product'), $imageName);
            $product->image = $imageName;
            $product->save();
        }
        return redirect()->route('admin.product.index')->with('success', 'Product create success !!!');
    }
    public function update(Request $request, $id = 0)
    {
        $data = $request->product;
        $data['status'] = !empty($data['status']) ? (int) $data['status'] : 0;
        $data['user_id'] = Auth::user()->id;
        $product = Product::find($id);
        $product->name = $data['name'];
        $product->desc = $data['desc'];
        $product->price = !empty($data['price']) ? (int)$data['price'] : 0;
        $product->status = $data['status'];
        if ($request->image) {
            $imageName = $product->id . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/product'), $imageName);
            $product->image = $imageName;
        }
        $product->save();
        return redirect()->route('admin.product.index')->with('success', 'Product updated success !!!');
    }
    public function allStatus(Request $request)
    {
        $action = htmlspecialchars($request->action);
        if ($action == 'show') {
            $product = Product::whereStatus(0)->get();
            foreach ($product as $key => $item) {
                $item->status = 1;
                $item->save();
            }
        } else {
            $product = Product::whereStatus(1)->get();
            foreach ($product as $key => $item) {
                $item->status = 0;
                $item->save();
            }
        }
        return redirect()->route('admin.product.index')->with('success', 'All product updated success !!!');
    }
    public function status(Request $request, $id = 0)
    {
        $product = Product::find($id);
        $status = $request->status;
        $product->status = (int)$status;
        $product->save();
        return response(true, 200);
    }
    public function delete(Request $request, $id = 0)
    {
        $product = Product::find($id);
        if (!empty($product)) {
            $product->delete();
            return redirect()->route('admin.product.index')->with('success', 'Deleted product success !!!');
        } else {
            return redirect()->route('admin.product.index')->with('fail', 'Can not delete product success !!!');
        }
    }
}
