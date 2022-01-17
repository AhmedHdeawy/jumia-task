<?php
namespace App\Repositories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CustomerRepositiory
{
    public $model;

    public function __construct()
    {
        $this->modelClass();
    }

    public function search(array $data)
    {
        $customers = $this->model;

        // Apply Database Filters
        $customers = $this->applyFilters($customers, $data);

        $customers = $customers->get();
        
        // Apply Appends Filters
        return $this->applyAppendsFilters($customers, $data);
    }

    /**
     * @param Builder $query
     * 
     * @return Builder
     */
    private function applyFilters(Builder $query, array $data)
    {
        if (isset($data['state']) && !empty($data['state']) ) {
            $query = $query->where('state', $data['state']);
        }

        // You Can Add Extra Filters Here

        return $query;
    }


    /**
     * @param Collection $collection
     * 
     * @return Collection
     */
    private function applyAppendsFilters(Collection $collection, array $data)
    {
        if (isset($data['country']) && !empty($data['country']) ) {
            $collection = $collection->where('country', '=',  $data['country'] );
        }
        // dd($collection->values());
        return $collection->values();
    }

    private function modelClass()
    {
        $this->model = Customer::query();
    }
}