<?php

namespace Database\Seeders;

use App\Enums\CategoryTypeEnum;
use App\Models\Category;
use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (CategoryTypeEnum::cases() as $type) {
            ProductType::updateOrCreate(
                ['name' => ucfirst($type->value)]
            );
        }

        $assetName = ucfirst(CategoryTypeEnum::ASSET->value);
        $assetType = ProductType::where('name', $assetName)->first();

        if ($assetType) {
            Category::updateOrCreate(
                ['name' => 'IT Products'],
                ['product_type_id' => $assetType->id]
            );
        }
    }
}
