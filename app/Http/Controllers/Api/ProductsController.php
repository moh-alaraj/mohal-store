<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class ProductsController extends Controller
{


    public function __construct()
    {

        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return Product::with('category','store')->get();
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'category_id' => 'required|exists:categories,id',
            'store_id' => 'required|exists:stores,id',
            'description' => 'nullable|min:3|max:15',
            'image' => 'nullable|image',
            'quantity' => 'nullable|min:0|numeric',
            'price' => 'required|min:0|numeric',
            'status' => 'required|in:sold-out,draft,in-stock',
            'sale_price' => ['required', 'min:0', 'numeric', function ($attr, $value, $fail) {
                $price = request()->input('price');
                if ($value >= $price) {
                    $fail($attr . ' must be less than regular price');
                }
            }],


        ]);

        $request->merge([
            'slug' => Str::slug($request->post('name')),

        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $fileName = $request->image->move(public_path('images'), str_replace(' ', '', $request->image->getClientOriginalName()));
            $data['image'] = $fileName->getBasename();
        }
        $product = Product::create($data);

        $product->tags()->attach($this->getTags($request));
        if ($request->hasFile('gallery')){

            foreach ($request->file('gallery') as $file){

                $image_path = $file->move(public_path('images'), str_replace(' ', '', $file->getClientOriginalName()));
                $data['gallery'] = $image_path->getBasename();
                $product->images()->create([
                    'image_path' => $data['gallery'] ,
                ]);

            }
        }
        $product->refresh();
        return response()->json($product,201);
    }


    public function show($id)
    {
        return Product::findOrFail($id);
    }


    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'sometimes|required|string|min:3',
            'category_id' => 'sometimes|required|exists:categories,id',
            'store_id' => 'sometimes|required|exists:stores,id',
            'description' => 'nullable|min:3|max:15',
            'image' => 'nullable|image',
            'quantity' => 'nullable|min:0|numeric',
            'price' => 'sometimes|required|min:0|numeric',
            'status' => 'sometimes|required|in:sold-out,draft,in-stock',
            'sale_price' => ['sometimes','required', 'min:0', 'numeric', function ($attr, $value, $fail) {
                $price = request()->input('price');
                if ($value >= $price) {
                    $fail($attr . ' must be less than regular price');
                }
            }],
        ]);

        $product = Product::findOrFail($id);

        $request->merge([
            'slug' => Str::slug($request->post('name')),
        ]);
        $data = $request->all();

        $previous = false;

        if ($request->hasFile('image')) {
            $fileName = $request->image->move(public_path('images'), str_replace(' ', '', $request->image->getClientOriginalName()));
            $data['image'] = $fileName->getBasename();

            $previous = $product->image;
            $product->update($data);
        }

        if ($previous) {
            unlink(public_path('images/' . $previous));
        }


        $product->update($data);

        return Response::json([
            'message' => 'Product updated',
            'data' => $product,
        ]);
    }


    public function destroy($id)
    {

//        $user = Auth::guard('sanctum')->user();
//        if (!$user->tokenCan('products.delete')){
//            Response::json([
//                'message' => 'forbidden'
//            ]);
//        }
        $products = Product::findOrFail($id);
        $products->delete();

        if ($products->image && file_exists(public_path('images/' . $products->image))) {
            unlink(public_path('images/' . $products->image));
        }

        return Response::json([
            'message' => 'Product deleted'
        ]);
    }


    public function getTags(Request $request)
    {
        $tag_ids = [];
        $tags = $request->post('tags');
        if ( is_array($tags) && count($tags) > 0) {
            foreach ($tags as $tag) {
                $tagModle = Tag::firstOrCreate([
                    'name' => $tag
                ], [
                    'slug' => Str::slug($tag)
                ]);
                $tag_ids[] = $tagModle->id;
            }
        }
        return $tag_ids;
    }


}
