<?php

namespace Database\Seeders;

use App\Models\ProjectPage;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_pages')->truncate();

        ProjectPage::create([
            'id' => 1,
            'parent_menu' => 0,
            'label' => 'Users',
            'route_url' => null,
            'icon_class' => 'fa fa-users',
            'is_display_in_menu' => 1,
            'sr_no' => 2
        ]);

        ProjectPage::create([
            'id' => 2,
            'parent_menu' => 1,
            'label' => 'User List',
            'route_url' => 'admin.users.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.users.list,admin.users.addorupdate,admin.alluserslist,admin.users.changeuserstatus,admin.users.edit,admin.users.delete,admin.users.permission,admin.users.savepermission'
        ]);
        
        // ProjectPage::create([
        //     'id' => 3,
        //     'parent_menu' => 0,
        //     'label' => 'Category',
        //     'route_url' => 'admin.categories.list',
        //     'icon_class' => 'fa fa-list-alt',
        //     'is_display_in_menu' => 0,
        //     'inner_routes' => 'admin.categories.list,admin.categories.addorupdate,admin.allCategorylist,admin.categories.changeCategorystatus,admin.categories.edit,admin.categories.delete',
        //     'sr_no' => 2
        // ]);

        ProjectPage::create([
            'id' => 4,
            'parent_menu' => 0,
            'label' => 'Products',
            'route_url' => null,
            'icon_class' => 'icon-diamond',
            'is_display_in_menu' => 1,
            'sr_no' => 2
        ]);

        ProjectPage::create([
            'id' => 5,
            'parent_menu' => 4,
            'label' => 'Category',
            'route_url' => 'admin.categories.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.categories.list,admin.categories.add,admin.categories.save,admin.allcategorylist,admin.categories.changecategorystatus,admin.categories.delete,admin.categories.edit,admin.categories.uploadfile,admin.categories.removefile,admin.categories.checkparentcat'
        ]);

        ProjectPage::create([
            'id' => 6,
            'parent_menu' => 4,
            'label' => 'Attributes & Specifications',
            'route_url' => 'admin.attributes.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.attributes.list,admin.attributes.addorupdate,admin.allattributeslist,admin.attributes.edit,admin.attributes.delete,admin.attributes.chageattributestatus,admin.attributeTerms.list,admin.attributeTerms.addorupdate,admin.allattributesTermlist,admin.attributeTerms.chageattributeTermstatus,admin.attributeTerms.edit,admin.attributeTerms.delete'
        ]);

        ProjectPage::create([
            'id' => 7,
            'parent_menu' => 4,
            'label' => 'Product',
            'route_url' => 'admin.products.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.products.list,admin.products.add,admin.getAttrVariation,admin.addVariantbox,admin.products.save,admin.products.uploadfile,admin.products.removefile,admin.allproductlist,admin.products.edit,admin.products.changeproductstatus,admin.products.delete'
        ]);

        ProjectPage::create([
            'id' => 9,
            'parent_menu' => 4,
            'label' => 'Custom Product',
            'route_url' => 'admin.customproducts.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.customproducts.list,admin.products.add,admin.getAttrVariation,admin.addVariantbox,admin.products.save,admin.products.uploadfile,admin.products.removefile,admin.allcustomproductlist,admin.products.edit,admin.products.changeproductstatus,admin.products.delete'
        ]);
        

        // ProjectPage::create([
        //     'id' => 8,
        //     'parent_menu' =>17,
        //     'label' => 'Faqs',
        //     'route_url' => 'admin.faqs.list',
        //     'is_display_in_menu' => 1,
        //     'inner_routes' => 'admin.faqs.list,admin.faqs.addorupdate,admin.allfaqslist,admin.faqs.edit,admin.faqs.delete,admin.faqs.changeFaqsstatus',
        //     'sr_no' => 6
        // ]);
    
        ProjectPage::create([
            'id' => 10,
            'parent_menu' => 0,
            'label' => 'Settings',
            'route_url' => 'admin.settings.list',
            'icon_class' => 'fa fa-cog',
            'is_display_in_menu' => 0,
            'inner_routes' => 'admin.settings.list,admin.settings.edit',
            'sr_no' => 15
        ]);

        ProjectPage::create([
            'id' => 11,
            'parent_menu' => 17,
            'label' => 'About Us',
            'route_url' => 'admin.infopage.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.infopage.list,admin.infopage.editAboutus,admin.infopage.updateAboutus',
            'sr_no' => 7
        ]);
        // ProjectPage::create([
        //     'id' => 12,
        //     'parent_menu' => 17,
        //     'label' => 'Team Member',
        //     'route_url' => 'admin.teammembers.list',
        //     'is_display_in_menu' => 1,
        //     'inner_routes' => 'admin.teammembers.list,admin.teammembers.addorupdateteam,admin.allteamslist,admin.users.changeteamstatus,admin.teammembers.edit,admin.teammembers.delete',
        //     'sr_no' => 8
        // ]);
    
        // ProjectPage::create([
        //     'id' => 14,
        //     'parent_menu' => 17,
        //     'label' => 'Partner',
        //     'route_url' => 'admin.partners.list',
        //     'is_display_in_menu' => 1,
        //     'inner_routes' => 'admin.partners.list,admin.partners.addorupdatepartner,admin.allpartnerslist,admin.users.changepartnerstatus,admin.partners.edit,admin.partners.delete',
        //     'sr_no' => 11
        // ]);
        ProjectPage::create([
            'id' => 15,
            'parent_menu' => 17,
            'label' => 'Testimonial',
            'route_url' => 'admin.testimonials.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.testimonials.list,admin.testimonials.addorupdatetestimonial,admin.alltestimonialslist,admin.users.changetestimonialstatus,admin.testimonials.edit,admin.testimonials.delete',
            'sr_no' => 12
        ]);
        ProjectPage::create([
            'id' => 16,
            'parent_menu' => 0,
            'label' => 'Contacts',
            'route_url' => 'admin.contacts.list',
            'icon_class' => 'fa fa-address-book',
            'is_display_in_menu' => 0,
            'inner_routes' => 'admin.contacts.list,admin.contacts.delete',
            'sr_no' => 14
        ]);
        ProjectPage::create([
            'id' => 17,
            'parent_menu' => 0,
            'label' => 'Pages',
            'icon_class' => 'fa fa-file',
            'is_display_in_menu' => 1,
            'sr_no' => 10
        ]);

        ProjectPage::create([
            'id' => 18,
            'parent_menu' => 17,
            'label' => 'Privacy Policy',
            'route_url' => 'admin.privacy_policy.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.privacy_policy.list,admin.privacy_policy.editPrivacyPolicy,admin.privacy_policy.updatePrivacyPolicy',
            'sr_no' => 7
        ]);
        ProjectPage::create([
            'id' => 19,
            'parent_menu' => 17,
            'label' => 'Terms & Condition',
            'route_url' => 'admin.terms_condition.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.terms_condition.list,admin.terms_condition.editTermsCondition,admin.terms_condition.updateTermsCondition',
            'sr_no' => 7
        ]);

        ProjectPage::create([
            'id' => 20,
            'parent_menu' => 17,
            'label' => 'Free Engraving',
            'route_url' => 'admin.free_engraving.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.free_engraving.list,admin.free_engraving.editFreeEngraving,admin.free_engraving.updateFreeEngraving',
            'sr_no' => 7
        ]);

        ProjectPage::create([
            'id' => 21,
            'parent_menu' => 17,
            'label' => 'Free Resizing',
            'route_url' => 'admin.free_resizing.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.free_resizing.list,admin.free_resizing.editFreeResizing,admin.free_resizing.updateFreeResizing',
            'sr_no' => 7
        ]);

        ProjectPage::create([
            'id' => 22,
            'parent_menu' => 17,
            'label' => 'Free Shipping',
            'route_url' => 'admin.free_shipping.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.free_shipping.list,admin.free_shipping.editFreeShipping,admin.free_shipping.updateFreeShipping',
            'sr_no' => 7
        ]);

        ProjectPage::create([
            'id' => 23,
            'parent_menu' => 17,
            'label' => 'Lifetime Upgrade',
            'route_url' => 'admin.lifetime_upgrade.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.lifetime_upgrade.list,admin.lifetime_upgrade.editLifetimeUpgrade,admin.lifetime_upgrade.updateLifetimeUpgrade',
            'sr_no' => 7
        ]);

        ProjectPage::create([
            'id' => 24,
            'parent_menu' => 17,
            'label' => 'Lifetime Warranty',
            'route_url' => 'admin.lifetime_warranty.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.lifetime_warranty.list,admin.lifetime_warranty.editLifetimeWarranty,admin.lifetime_warranty.updateLifetimeWarranty',
            'sr_no' => 7
        ]);

        ProjectPage::create([
            'id' => 25,
            'parent_menu' => 17,
            'label' => 'Payment Options',
            'route_url' => 'admin.payment_options.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.payment_options.list,admin.payment_options.editPaymentOptions,admin.payment_options.updatePaymentOptions',
            'sr_no' => 7
        ]);

        ProjectPage::create([
            'id' => 26,
            'parent_menu' => 17,
            'label' => 'Return Days',
            'route_url' => 'admin.return_days.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.return_days.list,admin.return_days.editPaymentOptions,admin.return_days.updatePaymentOptions',
            'sr_no' => 7
        ]);
        
        ProjectPage::create([
            'id' => 27,
            'parent_menu' => 0,
            'label' => 'Inquiry',
            'route_url' => 'admin.inquiries.list',
            'icon_class' => 'fa fa-info',
            'is_display_in_menu' => 0,
            'inner_routes' => 'admin.inquiries.list,admin.inquiries.delete',
            'sr_no' => 14
        ]);
        
        ProjectPage::create([ 
            'id' => 28, 
            'parent_menu' => 0, 
            'label' => 'Blog', 
            'route_url' => null, 
            'icon_class' => 'fa fa-clipboard', 
            'is_display_in_menu' => 1, 
            'sr_no' => 14
        ]); 
 
        ProjectPage::create([ 
            'id' => 29, 
            'parent_menu' => 28, 
            'label' => 'Blog Category', 
            'route_url' => 'admin.blogcategories.list', 
            'is_display_in_menu' => 1, 
            'inner_routes' => 'admin.blogcategories.list,admin.blogcategories.add,admin.blogcategories.save,admin.allblogcategorylist,admin.blogcategories.changeblogcategorystatus,admin.blogcategories.delete,admin.blogcategories.edit' 
        ]); 
 
        ProjectPage::create([ 
            'id' => 30, 
            'parent_menu' => 28, 
            'label' => 'Blogs', 
            'route_url' => 'admin.blogs.list', 
            'is_display_in_menu' => 1, 
            'inner_routes' => 'admin.blogs.list,admin.blogs.add,admin.blogs.save,admin.allbloglist,admin.blogs.changeblogstatus,admin.blogs.delete,admin.blogs.edit,admin.blogs.uploadfile,admin.blogs.removefile' 
        ]);

        ProjectPage::create([ 
            'id' => 31, 
            'parent_menu' => 0, 
            'label' => 'Banners', 
            'route_url' => 'admin.banners.list', 
            'is_display_in_menu' => 0, 
            'inner_routes' => 'admin.banners.list,admin.banners.add,admin.banners.save,admin.allbannerlist,admin.banners.changebannerstatus,admin.banners.delete,admin.banners.edit,admin.banners.uploadfile,admin.banners.removefile',
            'icon_class' => 'fa fa-picture-o', 
            'sr_no' => 1 
        ]);

        ProjectPage::create([ 
            'id' => 32, 
            'parent_menu' => 0, 
            'label' => 'News latter', 
            'route_url' => 'admin.newslatter.list', 
            'is_display_in_menu' => 0, 
            'inner_routes' => 'admin.newslatter.list',
            'icon_class' => 'fa fa-newspaper-o', 
            'sr_no' => 20 
        ]);

        ProjectPage::create([ 
            'id' => 33, 
            'parent_menu' => 4, 
            'label' => 'Diamond', 
            'route_url' => 'admin.diamond.list', 
            'is_display_in_menu' => 1, 
            'inner_routes' => 'admin.diamond.list,admin.importview,admin.diamonds.save,admin.alldiamondlist',
        ]);

        ProjectPage::create([ 
            'id' => 34, 
            'parent_menu' => 0, 
            'label' => 'Company', 
            'route_url' => 'admin.company.list', 
            'is_display_in_menu' => 0, 
            'inner_routes' => 'admin.company.list',
            'icon_class' => 'fa fa-building-o', 
            'sr_no' => 21
        ]);


        ProjectPage::create([ 
            'id' => 35, 
            'parent_menu' => 0, 
            'label' => 'Steps', 
            'route_url' => 'admin.steps.list', 
            'is_display_in_menu' => 0, 
            'inner_routes' => 'admin.steps.list,admin.steps.add,admin.steps.save,admin.allsteplist,admin.steps.changestepstatus,admin.steps.delete,admin.steps.edit,admin.steps.uploadfile,admin.steps.removefile',
            'icon_class' => 'fas fa-step-forward',
            'sr_no' => 22 
        ]);

        ProjectPage::create([
            'id' => 36,
            'parent_menu' => 0,
            'label' => 'Home Page Settings',
            'route_url' => 'admin.homesettings.create',
            'icon_class' => 'fa fa-cog',
            'is_display_in_menu' => 0,
            'inner_routes' => 'admin.homesettings.create,admin.homesettings.edit',
            'sr_no' => 23
        ]);

        

        

        $users = User::where('role',"!=",1)->get();
        $project_page_ids1 = ProjectPage::where('parent_menu',0)->where('is_display_in_menu',0)->pluck('id')->toArray();
        $project_page_ids2 = ProjectPage::where('parent_menu',"!=",0)->where('is_display_in_menu',1)->pluck('id')->toArray();
        $project_page_ids = array_merge($project_page_ids1,$project_page_ids2);
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
