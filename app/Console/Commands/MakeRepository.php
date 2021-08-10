<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository 
                            {model : Model name with first capital letter}
                            {--m=* : Methods signatures for contract and repository}
                            {--c : Repository with contract?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

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
        $model = $this->argument('model');
        $isCreatingContract = $this->option('c');

        $repositoryMethods = '';

        if ($methods = $this->option('m')) {
            foreach ($methods as $signature) {

                $repositoryMethods .= <<<EOT
                
                    public function $signature()
                    {
                    
                    }
                    
                EOT;
            }
        }

        $implementation = '';
        $uses ='';

        if ($isCreatingContract) {
            $implementation = ' implements ' . $model . 'RepositoryContract';
            $uses = PHP_EOL . 'use App\Contracts\Repository\\' . $model . 'RepositoryContract;' . PHP_EOL;
            Artisan::call(
                'make:contract',
                [
                    'name' => $model . 'RepositoryContract',
                    '--d' => 'Repository',
                    '--m' => $methods
                ]
            );

        }

        $repositoryName = $model . 'Repository';

        $repositoryContent = <<<EOT
        <?php
        
        namespace App\Repository;
        $uses
        class $repositoryName{$implementation}
        {
            $repositoryMethods
        }
        EOT;

        Storage::disk('app')
            ->put(
                'Repository' . DIRECTORY_SEPARATOR .  $repositoryName . '.php',
                $repositoryContent
            );
    }
}
