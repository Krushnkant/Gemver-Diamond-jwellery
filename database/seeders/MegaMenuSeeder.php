<?php

namespace Database\Seeders;

use App\Models\MegaMenu;
use App\Models\SubMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MegaMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mega_menus')->truncate();
        DB::table('sub_menus')->truncate();

        MegaMenu::create([
            'title' => 'Engagement Ring',
            'menu_thumb' => '',
            'redirect_url' => '/engagement',
        ]);

        MegaMenu::create([
            'title' => 'Wedding Ring',
            'menu_thumb' => '',
            'redirect_url' => '/weddingbands',
        ]);

        MegaMenu::create([
            'title' => 'Fine Jewelry',
            'menu_thumb' => '',
            'redirect_url' => '/finejewellery',
        ]);

        MegaMenu::create([
            'title' => 'Lab Grown Diamond',
            'menu_thumb' => '',
            'redirect_url' => '/labgrowndiamonds',
        ]);

        MegaMenu::create([
            'title' => 'Create Your Own',
            'menu_thumb' => '',
            'redirect_url' => '/custommadejewellery',
        ]);

        MegaMenu::create([
            'title' => 'About Us',
            'menu_thumb' => '',
            'redirect_url' => '/infopage/about-us',
        ]);

        $MegaMenus = MegaMenu::get();
        foreach ($MegaMenus as $MegaMenu){
            SubMenu::create([
                'title' => 'Column 1',
                'mega_menu_id' => $MegaMenu->id,
            ]);

            SubMenu::create([
                'title' => 'Column 2',
                'mega_menu_id' => $MegaMenu->id,
            ]);

            SubMenu::create([
                'title' => 'Column 3',
                'mega_menu_id' => $MegaMenu->id,
            ]);

            SubMenu::create([
                'title' => 'Column 4',
                'mega_menu_id' => $MegaMenu->id,
            ]);

        }
        
    }
}
