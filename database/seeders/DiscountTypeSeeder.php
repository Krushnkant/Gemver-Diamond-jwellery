<?php

namespace Database\Seeders;

use App\Models\DiscountType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discount_types')->truncate();

        DiscountType::create([
            'title' => 'Percentage',
        ]);

        DiscountType::create([
            'title' => 'Fixed',
        ]);
    }
}
