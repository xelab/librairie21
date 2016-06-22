<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Book;
use App\Distributor;
use App\Publisher;
use App\Author;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Log;
use Goutte\Client;
use Datatables;

class BooksController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$distributors = ['' => ''] + Distributor::pluck('name')->all();
		$publishers = ['' => ''] + Publisher::pluck('name')->all();
		$authorsRaw = Author::get()->all();
		$authors = array();
		foreach ($authorsRaw as $author) {
			$authors[$author->id] = $author->fullName();
		}
		return view('books.index', compact('distributors', 'publishers', 'authors'));
	}

	/**
	 * Process datatables ajax request.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function anyData()
	{
	    return Datatables::of(Book::select('*'))->make(true);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('books.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, ['title' => 'required']);
		Book::create($request->all());
		return redirect('book');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$book = Book::findOrFail($id);
		return view('books.show', compact('book'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$book = Book::findOrFail($id);
		return view('books.edit', compact('book'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if you need to validate any input.
		$book = Book::findOrFail($id);
		$book->update($request->all());
		return redirect('books');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Book::destroy($id);
		return redirect('books');
	}

	public function scraping(Request $request)
	{
		$client = new Client();
		Log::info('test', ['request' => $request->input('isbn')]);
		$crawler = $client->request('GET', 'http://www.librairie-de-paris.fr/listeliv.php?RECHERCHE=simple&MOTS='. $request->input('isbn') .'&x=0&y=0');
		Log::info('test', ['status' => $client->getResponse()->getContent()]);
		$meta = $crawler->filter('.metabook')->first();
		return response()->json($meta);
	}
}
