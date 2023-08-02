<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Character;

class FeedDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:feed-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command syncs the local database with the rick and morty api keeping the api ids.';
    protected $apiUrl = 'https://rickandmortyapi.com/api/character';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get($this->apiUrl);
        $arrResponse = json_decode($response);
        //obtener el total de paginas para iterar
        $totalPages = $arrResponse->info->pages;
        $totalCharacters = $arrResponse->info->count;
        
        if(Character::count() !== $totalCharacters) {
            //obtener el primer listado de resultados paginado (page=1)
            $results = $arrResponse->results;
            //recorrer desde la pagina 2 hasta el total (page=42)
            for($i=2; $i<=$totalPages; $i++) {
                $response = Http::get($this->apiUrl.'?page='.$i);
                $decodeResponse = json_decode($response);
                $results = array_merge($results, $decodeResponse->results);
            }

            foreach ($results as $character) {
                $this->info($character->id.'-'.$character->name);
                Character::firstOrCreate([
                    'id' => $character->id,
                    'name' => $character->name,
                    'status' => $character->status,
                    'species' => $character->species,
                    'type' => $character->type,
                    'gender' => $character->gender,
                    'origin' => $character->origin->name,
                    'location' => $character->location->name,
                    'image' => $character->image,
                ]);
            }
        }else{
            $this->info('Your database is synchronized with the rick and morty API!');
        }
        
    }
}