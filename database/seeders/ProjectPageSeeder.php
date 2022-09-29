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
            'sr_no' => 90
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
            'sr_no' => 91
        ]);

        ProjectPage::create([
            'id' => 5,
            'parent_menu' => 4,
            'label' => 'Category',
            'route_url' => 'admin.categories.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.categories.list,admin.categories.add,admin.categories.save,admin.allcategorylist,admin.categories.changecategorystatus,admin.categories.delete,admin.categories.edit,admin.categories.uploadfile,admin.categories.removefile,admin.categories.checkparentcat',
            'sr_no' => 1
        ]);

        ProjectPage::create([
            'id' => 6,
            'parent_menu' => 4,
            'label' => 'Attributes',
            'route_url' => 'admin.attributes.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.attributes.list,admin.attributes.addorupdate,admin.allattributeslist,admin.attributes.edit,admin.attributes.delete,admin.attributes.chageattributestatus,admin.attributeTerms.list,admin.attributeTerms.addorupdate,admin.allattributesTermlist,admin.attributeTerms.chageattributeTermstatus,admin.attributeTerms.edit,admin.attributeTerms.delete',
            'sr_no' => 2
        ]);

        ProjectPage::create([
            'id' => 7,
            'parent_menu' => 4,
            'label' => 'Product',
            'route_url' => 'admin.products.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.products.list,admin.products.add,admin.getAttrVariation,admin.addVariantbox,admin.products.save,admin.products.uploadfile,admin.products.removefile,admin.allproductlist,admin.products.edit,admin.products.changeproductstatus,admin.products.delete',
            'sr_no' => 3
        ]);



        ProjectPage::create([
            'id' => 8,
            'parent_menu' => 4,
            'label' => 'Custom Product',
            'route_url' => 'admin.customproducts.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.customproducts.list,admin.products.add,admin.getAttrVariation,admin.addVariantbox,admin.products.save,admin.products.uploadfile,admin.products.removefile,admin.allcustomproductlist,admin.products.edit,admin.products.changeproductstatus,admin.products.delete',
            'sr_no' => 4
        ]);

        ProjectPage::create([
            'id' => 9,
            'parent_menu' => 4,
            'label' => 'Order Includes',
            'route_url' => 'admin.order_includes.add',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.order_includes.list,admin.order_includes.add,admin.order_includes.save,admin.allorder_includeslist,admin.order_includes.changeorder_includestatus,admin.order_includes.delete,admin.order_includes.edit',
            'sr_no' => 5
           
        ]);
        

       
    
        

        

        ProjectPage::create([
            'id' => 12,
            'parent_menu' => 0,
            'label' => 'Theme Setting',
            'route_url' => null,
            'icon_class' => 'fa fa-cog',
            'is_display_in_menu' => 1,
            'sr_no' => 100
        ]);

        
        ProjectPage::create([
            'id' => 13,
            'parent_menu' => 12,
            'label' => 'Mega Menu',
            'route_url' => 'admin.megamenus.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.megamenus.list'
        ]);

        ProjectPage::create([
            'id' => 14,
            'parent_menu' => 12,
            'label' => 'Offer',
            'route_url' => 'admin.offers.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.offers.list,admin.offers.add,admin.offers.save,admin.allofferlist,admin.offers.changeofferstatus,admin.offers.delete,admin.offers.edit'
        ]);

        ProjectPage::create([
            'id' => 40,
            'parent_menu' => 12,
            'label' => 'Settings',
            'route_url' => 'admin.settings.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.settings.list,admin.settings.edit'
        ]);

       

        
        
        
        
        ProjectPage::create([ 
            'id' => 28, 
            'parent_menu' => 0, 
            'label' => 'Blog', 
            'route_url' => null, 
            'icon_class' => 'fa fa-clipboard', 
            'is_display_in_menu' => 1, 
            'sr_no' => 92
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

        // ProjectPage::create([ 
        //     'id' => 39, 
        //     'parent_menu' => 28, 
        //     'label' => 'Blog Banners', 
        //     'route_url' => 'admin.blogbanners.list', 
        //     'is_display_in_menu' => 1, 
        //     'inner_routes' => 'admin.blogbanners.list,admin.blogbanners.add,admin.blogbanners.save,admin.allblogbannerlist,admin.blogbanners.changeblogbannerstatus,admin.blogbanners.delete,admin.blogbanners.edit,admin.blogbanners.uploadfile,admin.blogbanners.removefile',
           
        // ]);

        ProjectPage::create([ 
            'id' => 31, 
            'parent_menu' => 0, 
            'label' => 'Sliders', 
            'route_url' => 'admin.banners.list', 
            'is_display_in_menu' => 0, 
            'inner_routes' => 'admin.banners.list,admin.banners.add,admin.banners.save,admin.allbannerlist,admin.banners.changebannerstatus,admin.banners.delete,admin.banners.edit,admin.banners.uploadfile,admin.banners.removefile',
            'icon_class' => 'fa fa-picture-o', 
            'sr_no' => 1 
        ]);

        ProjectPage::create([ 
            'id' => 32, 
            'parent_menu' => 0, 
            'label' => 'News letter', 
            'route_url' => 'admin.newslatter.list', 
            'is_display_in_menu' => 0, 
            'inner_routes' => 'admin.newslatter.list',
            'icon_class' => 'fa fa-newspaper-o', 
            'sr_no' => 47 
        ]);

        
        ProjectPage::create([ 
            'id' => 35, 
            'parent_menu' => 0, 
            'label' => 'Step for Buy', 
            'route_url' => 'admin.steps.list', 
            'is_display_in_menu' => 0, 
            'inner_routes' => 'admin.steps.list,admin.steps.add,admin.steps.save,admin.allsteplist,admin.steps.changestepstatus,admin.steps.delete,admin.steps.edit,admin.steps.uploadfile,admin.steps.removefile',
            'icon_class' => 'fa fa-step-forward',
            'sr_no' => 22 
        ]);

        

        ProjectPage::create([
            'id' => 36,
            'parent_menu' => 0,
            'label' => 'Shop By Style',
            'route_url' => 'admin.shopbystyle.list',
            'icon_class' => 'fa fa-shopping-cart',
            'is_display_in_menu' => 0,
            'inner_routes' => 'admin.shopbystyle.list,admin.shopbystyle.add,admin.shopbystyle.save,admin.allshopbystylelist,admin.shopbystyle.changeshopbystylestatus,admin.shopbystyle.delete,admin.shopbystyle.edit,admin.shopbystyle.uploadfile,admin.shopbystyle.removefile,admin.shopbystyle.checkparentcat',
            'sr_no' => 23
        ]);

        
        ProjectPage::create([
            'id' => 41,
            'parent_menu' => 0,
            'label' => 'Inquiries',
            'route_url' => null,
            'icon_class' => 'fa fa-address-book',
            'is_display_in_menu' => 1,
            'sr_no' => 93
        ]);

        ProjectPage::create([
            'id' => 42,
            'parent_menu' => 41,
            'label' => 'Inquiry',
            'route_url' => 'admin.inquiries.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.inquiries.list,admin.inquiries.delete'
            
        ]);

        ProjectPage::create([
            'id' => 43,
            'parent_menu' => 41,
            'label' => 'Contact Inquiry',
            'route_url' => 'admin.contacts.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.contacts.list,admin.contacts.delete'
        ]);

        ProjectPage::create([
            'id' => 44,
            'parent_menu' => 41,
            'label' => 'Custom wants Opinion',
            'route_url' => 'admin.opinions.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.opinions.list'
            
        ]);

        ProjectPage::create([
            'id' => 45,
            'parent_menu' => 0,
            'label' => 'Lab Diamonds',
            'route_url' => null,
            'icon_class' => 'fa fa-diamond',
            'is_display_in_menu' => 1,
            'sr_no' => 92
        ]);

        ProjectPage::create([ 
            'id' => 46, 
            'parent_menu' => 45, 
            'label' => 'Diamond', 
            'route_url' => 'admin.diamond.list', 
            'is_display_in_menu' => 1, 
            'inner_routes' => 'admin.diamond.list,admin.importview,admin.diamonds.save,admin.alldiamondlist',
        ]);

        ProjectPage::create([
            'id' => 47,
            'parent_menu' => 45,
            'label' => 'Import Sheet',
            'route_url' => 'admin.importview',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.importview,admin.diamonds.save'
        ]);

        ProjectPage::create([ 
            'id' => 48, 
            'parent_menu' => 45, 
            'label' => 'Diamond Merchants', 
            'route_url' => 'admin.company.list', 
            'is_display_in_menu' => 1, 
            'inner_routes' => 'admin.company.list'
        ]);

        ProjectPage::create([
            'id' => 49,
            'parent_menu' => 0,
            'label' => 'Page',
            'route_url' => null,
            'icon_class' => 'fa fa-file',
            'is_display_in_menu' => 1,
            'sr_no' => 94
        ]);

        ProjectPage::create([
            'id' => 50,
            'parent_menu' => 49,
            'label' => 'About Us',
            'route_url' => 'admin.infopage.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.infopage.list,admin.infopage.editAboutus,admin.infopage.updateAboutus',
            'sr_no' => 7
        ]);


         ProjectPage::create([
            'id' => 51,
            'parent_menu' => 49,
            'label' => 'Customer Value',
            'route_url' => 'admin.customer_value.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.customer_value.list,admin.customer_value.updateCustomerValue',
            'sr_no' => 6
        ]);

       

         ProjectPage::create([
            'id' => 52,
            'parent_menu' => 49,
            'label' => 'Conflict Free Diamonds',
            'route_url' => 'admin.conflict_free_diamonds.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.conflict_free_diamonds.list,admin.market_need.updateConflictFreeDiamonds',
            'sr_no' => 8
        ]);
    
        ProjectPage::create([
            'id' => 53,
            'parent_menu' => 49,
            'label' => 'Diamond Anatomy',
            'route_url' => 'admin.diamond_anatomy.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.diamond_anatomy.list,admin.infopage.editDiamondAnatomy,admin.infopage.updateDiamondAnatomy',
            'sr_no' => 11
        ]);

        ProjectPage::create([
            'id' => 54,
            'parent_menu' => 49,
            'label' => 'Free Engraving',
            'route_url' => 'admin.free_engraving.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.free_engraving.list,admin.free_engraving.editFreeEngraving,admin.free_engraving.updateFreeEngraving',
            'sr_no' => 7
        ]);

        ProjectPage::create([
            'id' => 55,
            'parent_menu' => 49,
            'label' => 'Free Resizing',
            'route_url' => 'admin.free_resizing.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.free_resizing.list,admin.free_resizing.editFreeResizing,admin.free_resizing.updateFreeResizing',
            'sr_no' => 7
        ]);

        ProjectPage::create([
            'id' => 56,
            'parent_menu' => 49,
            'label' => 'Free Shipping',
            'route_url' => 'admin.free_shipping.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.free_shipping.list,admin.free_shipping.editFreeShipping,admin.free_shipping.updateFreeShipping',
            'sr_no' => 7
        ]);

        ProjectPage::create([
            'id' => 57,
            'parent_menu' => 49,
            'label' => 'Home Page',
            'route_url' => 'admin.homesettings.create',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.homesettings.create,admin.homesettings.edit'
        ]);

        ProjectPage::create([
            'id' => 58,
            'parent_menu' => 49,
            'label' => 'Lifetime Upgrade',
            'route_url' => 'admin.lifetime_upgrade.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.lifetime_upgrade.list,admin.lifetime_upgrade.editLifetimeUpgrade,admin.lifetime_upgrade.updateLifetimeUpgrade',
            'sr_no' => 7
        ]);

        ProjectPage::create([
            'id' => 59,
            'parent_menu' => 49,
            'label' => 'Lifetime Warranty',
            'route_url' => 'admin.lifetime_warranty.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.lifetime_warranty.list,admin.lifetime_warranty.editLifetimeWarranty,admin.lifetime_warranty.updateLifetimeWarranty',
            'sr_no' => 7
        ]);

        ProjectPage::create([
            'id' => 60,
            'parent_menu' => 49,
            'label' => 'Learn About Lab Made Diamonds',
            'route_url' => 'admin.learn_about_lab_made_diamonds.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.learn_about_lab_made_diamonds.list,admin.market_need.updateLearnAboutLabMadeDiamonds'
        ]);

        ProjectPage::create([
            'id' => 61,
            'parent_menu' => 49,
            'label' => 'Market Need',
            'route_url' => 'admin.market_need.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.market_need.list,admin.market_need.updateMarketNeed'
        ]);

        ProjectPage::create([
            'id' => 62,
            'parent_menu' => 49,
            'label' => 'Payment Options',
            'route_url' => 'admin.payment_options.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.payment_options.list,admin.payment_options.editPaymentOptions,admin.payment_options.updatePaymentOptions',
            'sr_no' => 7
        ]);
      
        
       
        ProjectPage::create([
            'id' => 63,
            'parent_menu' => 49,
            'label' => 'Privacy Policy',
            'route_url' => 'admin.privacy_policy.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.privacy_policy.list,admin.privacy_policy.editPrivacyPolicy,admin.privacy_policy.updatePrivacyPolicy',
            'sr_no' => 7
        ]);

        ProjectPage::create([
            'id' => 64,
            'parent_menu' => 49,
            'label' => 'Return Days',
            'route_url' => 'admin.return_days.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.return_days.list,admin.return_days.editPaymentOptions,admin.return_days.updatePaymentOptions',
            'sr_no' => 7
        ]);

        ProjectPage::create([
            'id' => 65,
            'parent_menu' => 49,
            'label' => 'Terms & Condition',
            'route_url' => 'admin.terms_condition.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.terms_condition.list,admin.terms_condition.editTermsCondition,admin.terms_condition.updateTermsCondition',
            'sr_no' => 7
        ]);

        ProjectPage::create([ 
            'id' => 66, 
            'parent_menu' => 12, 
            'label' => 'Blog Sidebar Setting', 
            'route_url' => 'admin.blogbanners.list', 
            'is_display_in_menu' => 1, 
            'inner_routes' => 'admin.blogbanners.list,admin.blogbanners.add,admin.blogbanners.save,admin.allblogbannerlist,admin.blogbanners.changeblogbannerstatus,admin.blogbanners.delete,admin.blogbanners.edit,admin.blogbanners.uploadfile,admin.blogbanners.removefile',
        ]);

        

        ProjectPage::create([
            'id' => 69,
            'parent_menu' => 0,
            'label' => 'Coupon',
            'route_url' => 'admin.coupons.list',
            'is_display_in_menu' => 0,
            'inner_routes' => 'admin.coupons.list,admin.coupons.add,admin.coupons.save,admin.allcouponlist,admin.coupons.edit,admin.coupons.delete',
            'icon_class' => 'icon-badge', 
            'sr_no' => 48 
        ]);

        ProjectPage::create([
            'id' => 70,
            'parent_menu' => 49,
            'label' => 'Why Friendly',
            'route_url' => 'admin.why_friendly.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.why_friendly.list,admin.why_friendlyWhyFriendly.edit,admin.why_friendly.updateWhyFriendly',
            'sr_no' => 7
        ]);

        ProjectPage::create([
            'id' => 67,
            'parent_menu' => 0,
            'label' => 'Home Banner',
            'route_url' => 'admin.homebanners.list', 
            'is_display_in_menu' => 0,
            'inner_routes' => 'admin.homebanners.list,admin.homebanners.add,admin.homebanners.save,admin.allhomebannerlist,admin.homebanners.changehomebannerstatus,admin.homebanners.delete,admin.homebanners.edit,admin.homebanners.uploadfile,admin.homebanners.removefile',
            'icon_class' => 'icon-badge',
            'sr_no' => 49
        ]);

        ProjectPage::create([
            'id' => 68,
            'parent_menu' => 0,
            'label' => 'Price Range',
            'route_url' => 'admin.pricerange.list',
            'is_display_in_menu' => 0,
            'inner_routes' => 'admin.pricerange.list,admin.pricerange.addorupdate,admin.allpricerangeslist,admin.pricerange.changepricerangestatus,admin.pricerange.edit,admin.pricerange.delete,admin.pricerange.permission,admin.pricerange.savepermission',
            'icon_class' => 'icon-badge',
            'sr_no' => 50
        ]);

        
        ProjectPage::create([
            'id' => 71,
            'parent_menu' => 49,
            'label' => 'Gemver Difference',
            'route_url' => 'admin.gemver_difference.list',
            'is_display_in_menu' => 1,
            'inner_routes' => 'admin.gemver_difference.list,admin.infopage.editGemverDifference,admin.infopage.updateGemverDifference',
            'sr_no' => 12
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
