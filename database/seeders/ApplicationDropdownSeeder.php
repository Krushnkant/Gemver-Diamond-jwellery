<?php

namespace Database\Seeders;

use App\Models\ApplicationDropdown;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationDropdownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('application_dropdowns')->truncate();

        ApplicationDropdown::create([
            'title' => 'None',
        ]);

        ApplicationDropdown::create([
            'title' => 'Product',
        ]);

        ApplicationDropdown::create([
            'title' => 'Category',
        ]);

        ApplicationDropdown::create([
            'title' => 'Url',
        ]);
    }
}
