<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Libreria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  <body>
  @component('components.navbar')@endcomponent
    <div class="container">
        <h1 class="text-center my-5">@yield('title')</h1>
        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- Se c'è un messaggio di errore nella sessione, mostralo --}}
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
           @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
      const search = document.getElementById('search');
      const cards_titles = document.querySelectorAll('#card-title');
      const card_authors = document.querySelectorAll('#card-author');

      search.addEventListener('input', (e) => {
          const value = e.target.value.toLowerCase();

          cards_titles.forEach(card_title => {
              const card = card_title.closest('.card');
              const cardTitleMatch = card_title.textContent.toLowerCase().includes(value);
              let authorMatch = false;

              const authors = card.querySelectorAll('#card-author');
              authors.forEach(author => {
                  if (author.textContent.toLowerCase().includes(value)) {
                      authorMatch = true;
                  }
              });

              if (cardTitleMatch || authorMatch) {
                  card.parentNode.style.display = 'block';
              } else {
                  card.parentNode.style.display = 'none';
              }
          });
      });
    </script>
  </body>
</html>