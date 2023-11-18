<?php

namespace App\Services\DeckService\Entities;

class Card
{
    public string $code;
    public string $value;
    public string $suit;
    public string $image;

    /** @var array<string> */
    public array $images;

    /**
     * @param array<string|array, mixed> $attributes
     */
    public function __construct(array $attributes)
    {
        $this->code = data_get($attributes, 'code');
        $this->image = data_get($attributes, 'image');
        $this->suit = data_get($attributes, 'suit');
        $this->value = data_get($attributes, 'value');
        $this->images = data_get($attributes, 'images');
    }
}
