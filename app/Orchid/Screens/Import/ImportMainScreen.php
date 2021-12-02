<?php

namespace App\Orchid\Screens\Import;

use App\Orchid\Layouts\Import\AwaitLayout;
use App\Orchid\Layouts\Import\ErrorLayout;
use App\Orchid\Layouts\Import\MonitoringLayout;
use App\Orchid\Layouts\Import\SuccessLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Orchid\Attachment\File;
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
        $this->description = __('import.mainscreen.description');
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'awaitFiles' => $this->getFileFromImportDir('import-await'),
            'successFiles' => $this->getFileFromImportDir('import-success'),
            'errorFiles' => $this->getFileFromImportDir('import-error'),
            'monitoring' => [],
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
                ->method('starAllImport'),

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
                __('import.mainscreen.monitoringImport') => [MonitoringLayout::class],
            ]),

            Layout::modal('addImportFiles', Layout::rows([
                Upload::make('file')
                    ->storage('import-await')
                    ->acceptedFiles('application/json,.yml')
            ]))->title(__('admin_config.editing'))
                ->applyButton(__('import.mainscreen.uploadAllFile'))
                ->method('uploadFilesForImport')
                ->withoutCloseButton(),
        ];
    }

    public function getFileFromImportDir($storageName)
    {
        $storage = Storage::disk($storageName);
        $filesArr = $storage->allFiles();

        return array_map( function ($path) use ($storage) {
            $fullPath = $path;
            $explode = explode('/', $path);
            $fileName = $explode[count($explode) - 1];
            $extention = explode('.', $fileName)[1];
            return [
                'path' => $fullPath,
                'name' => $fileName,
                'extention' => $extention,
                'filetime' => $storage->lastModified($path),
            ];
        }, $filesArr);
    }

    public function uploadFilesForImport(Request $request)
    {
        Toast::info(__('import.message.successUploadFiles'));
    }

    public function startImportForOneFile(Request $request)
    {

    }
}
