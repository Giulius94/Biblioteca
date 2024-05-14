@extends('layouts.layout')
@section('title', 'User Reservations')

@section('content')
    <div class="row row-cols-2 row-cols-md-3 g-4">
    @foreach($books as $key => $value)
        @foreach($reservations as $key => $res)
            @if($value->id == $res->book_id)
            <div class="col">
                <div class="card">
                    <img src="https://www.lumien.it/wp-content/uploads/2022/01/Come-promuovere-un-libro.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <table class="table text-start">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="fs-5">Titolo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="border-0" id="card-title">{{$value->title}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-7">
                                <table class="table text-end">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="fs-5">Autore</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($value->authors->isNotEmpty())
                                            <tr>
                                                <td class="border-0" id="card-author">{{ strlen($value->authors[0]->name) > 17 ? substr($value->authors[0]->name, 0, 17) . '...' : $value->authors[0]->name }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="border-0">Nessun autore</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="row border-top">
                            <div class="col-8 my-3">
                                <h5>Dettagli</h5>
                                <p class="card-text">Pagine :{{$value->pages}}</p>
                                <p class="card-text">Anno pubblicazione : {{$value->year}}</p>
                            </div>
                            <div class="col text-end my-3">
                                <ul class="list-group">
                                    <h5>Categoria</h5>
                                    @if($value->categories->isNotEmpty())
                                        {{-- Prende una categoria a caso --}}
                                        <li class="list-group-item border-0">{{$value->categories[0]->name}}</li>
                                    @else
                                        <li class="list-group-item border-0">Nessuna categoria</li>
                                    @endif
                                </ul>
                            </div>

                            <form method="POST" action="/reservations/{{$res->id}}">
                                @csrf
                                @method ('DELETE')
                            <div class="d-grid gap-2 mt-3">

                                <button type="submit" class="btn btn-outline-danger">Annulla prenotazione</button>
                            </div>

                            </form>
                            <div class="d-grid gap-2 mt-3">
                                <a class="btn btn-dark" href="/books/{{$value->id}}">Dettagli</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endif

        @endforeach
    @endforeach
    </div>
@endsection
