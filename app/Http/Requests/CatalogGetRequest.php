<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatalogGetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function getCurrentPage(): int
    {
        return $this->get('page') ?? 1;
    }

    public function getMinPrice(): ?float
    {
        return $this->get('minPriceChoice') ?? null;
    }

    public function getMaxPrice(): ?float
    {
        return $this->get('maxPriceChoice') ?? null;
    }

    public function getSearch(): ?string
    {
        return $this->get('search') ?? null;
    }

    public function getSeller(): ?string
    {
        return $this->get('seller') ?? null;
    }

    public function getOrderBy(): ?string
    {
        return $this->get('order_by') ?? null;
    }

    public function getOrderDirection(): ?string
    {
        return $this->get('order_direction') ?? null;
    }

}
