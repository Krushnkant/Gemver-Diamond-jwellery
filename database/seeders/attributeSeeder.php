<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class attributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attribute::create([
            'id' => 1,
            'attribute_name' => 'Metal Type',
            'display_attrname' => 'Metal Type',
            'estatus' => 1,
            'is_specification' => 0,
            'is_filter' => 0,
            'is_dropdown' => 0,
            'is_description' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
