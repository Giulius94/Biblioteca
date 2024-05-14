<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/books">Books Library</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/books">Home</a>
                </li>
                @if(Auth::user()->isAdmin === 1)
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-success text-white" aria-current="page" href="/books/create">Aggiungi libro<i class="bi bi-book ms-2"></i></a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-success text-white" aria-current="page" href="{{ route('reservations.show', Auth::user()->id)}}">Elenco Prenotazioni<i class="bi bi-list-check ms-2"></i></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{Auth::user()->name}}
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('profile.edit')}}">Profilo</a></li>
                        <form method="POST" action="{{route('logout')}}">
                            @csrf
                            <li><button type="submit" class="dropdown-item" >Log out</button=></li>
                        
                        </form>
                        @if(Auth::user()->isAdmin === 1)
                        <li><a class="dropdown-item" href="/users">Amministrazione Utenti</a></li>
                        @endif

                    </ul>
                </li>
            </ul>

            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" id="search" placeholder="Search" aria-label="Search">
            </form>
        </div>
    </div>
</nav>