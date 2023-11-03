<?php

namespace App\Services\DeckService\Endpoints\Deck;

use App\Services\DeckService\CardService;
use Illuminate\Http\Client\Response;

class Deck
{
    public CardService $cardService;

    public function __construct()
    {
        $this->cardService = new CardService();
    }

    public function create(?int $amount = 1, ?bool $shuffle = true): Response
    {
        if ($shuffle) {
            return $this->cardService->api->get("/new/shuffle/?deck_count=$amount");
        }

        return $this->cardService->api->get("/new/?deck_count=$amount");
    }

    public function draw(string $deckId, int $amount = 1): Response
    {
        return $this->cardService->api->get("/$deckId/draw/?count=$amount");
    }
}
