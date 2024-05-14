@extends('layouts.layout')
    @section('title', 'Modifica Utente')
    @section('content')

    <div class="container mt-5">


    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
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
                <option value="0" @if ($user->isAdmin === 0) selected @endif>No</option>
                <option value="1" @if ($user->isAdmin === 1) selected @endif>Yes</option>
            </select>
            <button type="submit" class="btn btn-primary mt-3">Modifica</button>
        </div>
       
        
 
  </div>



    @endsection