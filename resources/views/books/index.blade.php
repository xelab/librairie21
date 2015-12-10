@extends('layouts.master')

@section('content')

    <h1>Books <a href="{{ url('/book/create') }}" class="btn btn-primary pull-right btn-sm">Add New Book</a></h1>
    <div class="table">
        <table class="table table-striped" id="books-table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>ISBN</th>
                </tr>
            </thead>
        </table>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/books.js') }}"></script>
    <script>
        $(function() {
            $('#books-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('datatables.data') !!}",
                columns: [
                    { data: 'title', name: 'title' },
                    { data: 'isbn', name: 'isbn' }
                ]
            });
        });
    </script>
@endpush