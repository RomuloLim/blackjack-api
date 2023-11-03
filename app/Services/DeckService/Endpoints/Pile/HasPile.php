<?php

namespace App\Services\DeckService\Endpoints\Pile;

trait HasPile
{
    public function piles(): Pile
    {
        return new Pile();
    }
}
