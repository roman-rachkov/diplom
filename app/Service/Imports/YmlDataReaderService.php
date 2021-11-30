<?php

namespace App\Service\Imports;

use App\Contracts\Service\Imports\DataReaderContract;
use App\DTO\DataTransferObjectInterface;
use App\DTO\ProductImportDTO;
use App\Exceptions\DataReaderException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\File\File;

class YmlDataReaderService implements DataReaderContract
{
    private array $errorsLog = [];

    public function __construct(private File $file)
    {}

    /**
     * @throws DataReaderException
     */
    public function getData(): string|Collection
    {
        $yml = simplexml_load_file($this->file->getRealPath());

        try {
            $offers = $yml->shop->offers->children();
        } catch (\Throwable $e) {
            throw new DataReaderException('Неверный формат файла');
        }

        if (!is_null($offers)) {
            return $this->getProductImportDTOs($offers);

        }

        return collect();
    }

    public function getErrorsLog(): array
    {
        return $this->errorsLog;
    }

    protected function getSlugFromUrl(\SimpleXMLElement $url): string
    {
        $url = explode('?', $url->__toString())[0];
        return array_slice(explode('/', $url), -1)[0];
    }


    public function getProductImportDTOs(\SimpleXMLElement $offers): Collection
    {
        $elementIndex = 0;
        $offersDTOs = [];
        foreach ($offers as $offer) {
            if (!empty($validOffer = $this->validate($this->prepareOfferForValidation($offer, $elementIndex)))) {
                $offersDTOs[] = $this->getProductImportDTO($validOffer);
            }
            $elementIndex++;
        }
        return collect($offersDTOs);
    }

    public function getProductImportDTO(array $validOffer): DataTransferObjectInterface
    {
        return ProductImportDTO::create([
            $validOffer['name'],
            $validOffer['slug'],
            $validOffer['description'],
            $validOffer['full_description'],
            $validOffer['limited_edition'],
            $validOffer['category_id'],
            $validOffer['manufacturer_id'],
            $validOffer['seller_id'],
            $validOffer['price'],
        ]);
    }

    public function validate(array $preparedOffer): array
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
            $this->errorsLog[$preparedOffer['elementIndex']] = $validator->errors()->toArray();
            return [];
        }

        return $validator->validated();
    }

    public function prepareOfferForValidation(\SimpleXMLElement $offer, int $elementIndex): array
    {
        return [
            'elementIndex' => $elementIndex,
            'name' => $offer->name->__toString(),
            'slug' => $this->getSlugFromUrl($offer->url),
            'description' => mb_substr($offer->description->__toString(), 0, 255),
            'full_description' => mb_substr($offer->description->__toString(), 0, 1000),
            'limited_edition' => false,
            'category_id' => 111,
            'seller_id' => 111,
            'manufacturer_id' => 111,
            'price' => floatval($offer->price->__toString())
        ];
    }
}