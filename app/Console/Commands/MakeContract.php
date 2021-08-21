<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class MakeContract extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:contract 
                            {name : Contract name}
                            {--m=* : Methods in contract}
                            {--d= : Deeper contract directory from App/Contracts}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new contract interface';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');

        $contractsMethods = '';

        if ($this->option('m')) {
            foreach ($this->option('m') as $signature) {

                $contractsMethods .= <<<EOT
                
                    public function $signature();
                    
                EOT;
            }
        }

        $addedNamespace = $this->option('d') ? '\\' . $this->option('d') : '';

        $contractContent = <<<EOT
        <?php

        namespace App\Contracts$addedNamespace;

        interface $name
        {
            $contractsMethods
        }
        EOT;

        $addedDirectory = $this->option('d') ? DIRECTORY_SEPARATOR . $this->option('d') : '';

        Storage::disk('app')
            ->put(
                'Contracts' . $addedDirectory . DIRECTORY_SEPARATOR .  $name . '.php',
                $contractContent
            );
    }
}
