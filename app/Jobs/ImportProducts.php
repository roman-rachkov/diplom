<?php

namespace App\Jobs;

use App\Contracts\Service\Imports\DataReaderFactoryServiceContract;
use App\Contracts\Service\Imports\ProductsImportServiceContract;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Orchid\Attachment\Models\Attachment;
use Symfony\Component\HttpFoundation\File\File;

class ImportProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Attachment $file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ProductsImportServiceContract $importServiceContract, DataReaderFactoryServiceContract $dataReaderFactoryServiceContract)
    {
        try {
            $importServiceContract->import( $dataReaderFactoryServiceContract->getReaderByFile(
                new File( Storage::disk($this->file->disk)->path($this->file->physicalPath()))
            ));

            $awaitFile = Storage::disk('import-await')->get($this->file->physicalPath());
            Storage::disk('import-success')->put( $this->file->path . $this->file->name . '.' .  $this->file->extension, $awaitFile);
            Storage::disk('import-await')->delete($this->file->physicalPath());
            $this->file->update(['disk' => 'import-success']);
        } catch (\Exception $e) {
            $awaitFile = Storage::disk('import-await')->get($this->file->physicalPath());
            Storage::disk('import-error')->put( $this->file->path . $this->file->name . '.' .  $this->file->extension, $awaitFile);
            Storage::disk('import-await')->delete($this->file->physicalPath());
            $this->file->update(['disk' => 'import-error']);
        }
    }
}
