@extends('layouts.layout')

@section('content')
<div class="container my-5">
    <div class="card w-75 m-auto">
        <div class="card-body">
            <h3 class="card-title text-center mb-5">Dettagli sul libro "{{$book->title}}"</h3>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-6 mb-3 d-flex align-items-center">
                    <div class="card text-bg-dark">
                        <img src="/img/bookplaceholder.png" class="card-img" alt="...">
                        <div class="card-img-overlay">
                            <h5 class="card-title text-center" style="margin-top: 50px">{{$book->title}}</h5>
                            <h5 class="card-title text-center" style="margin-top: 50px"> di {{$book->authors[0]->name}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-6">
                <p class="box-title mt-5"><b>Nome libro: </b>{{$book->title}}</p>
                <p class="box-title mt-3"><b>Autore : </b>{{$book->authors[0]->name}}</p>
                <p class="box-title mt-3"><b>Categoria: </b>{{$book->categories[0]->name}}</p>
                <p class="box-title mt-3"><b>Breve descrizione: </b>{{$book->description}}</p>
                
                    
                  
                    <h2 class="mt-5">
                    @php
                        $userId = Auth::id(); // Assumendo che Auth sia disponibile
                        // Controlla se l'utente corrente ha già prenotato questo libro
                        $hasReserved = $book->reservations->contains('user_id', $userId);
                    @endphp

                    @if($hasReserved)
                        <p>Già Prenotato</p>
                        <span>
                            <button type="button" class="btn btn-secondary" disabled>Hai già prenotato</button>
                        </span>
                    @elseif($book->numcopies >= 1)
                        <p>Disponibile</p>
                        <form method="POST" action="/reservations" id="reservationForm">
                            @csrf
                            <input type="hidden" name="id" value="{{$book->id}}">
                            <span>
                                <button class="btn btn-outline-primary" type="submit">Prenota</button>
                            </span>
                        </form>
                    @else
                        <p>Non disponibile</p>
                        <span>
                            <button type="button" class="btn btn-danger" disabled>Non disponibile</button>
                        </span>
                    @endif
                    </h2>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h3 class="box-title mt-5">Riepilogo</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-product">
                            <tbody>
                               
                                <tr>
                                    <td>Titolo</td>
                                    <td>{{$book->title}}</td>
                                </tr>
                                <tr>
                                    <td>Anno di pubblicazione</td>
                                    <td>{{$book->year}}</td>
                                </tr>
                                <tr>
                                    <td>Pagine</td>
                                    <td>{{$book->pages}}</td>
                                </tr>
                                <tr>
                                    <td>Autore</td>
                                    <td>{{$book->authors[0]->name}}</td>
                                </tr>
                                <tr>
                                    <td>Categoria</td>
                                    <td>{{$book->categories[0]->name}}</td>
                                </tr>
                                <tr>
                                    <td>ISBN</td>
                                    <td id="ISBN"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function generateAndSetISBN() {
    var randomNumber = '';
    for (var i = 0; i < 9; i++) {
        randomNumber += Math.floor(Math.random() * 10);
    }

    var sum = 0;
    for (var i = 0; i < 9; i++) {
        sum += parseInt(randomNumber[i]) * (10 - i);
    }
    var checksum = (11 - (sum % 11)) % 11;
    if (checksum === 10) {
        checksum = 'X';
    }

    var isbn = '0-306-' + randomNumber.substring(0, 3) + '-' + randomNumber.substring(3, 9) + '-' + checksum;

    document.getElementById("ISBN").innerText = isbn;
}

generateAndSetISBN();
</script>
@endsection
