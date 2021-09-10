<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // Need to add this in Laravel 8 

class ProductsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = App\Models\Products::class; // added App\Models\Products here 

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //
    }
}
