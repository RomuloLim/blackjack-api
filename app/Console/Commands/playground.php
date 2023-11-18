<?php

namespace App\Console\Commands;

use App\Services\DeckService\CardService;
use App\Services\DeckService\Entities\Card;
use App\Services\DeckService\Entities\Pile;
use Illuminate\Console\Command;

class playground extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'playground';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $service = app(CardService::class)->piles();

        $deck = $service->fromDeck('3kxnutiwzzis', 'dealer')->list();

//        $deck->piles->first()->

    }
}
