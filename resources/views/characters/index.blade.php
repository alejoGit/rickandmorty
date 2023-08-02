<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rick and Morty Characters</title>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header class="header">
    <h1>Personajes</h1>
    <form class="form" action="/" method="GET">
        <input class="search__input" type="text" name="name" value="{{$name}}" placeholder="Buscar por nombre">
        <input type="hidden" name="species" value="{{$species}}">
        <button class="search__btn">Buscar</button>
    </form>
</header>
<div class="wrapper">
    <div class="sidebar">
        <h3>Filtros de busqueda</h3>
        <div>
            <h3>Especies</h3>
            <div id="idSpeciesFilter"></div>
        </div>
    </div>
    <div class="characters">
    @foreach ($characters as $character)
        <a class="character__card" href="/personaje/{{$character->id}}">     
            <img src="{{$character->image}}" alt="{{$character->name}}" />
            <div>{{ $character->name }}</div>
            <div>
                <small>{{ $character->species }}</small>
            </div>
            <div class="character__status {{ $character->status }}">{{ $character->status }}</div>
        </a>
    @endforeach
    </div>
</div>
<div class="d-flex justify-content-center px-4">
{{ $characters->appends(request()->input())->links("pagination::bootstrap-4") }}
</div>
<script>
    const species = [
        'Human',
        'Alien',
        'Humanoid',
        'unknown',
        'Poopybutthole',
        'Mythological Creature',
        'Animal',
        'Robot',
        'Cronenberg',
        'Disease',
    ]
    const currentSpecie = "{{$species}}"
    const onClickFilter = (param = '') => {
        window.location.href = '/?name='+'{{$name}}&species='+param;
    }
    const mappedSpecies = species.map((specie, index) => {
        return `<div class="filter__ctn"><button class="filter__btn ${(currentSpecie === specie)  ? 'current' : ''}" 
                    key=${index} 
                    onclick="onClickFilter('${specie}')">
                        ${specie}
                </button>
                ${(currentSpecie === specie) ? '<button class="filter__remove" onclick="onClickFilter()">X</a>' : ''}
                </div>`
    }).join('')
    
    let speciesFilter = document.getElementById('idSpeciesFilter')
    console.log(speciesFilter)
    speciesFilter.innerHTML = mappedSpecies
</script>
</body>
</html>

