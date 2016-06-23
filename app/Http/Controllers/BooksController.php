<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Book;
use App\Distributor;
use App\Publisher;
use App\Author;
use App\Tag;
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
        $distributors = ['' => 'Choisir un distributeur'] + Distributor::pluck('name', 'id')->all();
        $publishers = ['' => 'Choisir un éditeur'] + Publisher::pluck('name', 'id')->all();
        $authors = Author::pluck('name', 'id')->all();
        $tags = Tag::pluck('name', 'id')->all();
        return view('books.index', compact('distributors', 'publishers', 'authors', 'tags'));
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

        $book = Book::create($request->all());

        if($request->wantsJson())
        {
            return response()->json($book);
        }

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
        $authors = array();
        $newAuthors = array();
        $tags = array();
        $newTags = array();
        $newPublisher = null;
        if($count > 0)
        {
            $book = new Book;
            if(count($element = $crawler->filter('.listeliv_metabook > .titre_commentaire > .titre a')->first()) > 0){
                $book->title = $element->text();
            }
            if(count($element = $crawler->filter('.listeliv_metabook > .auteurs > a')->first()) > 0)
            {
                $names = array_map('trim', explode(',', $element->text()));
                $authors = Author::whereIn('name', $names)->get();
                if(count($authors) != count($names))
                {
                    $namesInBdd = $authors->pluck('name')->all();
                    foreach ($names as $name) {
                        if(!in_array($name, $namesInBdd))
                        {
                            $author = Author::create(['name' => $name]);
                            $newAuthors[] = $author;
                        }
                    }
                }

            }
            if(count($element = $crawler->filter('.listeliv_metabook > .editeur')->first()) > 0)
            {
                if (count($crawler->filter('.listeliv_metabook > .editeur .date_parution')->first()) > 0) 
                {
                    $date = $crawler->filter('.listeliv_metabook > .editeur .date_parution')->first()->text();
                    $english = array('Jan','Febr','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec');
                    $french = array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');
                    $date = str_replace($french, $english, $date);
                    $date = new Carbon(trim(str_replace($french, $english, $date)));
                    $book->released = $date->format('d/m/Y');
                }
                
                $editeur = explode('-', $element->text());
                $nom = trim(html_entity_decode($editeur[0]));
                $editeur = Publisher::where(['name' => $nom])->first();
                if ($editeur != null)
                {
                    $book->publisher_id = $editeur->id;
                }
                else
                {
                    $newPublisher = Publisher::create(['name' => $nom]);
                    $book->publisher_id = $newPublisher->id;
                }
            }
            if(count($element = $crawler->filter('.listeliv_metabook > .prix > .prix_indicatif')->first()) > 0)
            {
                preg_match('/((?:[0-9]+,)*[0-9]+(?:\.[0-9]+)?)/', $element->text(), $matches);
                if(count($matches) >0)
                {
                    $book->price = $matches[0];
                }
            }
            if(count($element = $crawler->filter('.listeliv_metabook > .genre')->first()) > 0)
            {
                $names = str_replace("/", "", $element->text());
                $names = str_replace(",", "", $element->text());
                $names = str_replace("Bandes Dessinées", "BD", $names);
                $names = preg_split('/\s+/', $names);
                $tags = Tag::whereIn('name', $names)->get();
                if(count($tags) != count($names))
                {
                    $namesInBdd = $tags->pluck('name')->all();
                    foreach ($names as $name) {
                        if(!in_array($name, $namesInBdd) && !empty($name))
                        {
                            $tag = Tag::create(['name' => $name]);
                            $newTags[] = $tag;
                        }
                    }
                }
            }
        }
        return response()->json(['book' => $book, 'tags' => $tags, 'newTags' => $newTags, 'authors' => $authors, 'newAuthors' => $newAuthors, 'newPublisher' => $newPublisher]);
    }
}
