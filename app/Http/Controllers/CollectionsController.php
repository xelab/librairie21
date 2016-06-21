<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Collection;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class CollectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $collections = Collection::paginate(15);

        return view('collections.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('collections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        $collection = Collection::create($request->all());

        Session::flash('flash_message', 'Collection added!');
        if($request->wantsJson())
        {
            return response()->json($collection);
        }
        return redirect('collections');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $collection = Collection::findOrFail($id);

        return view('collections.show', compact('collection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $collection = Collection::findOrFail($id);

        return view('collections.edit', compact('collection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        
        $collection = Collection::findOrFail($id);
        $collection->update($request->all());

        Session::flash('flash_message', 'Collection updated!');

        return redirect('collections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        Collection::destroy($id);

        Session::flash('flash_message', 'Collection deleted!');

        return redirect('collections');
    }
}
