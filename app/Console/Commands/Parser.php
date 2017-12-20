<?php

namespace App\Console\Commands;

use App\Preskok\Junior\Practical;
use Illuminate\Console\Command;

/**
 * Class AutomatedCharges automatically charges merchants when necessary
 * @package App\Console\Commands
 */
class Parser extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parser:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Junior Practical';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info(sprintf('*** STARTING %s ***', __CLASS__));

        $this->line("Starting parsing");

        $c = new Practical();
        $c->parse();
        $c->mapBuyers();


        $this->info(sprintf('*** FINISHED %s ***', __CLASS__));
    }

}