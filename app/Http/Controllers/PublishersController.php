<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Publisher;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class PublishersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $publishers = Publisher::paginate(15);

        return view('publishers.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('publishers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        $publisher = Publisher::create($request->all());

        Session::flash('flash_message', 'Publisher added!');
        if($request->wantsJson())
        {
            return response()->json($publisher);
        }
        return redirect('publishers');
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
        $publisher = Publisher::findOrFail($id);

        return view('publishers.show', compact('publisher'));
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
        $publisher = Publisher::findOrFail($id);

        return view('publishers.edit', compact('publisher'));
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
        
        $publisher = Publisher::findOrFail($id);
        $publisher->update($request->all());

        Session::flash('flash_message', 'Publisher updated!');

        return redirect('publishers');
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
        Publisher::destroy($id);

        Session::flash('flash_message', 'Publisher deleted!');

        return redirect('publishers');
    }

    public function getCollections($id)
    {
        return response()->json(Publisher::find($id)->collections()->get());
    }
}
