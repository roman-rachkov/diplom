<?php

namespace App\Orchid\Screens\Discount;

use App\Models\Discount;
use App\Models\DiscountGroup;
use App\Orchid\Layouts\Discounts\DiscountListener;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class DiscountFormScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name;
    private bool $exist;

    public function __construct()
    {
        $this->name = __('admin.discounts.add_discount');
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Discount $discount): array
    {
        $this->exist = $discount->exists;

        if ($this->exist) {
            $this->name = __('admin.discounts.edit');
        }

        $this->discount = $discount;
        $this->discount->load(['discountGroups.products', 'discountGroups.categories']);
        $this->discount->discountGroups['count'] = $this->discount->discountGroups()->count();
        return [
            'discount' => $this->discount
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
            Button::make(__('admin.discounts.save'))
                ->method('createOrUpdate')
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
            DiscountListener::class
        ];
    }

    public function asyncFields(array $args)
    {
        $discount = Discount::findOrNew($args['id']);
        $discount->fill($args);
        $discount->load(['discountGroups.products', 'discountGroups.categories']);
        $discount->discountGroups['count'] = $args['discountGroups']['count'] ?? $discount->discountGroups()->count();
        return [
            'discount' => $discount
        ];
    }

    public function createOrUpdate()
    {
        $data = request()->except('_token');
        $data = $data['discount'];
        if (isset($data['discountGroups'])) {
            $groups = $data['discountGroups'];
            unset($data['discountGroups']);
            unset($groups['count']);
        }
        $discount = Discount::findOrNew($data['id']);
        $discount->fill($data);
        $discount->save();
        if (isset($groups)) {
            $this->updateGroups($discount, $groups);
        }
        Toast::success(__('admin.discounts.saved'));
        return redirect()->route('platform.discounts');
    }

    private function updateGroups(Discount $discount, array $groups)
    {
        $groups = $this->createOrUpdateGroups($groups);
        $discount->discountGroups->diff($groups)->each(function ($group) {
            $group->delete();
        });
        $groups->each(function ($group) use ($discount) {
            $group->discount()->associate($discount);
            $group->save();
        });
    }

    private function createOrUpdateGroups(array $groups)
    {
        $collection = collect();
        foreach ($groups as $group) {
            $tmpGroup = DiscountGroup::findOrNew($group['id']);
            $tmpGroup->title = $group['title'];
            $tmpGroup->save();
            $tmpGroup->products()->sync($group['products'] ?? []);
            $tmpGroup->categories()->sync($group['categories'] ?? []);
            $collection->push($tmpGroup);
        }
        return $collection;
    }

}
