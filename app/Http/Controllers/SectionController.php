<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Section;
// use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::orderBy('id', 'DESC')->get();
        
        return Inertia::render('Section/Index', [
            'sections' => $sections,
        ]);
    }

    // public function index()
    // {
    //     $role = Role::create(['name' => 'writer']);
    //     $role = Role::create(['name' => 'editor']);
    //     $role = Role::create(['name' => 'viewer']);
    //     $role = Role::create(['name' => 'admin']);

    //     $permission = Permission::create(['name' => 'write section']);
    //     $permission = Permission::create(['name' => 'edit section']);
    //     $permission = Permission::create(['name' => 'view section']);
    //     $permission = Permission::create(['name' => 'delete section']);
    //     $permission = Permission::create(['name' => 'write news']);
    //     $permission = Permission::create(['name' => 'edit news']);
    //     $permission = Permission::create(['name' => 'view news']);
    //     $permission = Permission::create(['name' => 'delete news']);

    //     $role = Role::where('id', 4)->first();
    //     $permission = Permission::where('id', 8)->first();
    //     $role->givePermissionTo($permission);

    //     $user = User::findOrFail(3);
    //     $user->givePermissionTo(['']);
    //     $user->assignRole('editor');
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Section/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $section = new Section;
        $section->name = $request->name;
        $section->save();

        return Redirect::route('section.index');
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
        $section = Section::findOrFail($id);
        return Inertia::render('Section/Edit', [
            'section' => $section
        ]);
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
        $section = Section::findOrFail($id);
        $section->name = $request->name;
        $section->save();
        return Redirect::route('section.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Section::findOrFail($id);
        $section->delete();
        
        return Redirect::route('section.index');
    }
}
