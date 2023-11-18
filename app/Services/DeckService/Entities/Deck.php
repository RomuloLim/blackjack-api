<?php

namespace App\Services\DeckService\Entities;

use Illuminate\Support\Collection;

class Deck
{
    /**
     * @var Collection<array,Pile>
     */
    public ?Collection $piles;
    public bool $success;
    public string $deckId;
    public int $remaining;

    public function __construct(array $attributes)
    {
        $this->success = data_get($attributes, 'success');
        $this->deckId = data_get($attributes, 'deck_id');
        $this->remaining = data_get($attributes, 'remaining');
        $this->piles = collect(data_get($attributes, 'piles'))->map(function ($pile, $name) {
            return new Pile(['name' => $name, ...$pile]);
        });
    }
}
