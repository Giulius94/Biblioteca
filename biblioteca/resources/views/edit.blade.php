@extends('layouts.layout')
@section('title', 'Modifica Libro')

@section('content')
<form method="POST" action="/books/{{ $book->id }}">
  @csrf
  @method('PUT')
  <div class="mb-3">
    <label for="title" class="form-label">Titolo</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title" value="{{ $book->title }}">
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Descrizione</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="description" value="{{ $book->description }}">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Autore</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="author" value="{{ $book->authors[0]->name }}">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Autore citta</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="city" value="{{ $book->authors[0]->city}}">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Categoria</label>
    <select class="form-select" aria-label="Default select example" name="category">
      @foreach($book->categories as $category)
      <option selected value="{{$category->name}}" @if($loop->first) disabled hidden @endif>{{$category->name}}</option>
      @endforeach
      <option value="Horror">Horror</option>
      <option value="Fantasy">Fantasy</option>
      <option value="Fiction">Fiction</option>
      <option value="Romance">Romance</option>
      <option value="Mystery">Mystery</option>
      <option value="History">History</option>
    </select>
  </div>


  <div class="mb-3">
    <label for="year" class="form-label">Anno</label>
    <input type="number" class="form-control" id="exampleInputPassword1" name="year" value="{{ $book->year }}">
  </div>
  <div class="mb-3">
    <label for="pages" class="form-label">Pagine</label>
    <input type="number" class="form-control" id="exampleInputPassword1" name="pages" value="{{ $book->pages }}">
  </div>
  <div class="mb-3">
    <label for="numcopies" class="form-label">Numero copie</label>
    <input type="number" min="1" max="5" class="form-control" id="exampleInputPassword1" name="numcopies" value="{{ $book->numcopies }}">
  </div>
  <button type="submit" class="btn btn-outline-secondary">Modifica</button>
</form>
@endsection