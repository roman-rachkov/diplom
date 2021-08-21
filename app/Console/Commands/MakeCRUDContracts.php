<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MakeCRUDContracts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud_contracts 
                            {model : Model name with first capital letter} 
                            {--only= : Contracts and services should to create (cr - create u - update d - destroy)} 
                            {--provider : If need to create provider with boot all contracts and services in}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create CRUD service contracts, services, provider for given model';

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
        $model = $this->argument('model');
        $methodsSignatures = [
            'create' => 'create(array $attributes)',
            'update' => 'update(array $attributes, string $id)',
            'destroy' =>'destroy(string $id)'
        ];

        if ($this->option('only')) {
            foreach (['cr' => 'create', 'u' => 'update', 'd' => 'destroy'] as $abbr => $method) {
                if (!str_contains($this->option('only'), $abbr)) unset($methodsSignatures[$method]);
            }
        }

        $contractsDirectory = 'Contracts' . DIRECTORY_SEPARATOR . 'Service' . DIRECTORY_SEPARATOR . $model;
        $serviceDirectory = 'Service' . DIRECTORY_SEPARATOR . $model;
        $appBindings = '';
        $providerUses = '';

        //Storage::makeDirectory($contractsDirectory);

        foreach ($methodsSignatures as $method => $signature) {

            $serviceName = Str::ucfirst($method) . $model . 'Service';
            $contractName = $serviceName . 'Contract';

            $appBindings .= '$this->app->singleton(' .
                $contractName . '::class, ' .
                $serviceName . '::class);' .
                PHP_EOL . '        ';
            $providerUses .=
                "use App\Contracts\Service\\$model\\$contractName;" . PHP_EOL .
                "use App\Service\\$model\\$serviceName;" . PHP_EOL;

            $contractContent = <<<EOT
            <?php

            namespace App\Contracts\Service\\$model;

            interface $contractName
            {
                public function $signature;
            }
            EOT;

            $serviceContent = <<<EOT
            <?php

            namespace App\Service\\$model;
            
            use App\Contracts\Service\\$model\\$contractName;
            
            class $serviceName implements $contractName
            {
            
                public function $signature
                {
                    // TODO: Implement $method() method.
                }
            }
            EOT;

            Storage::disk('app')
                ->put(
                    $contractsDirectory . DIRECTORY_SEPARATOR .  $contractName . '.php',
                    $contractContent
                );
            Storage::disk('app')
                ->put(
                    $serviceDirectory . DIRECTORY_SEPARATOR .  $serviceName . '.php',
                    $serviceContent
                );
        }

        if ($this->option('provider')) {
            $providerContent = <<<EOT
        <?php

        namespace App\Providers;
        
        $providerUses
        use Illuminate\Support\ServiceProvider;
        
        class {$model}ServiceProvider extends ServiceProvider
        {
            /**
             * Register services.
             *
             * @return void
             */
            public function register()
            {
                //
            }
        
            /**
             * Bootstrap services.
             *
             * @return void
             */
            public function boot()
            {
                $appBindings
            }
        }
        EOT;

            Storage::disk('app')
                ->put(
                    'Providers\\' . "{$model}ServiceProvider.php",
                    $providerContent
                );
        }



//        $directory  = 'Contracts';
//        $addedNamespace = '';
//
//        if ($this->option('directory')) {
//
//            $addedNamespace = '\\' . $this->option('directory');
//            $directory .= DIRECTORY_SEPARATOR . $this->option('directory');
//            Storage::makeDirectory($directory);
//        }
//
//        $directory .= DIRECTORY_SEPARATOR;
//
//        $fileContents = <<<EOT
//            <?php
//
//            namespace App\Contracts$addedNamespace;
//
//            interface {$this->argument('contract')}Contract
//            {
//                //TODO: write method...
//            }
//
//            EOT;
//
//        $written = Storage::disk('app')->put($directory . $this->argument('contract') .'Contract.php', $fileContents);
//
//        if($written) {
//            $this->info('Created new Contract ' . $this->argument('contract') .'Contract.php in App\Contracts' . $addedNamespace);
//        } else {
//            $this->info('Something went wrong');
//        }

    }
}
