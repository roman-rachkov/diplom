<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service 
                            {service : Service name}
                            {--m=* : Methods signatures for contract and service}
                            {--c : Service with contract?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $service = $this->argument('service');
        $isCreatingContract = $this->option('c');

        $serviceMethods = '';

        if ($methods = $this->option('m')) {
            foreach ($methods as $signature) {

                $serviceMethods .= <<<EOT
                
                    public function $signature()
                    {
                    
                    }
                    
                EOT;
            }
        }

        $implementation = '';
        $uses ='';

        if ($isCreatingContract) {
            $implementation = ' implements ' . $service . 'ServiceContract';
            $uses = PHP_EOL . 'use App\Contracts\Service\\' . $service . 'ServiceContract;' . PHP_EOL;
            Artisan::call(
                'make:contract',
                [
                    'name' => $service . 'ServiceContract',
                    '--d' => 'Service',
                    '--m' => $methods
                ]
            );

        }

        $serviceName = $service . 'Service';

        $serviceContent = <<<EOT
        <?php
        
        namespace App\Service;
        $uses
        class $serviceName{$implementation}
        {
            $serviceMethods
        }
        EOT;

        Storage::disk('app')
            ->put(
                'Service' . DIRECTORY_SEPARATOR .  $serviceName . '.php',
                $serviceContent
            );
    }
}
