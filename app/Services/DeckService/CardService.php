<?php

namespace App\Services\DeckService;

use App\Services\DeckService\Endpoints\Deck\HasDeck;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class CardService
{
    use HasDeck;

    public PendingRequest $api;

    public function __construct()
    {
        $this->api = Http::baseUrl('https://www.deckofcardsapi.com/api/deck');
    }
}
