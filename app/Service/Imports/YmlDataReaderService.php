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
            $offers = $yml->offers->children();
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
        $url = parse_url($url->__toString())['path'];
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
            'limited_edition' =>  $this->getLimitedEdition($offer),
            'category_id' => $this->getYmlIdAttribute($offer->category),
            'seller_id' => $this->getYmlIdAttribute($offer->shop),
            'manufacturer_id' => $this->getYmlIdAttribute($offer->manufacturer),
            'price' => floatval($offer->price->__toString())
        ];
    }

    protected function getYmlIdAttribute(\SimpleXMLElement $yml): string|int
    {
        if (is_null($yml->attributes())) return '';

        return is_null($yml->attributes()['id']) ?
            0 :
            (int) $yml->attributes()['id']->__toString();
    }

    protected function getLimitedEdition(\SimpleXMLElement $offer):bool
    {
        $results = [
            'true' => true,
            'false' => false,
        ];

        if (array_key_exists($key = $offer->limited_edition->__toString(), $results)) {
            return $results[$key];
        }

        return false;
    }
}