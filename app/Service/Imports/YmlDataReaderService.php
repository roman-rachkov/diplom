<?php

namespace App\Service\Imports;

use App\Exceptions\DataReaderException;
use Illuminate\Support\Collection;

class YmlDataReaderService extends AbstractDataReaderService
{

    /**
     * @throws DataReaderException
     */
    public function getData(): Collection
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

    protected function getSlugFromUrl(\SimpleXMLElement $url): string
    {
        $url = explode('?', $url->__toString())[0];
        return array_slice(explode('/', $url), -1)[0];
    }


    protected function getProductImportDTOs(\SimpleXMLElement $offers): Collection
    {
        $elementIndex = 0;
        $offersDTOs = [];
        foreach ($offers as $offer) {
            if (!empty($validItem = $this->validate($this->prepareOfferForValidation($offer), $elementIndex))) {
                $offersDTOs[] = $this->getProductImportDTO($validItem);
            }
            $elementIndex++;
        }
        return collect($offersDTOs);
    }

    protected function prepareOfferForValidation(\SimpleXMLElement $offer): array
    {
        return [
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