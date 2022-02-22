<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::with('section:id,name')->orderBy('id', 'DESC')->get();
        
        return Inertia::render('News/Index', [
            'news' => $news,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::orderBy('name', 'ASC')->get();
        return Inertia::render('News/Create', [
            'sections' => $sections
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nw = new News;
        $nw->title = $request->title;
        $nw->body = $request->body;
        $nw->section_id = $request->section_id;
        $nw->active = true;
        $nw->save();

        return Redirect::route('news.index');
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
        $sections = Section::orderBy('name', 'ASC')->get();
        $nw = News::findOrFail($id);
        return Inertia::render('News/Edit', [
            'nw' => $nw,
            'sections' => $sections
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
        $nw = News::findOrFail($id);
        $nw->title = $request->title;
        $nw->body = $request->body;
        $nw->section_id = $request->section_id;
        $nw->save();
        return Redirect::route('news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nw = News::findOrFail($id);
        $nw->delete();
        
        return Redirect::route('news.index');
    }
}
