<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{

    public function index()
    {
        $this->authorize('view-any',Role::class);

        $roles = Role::paginate();
        return view('admin.roles.index',compact('roles'));
    }


    public function create()
    {
        $this->authorize('create',Role::class);

        return view('admin.roles.create');
    }


    public function store(Request $request)
    {
        $this->authorize('create',Role::class);

        $this->validate($request,[
            'name'      => 'required',
            'abilities' =>'required|array',
        ]);

         Role::create($request->all());

         return redirect()->route('admin.roles.index')->with('success','Role created!');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);

        $this->authorize('update',$role);


        return view('admin.roles.edit',compact('role'));
    }


    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $this->authorize('update',$role);

        $this->validate($request,[
            'name'      => 'required',
            'abilities' =>'required|array',
        ]);

        $role->update(($request->all()));

        return redirect()->route('admin.roles.index')->with('success','Role Updated!');
    }


    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $this->authorize('delete',$role);

        $role->delete();

        return redirect()->route('admin.roles.index')->with('success','Role Deleted!');

    }
}
