<?php

namespace App\Services\DeckService\Endpoints\Deck;

trait HasDeck
{
    public function decks(): Deck
    {
        return new Deck();
    }
}
