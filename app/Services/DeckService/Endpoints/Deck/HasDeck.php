<?php

namespace App\Services\DeckService\Endpoints\Deck;

trait HasDeck
{
    public function decks()
    {
        return new Deck();
    }
}
