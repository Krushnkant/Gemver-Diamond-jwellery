<?php

namespace Database\Seeders;

use App\Models\ProjectPage;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CertificatePriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          ProjectPage::create([ 
            'id' => 77, 
            'parent_menu' => 57, 
            'label' => 'Certificate Settings', 
            'is_display_in_menu' => 1,
            'route_url' => 'admin.certificatesettings',  
            'inner_routes' => 'admin.certificatesettings,admin.menupage.updatecertificatesettings', 
        ]);

        $users = User::where('role',"!=",1)->get();
        $project_page_ids = ProjectPage::where('id',77)->where('parent_menu',57)->where('is_display_in_menu',1)->pluck('id')->toArray();
        foreach ($users as $user){
            foreach ($project_page_ids as $pid){
                $user_permission = UserPermission::where('user_id',$user->id)->where('project_page_id',$pid)->first();
                if (!$user_permission){
                    $userpermission = new UserPermission();
                    $userpermission->user_id = $user->id;
                    $userpermission->project_page_id = $pid;
                    $userpermission->save();
                }
            }
        }
    }
}
