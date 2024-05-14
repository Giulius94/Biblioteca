@extends('layouts.layout')
    @section('title', 'Modifica Utente')
    @section('content')

    <div class="container mt-5">


    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        @method('POST')
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" >
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" >
        </div>
       
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        
        <div class="mb-3">
            <label for="verificato" class="form-label">Utente Verificato</label>
            <select class="form-select" id="is_admin" name="email_verified">
                <option value="0"  selected >No</option>
                <option value="1"  selected >Yes</option>
            </select>
        </div>
        
            <label for="is_admin" class="form-label">Admin</label>
            <select class="form-select" id="is_admin" name="isAdmin">
                <option value="0"  selected >No</option>
                <option value="1"  selected >Yes</option>
            </select>
            <button type="submit" class="btn btn-primary mt-3">Crea</button>
        </div>
       
        
 
  </div>



    @endsection