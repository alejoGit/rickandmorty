@extends('layout.layout')
<div class="character__card detail">     
    <h1>{{ $character->name }}</h1>
    <img src="{{$character->image}}" alt="{{$character->name}}" />
    <div class="character__status {{ $character->status }}">{{ $character->status }}</div>
    <div>
        {{ $character->species }}  {{ $character->type }}
    </div>
    <div><b>Genero: </b> {{ $character->gender }}</div>
    <div><b>Origen: </b> {{ $character->origin }}</div>
    <div><b>Ubicación: </b> {{ $character->location }}</div>
</div >