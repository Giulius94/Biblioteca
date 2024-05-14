@extends('layouts.layout')
    @section('title')
    @section('content')
   

    <div class="container mt-5">
        

  <div class="card text-center w-50 mx-auto">
  <div class="card-header">
    Dettagli utente
  </div>
  <div class="card-body text-start">
    <p class="card-title"><b>Nome:  </b>{{$user->name}}</p>
    <p class="card-title"><b>Email: </b>{{$user->email}}</p>
    <p class="card-title"><b>Ruolo Amministratore:  </b> @if ($user->isAdmin === 1) {{ 'Si' }} @else {{'No'}} @endif</p>
    
  </div>
  <div class="card-footer text-body-secondary">
  <p>Prenotazioni</p>
           <table class="table table-hover ">
                <thead>
                    <tr>
                        <th>Numero Prenotazione</th>
                        <th>Stato</th>
                        <th>Libro Prenotato</th>
                        
                    </tr>
                </thead>
                <tbody>
                  @foreach ($user->reservations as $reservation)
                    <tr>
                        <td>{{$reservation->id}}</td>
                        <td>{{$reservation->stato}}</td>
                        <td>{{$reservation->book->title}}</td>
                        
                    </tr>
                    @endforeach
                    

                    
                   
                    
                </tbody>
            </table>
  </div>
</div>

    @endsection