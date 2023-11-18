<?php

namespace App\Services\DeckService\Endpoints\Pile;

use App\Services\DeckService\CardService;
use App\Services\DeckService\Entities\Card;
use App\Services\DeckService\Entities\Deck;
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

    public function list(): Deck
    {
        $response = $this->cardService->api->get("/{$this->deckId}/pile/{$this->currentPile}/list");

        return new Deck($response->json());
    }

    public function add(array $cards): Deck
    {
        $formattedCards = implode(',', $cards);

        $response = $this->cardService->api->get("/{$this->deckId}/pile/{$this->currentPile}/add?cards=$formattedCards");

        return new Deck($response->json());
    }
}
