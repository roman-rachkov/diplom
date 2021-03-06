<?php

namespace App\Orchid\Screens\Import;

use App\Jobs\ImportProducts;
use App\Orchid\Layouts\Import\AwaitLayout;
use App\Orchid\Layouts\Import\ErrorLayout;
use App\Orchid\Layouts\Import\MonitoringLayout;
use App\Orchid\Layouts\Import\SuccessLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class ImportMainScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = '';

    public function __construct()
    {
        $this->name = __('import.mainscreen.title');
        $this->description = __('import.mainscreen.description', ['queue' => Queue::size('import')]);

    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $this->hasQueue = Queue::size('import') === 0 ? true : false;
        return [
            'awaitFiles' => $this->getFileFromImportDir('import-await'),
            'successFiles' => $this->getFileFromImportDir('import-success'),
            'errorFiles' => $this->getFileFromImportDir('import-error'),
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            ModalToggle::make(__('import.mainscreen.uploadFile'))
                ->modal('addImportFiles')
                ->method('uploadFilesForImport')
                ->icon('cloud-upload')
                ->modalTitle(__('import.mainscreen.modalTitle')),

            Button::make(__('import.mainscreen.starAllImport'))
                ->icon('control-play')
                ->method('starAllImport')
                ->canSee($this->hasQueue),

        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::tabs([
                __('import.mainscreen.awaitImport') => [AwaitLayout::class],
                __('import.mainscreen.successImport') => [SuccessLayout::class],
                __('import.mainscreen.errorImport') => [ErrorLayout::class],
            ]),

            Layout::modal('addImportFiles', Layout::rows([
                Upload::make('file')
                    ->storage('import-await')
                    ->acceptedFiles('.json,.xml')
            ]))->title(__('admin_config.editing'))
                ->applyButton(__('import.mainscreen.uploadAllFile'))
                ->method('uploadFilesForImport')
                ->withoutCloseButton(),
        ];
    }

    public function getFileFromImportDir($storageName)
    {
        return Attachment::where('disk', $storageName)->get();
    }

    public function uploadFilesForImport(Request $request)
    {
        Toast::info(__('import.message.successUploadFiles'));
    }

    public function startImportForOneFile(Attachment $attachment)
    {
        ImportProducts::dispatch($attachment)->onQueue('import');
        Toast::info(__('import.message.successStartOneFileImport', ['filename' => $attachment->original_name]));
    }

    public function starAllImport()
    {
        foreach (Attachment::where('disk', 'import-await')->get() as $file) {
            ImportProducts::dispatch($file)->onQueue('import');
        }
        Toast::info(__('import.message.successStartAllFileImport'));
    }

    public function asyncQueue()
    {

    }
}
