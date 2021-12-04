<?php

namespace App\Service\Imports;

use App\Exceptions\DataReaderException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class JsonDataReaderService extends AbstractDataReaderService
{
    /**
     * @throws DataReaderException
     */
    public function getData(): Collection
    {
        $content = file_get_contents($this->file->getRealPath());
        if ($content === false) {
            throw new DataReaderException('Ошибка чтения файла импорта');
        }

        $products = json_decode($content, true);
        if ($products === null) {
            throw new DataReaderException('Файл не может быть преобразован');
        }

        return $this->getProductImportDTOs($products);

    }

    protected function getProductImportDTOs(array $products): Collection
    {
        $elementIndex = 0;
        $offersDTOs = [];
        foreach ($products as $product) {
            if (!empty($validItem = $this->validate($product, $elementIndex))) {
                $offersDTOs[] = $this->getProductImportDTO($validItem);
            }
            $elementIndex++;
        }
        return collect($offersDTOs);
    }
}
