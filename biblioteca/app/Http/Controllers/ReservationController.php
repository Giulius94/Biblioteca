<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'ciao sono index reservations';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        if (Auth::check()) {
            $user_id = Auth::id();

            // Controlla se l'utente ha già prenotato lo stesso libro
            $alreadyReserved = Reservation::where('user_id', $user_id)
                ->where('book_id', $request->id)
                ->where('stato', 'in prestito')
                ->exists();

            if ($alreadyReserved) {
                // Reindirizza all'elenco dei libri con un messaggio di errore
                return redirect('/books')->with('error', 'Impossibile prenotare il libro più di una volta.');
            }

            // Creazione nuova reservation
            $reservation = new Reservation();
            $reservation->user_id = $user_id;
            $reservation->book_id = $request->id;
            $reservation->stato = 'in prestito';
            $reservation->save();

            $book = Book::find($request->id);
            if ($book) {
                $book->numcopies = $book->numcopies > 0 ? $book->numcopies - 1 : 0;  // Evita di andare sotto 0
                $book->save();
            }

            // Reindirizza all'elenco dei libri con un messaggio di successo
            return redirect('/books')->with('success', 'Libro prenotato con successo.');
        } else {
            return 'utente non autenticato';
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $reservations = Reservation::where('user_id', $id)->get();
        $books = Book::all();

        return view('userReserv', ['reservations' => $reservations, 'books' => $books]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        $book = Book::find($reservation->book_id);
        if ($book) {
            $book->numcopies += 1;
            $book->save();
        }
        return redirect('/books')->with('success', 'Prenotazione cancellata con successo.');
    }
}
