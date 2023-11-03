<?php

namespace App\Services\DeckService\Endpoints\Pile;

use App\Services\DeckService\CardService;

class Pile
{
    private CardService $cardService;
    private string $deckId;
    private string $currentPile;

    public function __construct()
    {
        $this->cardService = new CardService();
    }

    public function fromDeck(string $deckId, string $pileName = 'default')
    {
        $this->deckId = $deckId;
        $this->currentPile = $pileName;


        return $this;
    }

    public function list()
    {
        return $this->cardService->api->get("/{$this->deckId}/pile/{$this->currentPile}/list");
    }
}
