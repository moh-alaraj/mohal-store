<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Advertise;
use Illuminate\Http\Request;

class AdvertisesController extends Controller
{

    public function index()
    {
        $ads = Advertise::all();
        return view('admin.advertises.index',compact('ads'));
    }


    public function create()
    {
        return  view('admin.advertises.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image',
            'title' => 'nullable'
        ]);

        $data = $request->all();

        $fileName = $request->photo->move(public_path('images'), str_replace(' ', '', $request->photo->getClientOriginalName()));
        $data['photo'] = $fileName->getBasename();

        Advertise::create($data);

        return redirect()->route('admin.advertise.index')
            ->with('success','created successfully');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $ads = Advertise::findOrFail($id);
        return view('admin.advertises.edit',compact('ads'));
    }



    public function update(Request $request, $id)
    {
        $ads = Advertise::findOrFail($id);
        $data = $request->all();
        $previous  = false;

        if ($request->hasFile('photo')) {
            $fileName = $request->photo->move(public_path('images'), str_replace(' ', '', $request->photo->getClientOriginalName()));
            $data['photo'] = $fileName->getBasename();
            $previous = $ads->photo;
        }

        $ads->update($data);

        if ($previous){
            unlink(public_path('images/' . $previous));
        }

        return redirect(route('admin.advertise.index'))
            ->with('success','Advertise Updated successfully');

    }


    public function destroy($id)
    {
        $ads = Advertise::findOrFail($id);
        $ads->delete();

        if ($ads->photo && file_exists(public_path('images/' . $ads->photo))) {
            unlink(public_path('images/' . $ads->photo));
        }

        return redirect(route('admin.advertise.index'))
            ->with('danger','Advertise deleted successfully');    }
}
