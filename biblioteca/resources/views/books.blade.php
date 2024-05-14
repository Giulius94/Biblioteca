    @extends('layouts.layout')
    @section('title', 'Books Library')
    @section('content')
    <div class="row row-cols-2 row-cols-md-3 g-4">
        @foreach($books as $key => $value)
        <div class="col">
            <div class="card">
                <img src="https://www.lumien.it/wp-content/uploads/2022/01/Come-promuovere-un-libro.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="row p-0">
                        <div class="col">
                            <table class="table text-start">
                                <thead>
                                    <tr>
                                        <th scope="col" class="fs-5">Titolo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border-0  pb-0" id="card-title">{{$value->title}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6">
                            <table class="table text-end">
                                <thead>
                                    <tr>
                                        <th scope="col" class="fs-5">Autore</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($value->authors->isNotEmpty())
                                        <tr>
                                            <td class="border-0 pb-0" id="card-author">{{ strlen($value->authors[0]->name) > 17 ? substr($value->authors[0]->name, 0, 17) . '...' : $value->authors[0]->name }}</td>
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

                    <div class="row border-top border-bottom">
                        <div class="col-8 my-3">
                            <h5>Dettagli</h5>
                            <p class="card-text">Pagine :{{$value->pages}}</p>
                            <p class="card-text">Anno pubblicazione : {{$value->year}}</p>
                        </div>
                        <div class="col text-end mt-3">
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
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5 class="mt-3">Stato</h5>
                                @php
                                    $statoPrenotazione = $value->numcopies > 0 ? 'Disponibile' : 'Non disponibile';
                                @endphp
                                <p class="card-text">{{$statoPrenotazione}}</p>
                 
                            
                            <div class="d-flex justify-content-between align-items-center my-3">


                                <p class="card-text m-0">Numero di Copie :{{$value->numcopies}}</p>
                                @if($value->numcopies >= 1)
                              
                                <form method="POST" action="/reservations" id="reservationForm">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$value->id}}">

                                   @php
                                    // Supponendo di avere l'ID dell'utente corrente
                                    $userId = Auth::id();

                                    // Verifica se l'utente ha già prenotato questo libro
                                    $hasReserved = $value->reservations->contains(function ($reservation) use ($userId) {
                                        return $reservation->user_id === $userId;
                                    });
                                    @endphp

                                @if($hasReserved)
                                    <span>
                                        <button class="btn btn-outline-primary" type="submit" disabled>Hai già prenotato</button>
                                    </span>
                                @else
                                    <span>
                                        <button class="btn btn-outline-primary" type="submit">Prenota</button>
                                    </span>
                                @endif

                                </form>

                                @else
                                <span>
                                    <button type="button" class="btn btn-danger" disabled>Non disponibile</button>
                                </span>

                                @endif
                            </div>
                        </div>
                    </div>
                    @if(Auth::user()->isAdmin === 1)
                    <div class="d-flex my-3">
                        <a type="button" class="btn btn-outline-warning h-25 mx-2" href="/books/{{$value->id}}/edit"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="/books/{{$value->id}}">
                            @csrf
                            @method ('DELETE')
                            <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>

                    </div>
                    @endif
                    <div class="d-grid gap-2 mt-3">
                    <a class="btn btn-dark" href="/books/{{$value->id}}">Dettagli</a></div>
                    
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center my-3">
    {{ $books->links() }}

    </div>
    @endsection