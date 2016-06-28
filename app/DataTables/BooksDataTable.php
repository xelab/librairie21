<?php

namespace App\DataTables;

use App\Book;
use Yajra\Datatables\Services\DataTable;

class BooksDataTable extends DataTable
{
    // protected $printPreview  = 'path.to.print.preview.view';

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function ($book) {
                return '<a href="#edit-'.$book->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Modifier</a>';
            })
            ->editColumn('distributor.name', '{{ $distributor->name or "" }}')
            ->editColumn('publisher.name', '{{ $publisher->name or "" }}')
            ->editColumn('authors.name', '{{ $authors->implode("name", ", ") }}')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $books = Book::with('publisher', 'distributor', 'authors');

        return $this->applyScopes($books);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax(route('datatables.data'))
                    ->addAction(['width' => '80px'])
                    ->parameters([
                        'dom' => 'Bfrtip',
                        'buttons' => ['csv', 'excel', 'pdf', 'print', 'reload'],
                        'language' => json_decode('{
                            "sProcessing":     "Traitement en cours...",
                            "sSearch":         "Rechercher&nbsp;:",
                            "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
                            "sInfo":           "Affichage de l\'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                            "sInfoEmpty":      "Affichage de l\'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                            "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                            "sInfoPostFix":    "",
                            "sLoadingRecords": "Chargement en cours...",
                            "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                            "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                            "oPaginate": {
                                "sFirst":      "Premier",
                                "sPrevious":   "Pr&eacute;c&eacute;dent",
                                "sNext":       "Suivant",
                                "sLast":       "Dernier"
                            },
                            "oAria": {
                                "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                                "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                            }
                        }')
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            ['data' => 'title', 'name' => 'title', 'title' => 'Titre'],
            ['data' => 'isbn', 'name' => 'isbn', 'title' => 'ISBN'],
            ['data' => 'buy', 'name' => 'buy', 'title' => 'Stock'],
            ['data' => 'deposit', 'name' => 'deposit', 'title' => 'Dépôts'],
            ['data' => 'publisher.name', 'name' => 'publisher', 'title' => 'Éditeur'],
            ['data' => 'distributor.name', 'name' => 'distributor', 'title' => 'Distributeur'],
            ['data' => 'authors.name', 'name' => 'authors', 'title' => 'Auteur-es'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'books';
    }
}
