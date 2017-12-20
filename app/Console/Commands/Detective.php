<?php

namespace App\Console\Commands;

use App\Preskok\Junior\ForensicComputerScientist;
use Illuminate\Console\Command;

/**
 * Class AutomatedCharges automatically charges merchants when necessary
 * @package App\Console\Commands
 */
class Detective extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'detective:find';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find murderer';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info(sprintf('*** STARTING %s ***', __CLASS__));

        $c = new ForensicComputerScientist();
        $c->find();


        $this->info(sprintf('*** FINISHED %s ***', __CLASS__));
    }

}