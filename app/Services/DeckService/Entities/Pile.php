<?php

namespace App\Services\DeckService\Entities;

use Illuminate\Support\Collection;

class Pile
{

    /**
     * @var Collection<array,Card>
     */
    public Collection $cards;
    public string $name;
    public int $remaining;

    public function __construct(array $attributes)
    {
        $this->name = data_get($attributes, 'name');
        $this->remaining = data_get($attributes, 'remaining');
        $this->cards = collect(data_get($attributes, 'cards'))->map(fn ($card) => new Card($card));
    }
}
