<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Page;
use Purifier;

class PageController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/page/page', [
          'heading'   => 'Pages',
          'pages'     => Page::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/page/create', [
          'heading'   => 'Create New Page',
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
        $this->validate($request, [
          'title'         => 'required',
          'content'       => 'required',
          'description'   => 'required',
          'keywords'      => 'required',
        ]);

        $page = new Page;
        $page->title        = $request->title;
        $page->content      = Purifier::clean($request->content);
        $page->description  = $request->description;
        $page->keywords     = $request->keywords;

        $page->user()->associate(\Auth::user());

        $page->save();

        flash('Page '.$request->title. ' berhasil ditambahkan.')->success();
        return redirect()->route('pages.index');
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
        $page = Page::find($id);

        return view('admin/page/edit', [
          'heading'     => 'Edit : '. $page->title,
          'page'        => $page,
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
        $page = Page::find($id);

        $page->title = $request->title;
        $page->description = $request->description;
        $page->keywords = $request->keywords;
        $page->content = Purifier::clean($request->content);

        $page->save();
        flash('Page berhasil di edit')->success();
        return redirect()->route('pages.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();
        flash('Page "'.$page->title.'" telah berhasil di hapus')->success();
        return redirect()->route('pages.index');
    }
}
