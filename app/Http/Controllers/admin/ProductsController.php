<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsController extends Controller
{

    public function index()
    {
        $this->authorize('view-any',Product::class);
//        $products = Product::when($request->name, function($query, $value) {
//            $query->where(function($query) use ($value) {
//                $query->where('products.name', 'LIKE', "%{$value}%")
//                    ->orWhere('products.description', 'LIKE', "%{$value}%");
//            });
//        })
//            ->when($request->product_id, function($query, $value) {
//                $query->where('product_id', '=', $value);
//            })
//            ->with('product')
//            ->get();
//
//        $names = [];
//        $data = [];
//        foreach ($products as $product) {
//            if (in_array($product->name, $names)) {
//                continue;
//            }
//            $data[] = $product;
//            $names[] = $product->name;
//        }

        $products = Product::with('category')
            ->latest()
            ->orderBy('name', 'asc')
            ->paginate(5);
        return view('admin.products.index', [
            'products' => $products,
            'categories' => Category::all(),
            'stores' => Store::all(),
        ]);
    }

    public function create()
    {
        $this->authorize('create',Product::class);

        return view('admin.products.create', [
            'products' => new Product(),
            'stores' => Store::all(),
            'categories' => Category::all(),
            'tags' => ''
        ]);
    }


    public function store(Request $request)
    {
        $this->authorize('create',Product::class);

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


        return redirect()->route('admin.products.index')
            ->with('success', "Product ($product->name) created!");
    }


    public function show($id)
    {
        $products = Product::findOrFail($id);

        $this->authorize('view',$products);


        return view('admin.products.show', [
            'product' => $products
        ]);
    }

    public function edit($id)
    {
        $products = Product::findOrFail($id);
        $this->authorize('update',$products);
        $tags = $products->tags->pluck('name')->toArray();

        return view('admin.products.edit', [
            'products' => $products,
            'stores' => Store::all(),
            'categories' => Category::all(),
            'tags' => implode(',', $tags)
        ]);
    }


    public function update(Request $request, $id)
    {
        $products = Product::findOrFail($id);
        $this->authorize('update',$products);

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

        $data = $request->all();

        $previous = false;

        if ($request->hasFile('image')) {
            $fileName = $request->image->move(public_path('images'), str_replace(' ', '', $request->image->getClientOriginalName()));
            $data['image'] = $fileName->getBasename();

            $previous = $products->image;

            $products->update($data);
        }

        if ($previous) {
            unlink(public_path('images/' . $previous));
        }

        $products->tags()->sync($this->getTags($request));

        if ($request->hasFile('gallery')){

            foreach ($request->file('gallery') as $file){

                $image_path = $file->move(public_path('images'), str_replace(' ', '', $file->getClientOriginalName()));
                $data['gallery'] = $image_path->getBasename();
                $products->images()->create([
                  'image_path' => $data['gallery'] ,
                ]);

            }
        }


        return redirect()->route('admin.products.index')
            ->with('success', "Product ($products->name) Updated!");


    }

    public function destroy($id)
    {
        $products = Product::findOrFail($id);
        $this->authorize('delete',$products);
        $products->delete();

        if ($products->image && file_exists(public_path('images/' . $products->image))) {
            unlink(public_path('images/' . $products->image));
        }

        return redirect()->route('admin.products.index')
            ->with('success', "Product ($products->name) deleted!");
    }

    public function getTags(Request $request)
    {
        $tag_ids = [];
        $tags = $request->post('tags');
        $tags = json_decode($tags);
        if ( is_array($tags) && count($tags) > 0) {
            foreach ($tags as $tag) {
                $tag_name = $tag->value;
                $tagModle = Tag::firstOrCreate([
                    'name' => $tag_name
                ], [
                    'slug' => Str::slug($tag_name)
                ]);
                $tag_ids[] = $tagModle->id;
            }
        }
        return $tag_ids;
    }


}

