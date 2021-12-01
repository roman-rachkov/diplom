<?php

namespace App\Service\Imports;

use App\Contracts\Service\Imports\DataReaderContract;
use App\DTO\DataTransferObjectInterface;
use App\DTO\ProductImportDTO;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\File\File;

abstract class AbstractDataReaderService implements DataReaderContract
{
    protected array $errorsLog = [];

    public function __construct(protected File $file)
    {}

    public function getErrorsLog(): array
    {
        return $this->errorsLog;
    }

    protected function validate(array $preparedOffer, int $elementIndex): array
    {
        $validator = Validator::make($preparedOffer, [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'description' => 'required',
            'full_description' => 'required',
            'limited_edition' => 'required',
            'category_id' => 'required',
            'seller_id' => 'required',
            'manufacturer_id' => 'required',
            'price' => 'required'
        ]);

        if ($validator->fails()) {
            $this->errorsLog[$elementIndex] = $validator->errors()->toArray();
            return [];
        }

        return $validator->validated();
    }

    protected function getProductImportDTO(array $validItem): DataTransferObjectInterface
    {
        return ProductImportDTO::create([
            $validItem['name'],
            $validItem['slug'],
            $validItem['description'],
            $validItem['full_description'],
            $validItem['limited_edition'],
            $validItem['category_id'],
            $validItem['manufacturer_id'],
            $validItem['seller_id'],
            $validItem['price'],
        ]);
    }

}