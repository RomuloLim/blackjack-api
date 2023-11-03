<?php

namespace App\Services\DeckService\Endpoints\Pile;

use App\Services\DeckService\CardService;
use Illuminate\Http\Client\Response;

class Pile
{
    private CardService $cardService;
    private string $deckId;
    private string $currentPile;

    public function __construct()
    {
        $this->cardService = new CardService();
    }

    public function fromDeck(string $deckId, string $pileName = 'default'): Pile
    {
        $this->deckId = $deckId;
        $this->currentPile = $pileName;


        return $this;
    }

    public function list(): Response
    {
        return $this->cardService->api->get("/{$this->deckId}/pile/{$this->currentPile}/list");
    }
}
