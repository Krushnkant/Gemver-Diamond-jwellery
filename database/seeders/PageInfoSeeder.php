<?php

namespace Database\Seeders;

use App\Models\Infopage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pageinfo')->truncate();
        Infopage::create([
            'id' => 1
        ]);
    }
}
