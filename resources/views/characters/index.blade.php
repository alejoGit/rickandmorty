@extends('layout.layout')
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