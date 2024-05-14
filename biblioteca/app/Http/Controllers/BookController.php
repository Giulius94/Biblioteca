<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return dd(Book::with('authors', 'categories', 'reservations')->paginate(3));
        return view('books', ['books' => Book::with('authors', 'categories', 'reservations')->simplePaginate(3), 'users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        // Crea un nuovo libro
        $book = new Book();
        $book->title = $request->title;
        $book->description = $request->description;
        $book->year = $request->year;
        $book->pages = $request->pages;
        $book->numcopies = $request->numcopies;
        $book->save();  // Assicurati che il libro sia salvato per generare un ID

        // Supponendo che tu voglia creare un nuovo autore e associarlo al libro appena creato
        $author = new Author();
        $author->name = $request->author;  // o qualsiasi altro campo hai per l'autore
        $author->city = $request->city;  // Assumendo che tu voglia salvare anche la città
        $author->book_id = $book->id;  // Associa l'ID del libro appena creato
        $author->save();

        // Supponendo che tu voglia creare una nuova categoria e associarla al libro appena creato
        $category = new Category();
        $category->name = $request->category;  // o qualsiasi altro campo hai per la categoria
        $category->book_id = $book->id;  // Associa l'ID del libro appena creato
        $category->save();

        return redirect('/books');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book = Book::with('authors', 'categories', 'reservations')->findOrFail($book->id);
        // return $book;
        return view('detailpage', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        // Ottieni l'ID originario del libro
        $originalBookId = $book->id;

        // Aggiorna i campi del libro
        $book->update([
            'title' => $request->title,
            'description' => $request->description,
            'year' => $request->year,
            'pages' => $request->pages,
            'numcopies' => $request->numcopies,
            'updated_at' => now(),
        ]);

        // Verifica se il campo category è stato inviato nel form
        if ($request->has('category')) {
            // Aggiorna anche la tabella categories solo se il campo category è stato modificato
            $book->categories()->update([
                'name' => $request->category,
                'updated_at' => now(),
            ]);
        }

        // Aggiorna anche la tabella authors
        $book->authors()->update([
            'name' => $request->author,
            'city' => $request->city,  // Assumendo che tu abbia un campo city nell'autore
            'updated_at' => now(),
        ]);

        // Reindirizza alla pagina desiderata dopo l'aggiornamento
        return redirect('/books')->with('success', 'Libro aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect('/books');
    }
}
