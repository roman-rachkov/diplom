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
            $this->file->update(['disk' => 'import-success']);
            $awaitFile->delete();
            Log::info('import success for file: ' . $this->file->path . $this->file->name . '.' .  $this->file->extension);
        } catch (\Exception $e) {
            Log::info('import fail: ' . $e->getMessage());
            $awaitFile = Storage::disk('import-await')->get($this->file->physicalPath());
            Storage::disk('import-error')->put( $this->file->path . $this->file->name . '.' .  $this->file->extension, $awaitFile);
            $this->file->update(['disk' => 'import-error']);
            $awaitFile->delete();
        }
    }
}
