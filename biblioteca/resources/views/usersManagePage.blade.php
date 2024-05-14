@extends('layouts.layout')
    @section('title', 'Gestione Utenti')
    @section('content')

    <div class="container mt-5">
       <a class="btn btn-success my-3" href="/users/create">Crea Nuovo Utente</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Verificato?</th>
                <th>Admin?</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user) 
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->email_verified_at ? 'Si' : 'No' }}</td>
                <td>{{ $user->isAdmin ? 'Si' : 'No' }}</td>

                
                <td class="text-center"><a class="btn btn-warning text-white text-center"  href="{{ route('users.edit', $user->id) }}"><i class="bi bi-pencil mx-auto"></i></button></td>
                <td class="text-center"><form method="POST" action="/users/{{$user->id}}">
                            @csrf
                            @method ('DELETE')
                            <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form></td>
                        <td class="text-center"><a class="btn btn-info text-white text-center"  href="{{ route('users.show', $user->id) }}"><i class="bi bi-eye mx-auto"></i></button></td>
            </tr>
            @endforeach
           
        </tbody>
    </table>
</div>



    @endsection