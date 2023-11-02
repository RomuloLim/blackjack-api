<?php

namespace App\Console\Commands;

use App\Services\DeckService\CardService;
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
    public function handle()
    {
        $service = new CardService();

        $deck = $service->decks()->create();

        dd($deck->object());
    }
}
