<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{

    public function index(Request $request){

        $this->authorize('view-any',Category::class);


        $categories = Category::when($request->name, function($query, $value) {
            $query->where(function($query) use ($value) {
                $query->where('categories.name', 'LIKE', "%{$value}%")
                    ->orWhere('categories.description', 'LIKE', "%{$value}%");
            });
        })
            ->when($request->parent_id, function($query, $value) {
                $query->where('parent_id', '=', $value);
            })
//            ->leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
//            ->select([
//                'categories.*',
//                'parents.name as parent_name'
//            ])
            ->with('parent')
            ->get();

        $names = [];
        $data = [];


        foreach ($categories as $category) {
            if (in_array($category->name, $names)) {
                continue;
            }
            $data[] = $category;
            $names[] = $category->name;
        }


        $parents = Category::orderBy('name', 'asc')->get();
        return view('admin.categories.index', [
            'categories' => $categories,
            'parents' => $parents,
        ]);

 }

//        $categories = Category::all();
//        return view('admin.categories.index',compact('categories'));


    public function create(){

        $this->authorize('create',Category::class);

        $parents = Category::orderBy('name', 'asc')->get();
        return view('admin.categories.create', [
            'parents' => $parents,
            'title' => 'Add Category',
            'category' => new Category(),
        ]);
//        $cats = Category::all();
//        return view('admin.categories.create',compact('cats'));

    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        $this->authorize('update',$category);


        $parents = Category::where('id', '<>', $id)
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.categories.edit', [
            'id' => $id,
            'category' => $category,
            'parents' => $parents,
        ]);
    }


    public function store(Request $request){

        $this->authorize('create',Category::class);


        $this->valRequest($request);

        $cat = new Category();
        $cat->name = $request->name;
        $cat->slug = Str::slug($request->name);
        $cat->description = $request->description;
        $cat->status = $request->status;
        $cat->parent_id = $request->parent_id;
        $cat->save();

        session()->put('status', 'Category added (from status!)');
        session()->flash('success', 'Category added!');

        return redirect(route('admin.categories.index'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if ($category == null) {
            abort(404);
        }
        $this->authorize('update',$category);

        $this->valRequest($request);

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->status = $request->status;
        $category->save();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated');
    }

    public function show($id){

        $category = Category::findOrFail($id);

        $this->authorize('view',$category);


        return view('admin.categories.show', [
            'category' => $category,
        ]);

    }


    public function destroy($id){

         $category = Category::findorfail($id);

        $this->authorize('delete',$category);

        $category->delete();


        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted');
    }


    protected function valRequest(Request $request){

        $request->validate([
            'name' =>  [
                    'required',
                    'min:3',
                    'string',
                        'unique:categories,name,$id',
                ],

            'description' =>  'nullable|min:5|max:20',
            'parent_id'   =>  'nullable|exists:categories,id',
            'status'      =>  'required|in:active,inactive',
            'image'       =>  'nullable|image',
        ]);

    }
}
