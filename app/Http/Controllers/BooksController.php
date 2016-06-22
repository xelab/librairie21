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
		$authors = Author::pluck('name')->all();
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
		$crawler = $client->request('GET', 'http://www.librairie-de-paris.fr/listeliv.php?RECHERCHE=simple&LIVREANCIEN=2&MOTS='. $request->input('isbn') .'&x=0&y=0');
		$count = $crawler->filter('.listeliv_metabook')->count();
		$book;
		if($count > 0)
		{
			$book = new Book;
			if(count($element = $crawler->filter('.listeliv_metabook > .titre_commentaire > .titre a')->first()) > 0){
				$book->title = $element->text();
			}
			if(count($element = $crawler->filter('.listeliv_metabook > .auteurs > a')->first()) > 0)
			{
				$authors = array_map('trim', explode(' ', $element->text()));
			}
			if(count($element = $crawler->filter('.listeliv_metabook > .editeur')->first()) > 0)
			{
				$editeurDate = explode('-', $element->text());
				$nom = trim($editeurDate[0]);
				$date = trim($editeurDate[1]);
				$editeur = Publisher::where(['name' => $nom])->first();
				if ($editeur != null)
				{
					$book->publisher_id = $editeur->id;
				}
				else
				{
					$book->publisher_id = Publisher::create(['name' => $nom])->id;
				}
			}
			if(count($element = $crawler->filter('.listeliv_metabook > .prix > .prix_indicatif')->first()) > 0)
			{
				preg_match('/((?:[0-9]+,)*[0-9]+(?:\.[0-9]+)?)/', $element->text(), $matches);
				Log::info('matches', $matches);
				if(count($matches) >0)
				{
					$book->price = $matches[0];
				}
			}
			if(count($element = $crawler->filter('.listeliv_metabook > .genre')->first()) > 0)
			{
				$tags = explode($element->text(), ' ');
			}
		}
		return response()->json(['book' => $book]);
	}
}
