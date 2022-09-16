<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SmilingDifference;
use Illuminate\Support\Facades\DB;

class SmilingDifferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('smiling_differences')->truncate();

        SmilingDifference::create([
            'id' => 1,
            'title' => 'Lab Grown Diamond',
            'shotline' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
        ]);

        SmilingDifference::create([
            'id' => 2,
            'title' => 'Economic Green',
            'shotline' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
        ]);

        SmilingDifference::create([
            'id' => 3,
            'title' => 'Hand Made Jewellry',
            'shotline' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
        ]);

        SmilingDifference::create([
            'id' => 4,
            'title' => '100% Certified Diamonds',
            'shotline' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
        ]);
    }
}
