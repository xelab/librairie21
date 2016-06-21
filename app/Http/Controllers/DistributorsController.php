<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Distributor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class DistributorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $distributors = Distributor::paginate(15);

        return view('distributors.index', compact('distributors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('distributors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        $distributor = Distributor::create($request->all());

        Session::flash('flash_message', 'Distributor added!');
        if($request->wantsJson())
        {
            return response()->json($distributor);
        }
        return redirect('distributors');
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
        $distributor = Distributor::findOrFail($id);

        return view('distributors.show', compact('distributor'));
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
        $distributor = Distributor::findOrFail($id);

        return view('distributors.edit', compact('distributor'));
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
        
        $distributor = Distributor::findOrFail($id);
        $distributor->update($request->all());

        Session::flash('flash_message', 'Distributor updated!');

        return redirect('distributors');
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
        Distributor::destroy($id);

        Session::flash('flash_message', 'Distributor deleted!');

        return redirect('distributors');
    }
}
