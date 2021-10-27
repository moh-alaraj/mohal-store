<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoresController extends Controller
{
    public function index(){

//        $this->authorize('view-any',Store::class);

        $stores = Store::all();

        return view('admin.stores.index', [
            'stores' => $stores,
        ]);

    }


    public function create(){

//        $this->authorize('create',Store::class);
        $stores = new Store();
        return view('admin.stores.create',[
            'stores' => $stores
        ]);


    }
    public function edit($id)
    {
        $stores = Store::findOrFail($id);

//        $this->authorize('update',$stores);

        return view('admin.stores.edit', [
            'stores' => $stores
        ]);
    }


    public function store(Request $request){

//        $this->authorize('create',Store::class);

        $request->validate([
           'name' => 'required',
           'description' => 'required',
           'status' => 'required|in:active,inactive'
        ]);
        $request->merge([
            'slug' => Str::slug($request->post('name')),

        ]);

        $data = $request->all();

        $fileName = $request->logo->move(public_path('images'), str_replace(' ', '', $request->logo->getClientOriginalName()));
        $data['logo'] = $fileName->getBasename();

        Store::create($data);

        return redirect(route('admin.stores.index'))->with('success','Store added!');
    }

    public function update(Request $request, $id)
    {
        $stores = Store::findOrFail($id);

//        $this->authorize('update',$stores);

        $this->validate($request,[
           'name' => 'required',
            'description' => 'required',
            'status' => 'required|in:active,inactive'
        ]);
        $data = $request->all();
        $previous  = false;

        if ($request->hasFile('logo')) {
            $fileName = $request->logo->move(public_path('images'), str_replace(' ', '', $request->logo->getClientOriginalName()));
            $data['logo'] = $fileName->getBasename();
            $previous = $stores->logo;
        }

        $stores->update($data);

        if ($previous){
            unlink(public_path('images/' . $previous));
        }


        return redirect()
            ->route('admin.stores.index')
            ->with('success', 'Store updated');
    }

    public function show($id){

    }


    public function destroy($id){

        $stores = Store::findorfail($id);

//        $this->authorize('delete',$stores);

        $stores->delete();


        return redirect()
            ->route('admin.stores.index')
            ->with('success', 'Store deleted');
    }

}
