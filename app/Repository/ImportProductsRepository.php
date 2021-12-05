<?php

namespace App\Repository;

use App\Contracts\Repository\ImportProductsRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\DTO\ProductImportDTO;
use App\Models\Price;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Mimey\MimeTypes;
use Orchid\Attachment\Models\Attachment;

class ImportProductsRepository implements ImportProductsRepositoryContract
{

    public function saveProduct(ProductImportDTO $product): Product
    {
        return $this->saveProducts(collect($product))->first();
    }

    public function saveProducts(Collection $productsDTO): Collection
    {
        $data = $this->prepareData($productsDTO);

        return $data->chunk(app(AdminSettingsServiceContract::class)->get('import.productsChunkSize', 100))
            ->map(function ($chunk) {
                return DB::transaction(function () use ($chunk) {

                    $chunk = $this->saveAttachments($chunk);

                    $created = Carbon::now();
                    $chunk = $chunk->map(function ($item) use ($created) {
                        $item['product']['created_at'] = $created;
                        return $item;
                    });

                    Product::insert($chunk->map(fn($item) => $item['product'])->toArray());
                    $products = Product::where('created_at', $created)->get();
                    $products->each(function ($product, $key) use ($chunk) {
                        $data = $chunk->where('price.product_slug', $product->slug)->first();
                        $data['price']['product_id'] = $product->id;
                        unset($data['price']['product_slug']);
                        Price::create($data['price']);
                    });

                    Storage::delete(Storage::allFiles('tmp'));

                    return $products;
                });
            });
    }

    protected function prepareData(Collection $productsDTO): Collection
    {
        $created = Carbon::now();
        return $productsDTO->map(function ($item) use ($created) {
            return [
                'image' => [
                    'path' => $item->image_path,
                ],
                'product' => [
                    'name' => $item->name,
                    'slug' => $item->slug,
                    'description' => $item->description,
                    'full_description' => $item->full_description,
                    'category_id' => $item->category_id,
                    'manufacturer_id' => $item->manufacturer_id,
                    'limited_edition' => $item->limited_edition,
                ],
                'price' => [
                    'seller_id' => $item->seller_id,
                    'price' => $item->price,
                    'product_slug' => $item->slug
                ]
            ];
        });
    }

    protected function saveAttachments(Collection $productsDTO): Collection
    {
        return $productsDTO->map(function ($item) {
            $image = $this->downloadImage($item['image']['path']);

            list($base, $path) = explode('/public/', $image->getPath());

            $data = [
                'name' => str_replace('.' . $image->extension(), '', $image->getFilename()),
                'original_name' => $image->getFilename(),
                'mime' => $image->getMimeType(),
                'extension' => $image->extension(),
                'size' => $image->getSize(),
                'path' => $path . DIRECTORY_SEPARATOR,
                'alt' => $image->getFilename()
            ];

            $item['image']['attachment'] = Attachment::create($data);
            $item['product']['main_img_id'] = $item['image']['attachment']->id;
            return $item;

        });
    }

    protected function downloadImage(string $path): File
    {
        if (isset(parse_url($path)['host'])) {
            $image = $this->getImageByUrl($path);
        } else {
            $path = resource_path('img' . DIRECTORY_SEPARATOR . 'imports' . DIRECTORY_SEPARATOR . $path);
            $image = new File($path, true);
        }

        $path = Storage::putFile(
            'public' . DIRECTORY_SEPARATOR
            . date('Y') . DIRECTORY_SEPARATOR
            . date('m') . DIRECTORY_SEPARATOR
            . date('d'),
            $image
        );
        return new File(Storage::path($path), true);
    }

    protected function getImageByUrl(string $url): File
    {
        $contents = file_get_contents($url);
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $type = $finfo->buffer($contents);
        $ext = (new MimeTypes())->getExtension($type);
        $tempPath = 'tmp' . DIRECTORY_SEPARATOR . hash('sha256', $contents . Carbon::now()) . '.' . $ext;
        Storage::put($tempPath, $contents);
        return new File(Storage::path($tempPath), true);
    }

}
