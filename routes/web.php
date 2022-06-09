<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\TermConditionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\OtherPageController;
use App\Http\Controllers\NewsLatterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Frontend Route

Route::get('/',[HomeController::class,'index'])->name('frontend.home');
Route::get('/about-us',[AboutUsController::class,'index'])->name('frontend.aboutus');
Route::get('/contact-us',[ContactUsController::class,'index'])->name('frontend.contactus');
Route::post('contact-us',[ContactUsController::class,'save'])->name('frontend.contact.save');
Route::get('/privacy-policy',[PrivacyPolicyController::class,'index'])->name('frontend.privacypolicy');
Route::get('/term-condition',[TermConditionController::class,'index'])->name('frontend.termcondition');

Route::get('/free-engraving',[OtherPageController::class,'freeengraving'])->name('frontend.freeengraving');
Route::get('/free-resizing',[OtherPageController::class,'freeresizing'])->name('frontend.freeresizing');
Route::get('/free-shipping',[OtherPageController::class,'freeshipping'])->name('frontend.freeshipping');
Route::get('/lifetime-upgrade',[OtherPageController::class,'lifetimeupgrade'])->name('frontend.lifetimeupgrade');
Route::get('/lifetime-warranty',[OtherPageController::class,'lifetimewarranty'])->name('frontend.lifetimewarranty');
Route::get('/payment-options',[OtherPageController::class,'paymentoptions'])->name('frontend.paymentoptions');
Route::get('/return-days',[OtherPageController::class,'returndays'])->name('frontend.returndays');

Route::get('/shop/{catid}',[ProductController::class,'index'])->name('frontend.shop');
Route::get('/product-details/{id}',[ProductController::class,'product_detail'])->name('frontend.product.productdetails');
Route::post('/product-filter',[ProductController::class,'fetchproduct'])->name('frontend.product.productfilter');
Route::post('/product-details-filter',[ProductController::class,'fetchproductdetails'])->name('frontend.product.productdetailsfilter');

Route::get('/blogs',[BlogController::class,'index'])->name('frontend.blogs');
Route::post('/blogs-filter',[BlogController::class,'fetchblogs'])->name('frontend.blogs.blogfilter');
Route::get('/blog/{id}',[BlogController::class,'blogdetails'])->name('frontend.blog.blog');

Route::post('/inquiry',[ContactUsController::class,'inquiry_save'])->name('frontend.inquiry.save');

Route::post('/news-latter',[NewsLatterController::class,'save'])->name('frontend.newslatter.save');

//Admin  Rpute
Route::get('admin',[\App\Http\Controllers\admin\AuthController::class,'index'])->name('admin.login');
Route::post('adminpostlogin', [\App\Http\Controllers\admin\AuthController::class, 'postLogin'])->name('admin.postlogin');
Route::get('logout', [\App\Http\Controllers\admin\AuthController::class, 'logout'])->name('admin.logout');
Route::get('admin/403_page',[\App\Http\Controllers\admin\AuthController::class,'invalid_page'])->name('admin.403_page');

Route::group(['prefix'=>'admin','middleware'=>['auth','userpermission'],'as'=>'admin.'],function () {
    Route::get('dashboard', [\App\Http\Controllers\admin\DashboardController::class, 'index'])->name('dashboard');

    Route::get('attributes',[\App\Http\Controllers\admin\AttributeController::class,'index'])->name('attributes.list');
    Route::post('addorupdateattribute',[\App\Http\Controllers\admin\AttributeController::class,'addorupdateattribute'])->name('attributes.addorupdate');
    Route::post('allattributeslist',[\App\Http\Controllers\admin\AttributeController::class,'allattributeslist'])->name('allattributeslist');
    Route::get('attribute/{id}/edit',[\App\Http\Controllers\admin\AttributeController::class,'editattribute'])->name('attributes.edit');
    Route::get('attribute/{id}/delete',[\App\Http\Controllers\admin\AttributeController::class,'deleteattribute'])->name('attributes.delete');
    Route::get('chageattributestatus/{id}',[\App\Http\Controllers\admin\AttributeController::class,'chageattributestatus'])->name('attributes.chageattributestatus');

    Route::get('attributeTerms/{id}',[\App\Http\Controllers\admin\AttributeTermsController::class,'index'])->name('attributeTerms.list');
    Route::post('addorupdateattributeTerm',[\App\Http\Controllers\admin\AttributeTermsController::class,'addorupdateattributeTerm'])->name('attributeTerms.addorupdate');
    Route::post('allattributesTermlist',[\App\Http\Controllers\admin\AttributeTermsController::class,'allattributesTermlist'])->name('allattributesTermlist');
    Route::get('chageattributeTermstatus/{id}',[\App\Http\Controllers\admin\AttributeTermsController::class,'chageattributeTermstatus'])->name('attributeTerms.chageattributeTermstatus');
    Route::get('attributeTerm/{id}/edit',[\App\Http\Controllers\admin\AttributeTermsController::class,'editattributeTerm'])->name('attributeTerms.edit');
    Route::get('attributeTerm/{id}/delete',[\App\Http\Controllers\admin\AttributeTermsController::class,'deleteattributeTerm'])->name('attributeTerms.delete');


    Route::get('categories',[\App\Http\Controllers\admin\CategoryController::class,'index'])->name('categories.list');
    Route::get('categories/create',[\App\Http\Controllers\admin\CategoryController::class,'create'])->name('categories.add');
    Route::post('categories/save',[\App\Http\Controllers\admin\CategoryController::class,'save'])->name('categories.save');
    Route::post('allcategorylist',[\App\Http\Controllers\admin\CategoryController::class,'allcategorylist'])->name('allcategorylist');
    Route::get('changecategorystatus/{id}',[\App\Http\Controllers\admin\CategoryController::class,'changecategorystatus'])->name('categories.changecategorystatus');
    Route::get('categories/{id}/delete',[\App\Http\Controllers\admin\CategoryController::class,'deletecategory'])->name('categories.delete');
    Route::get('categories/{id}/edit',[\App\Http\Controllers\admin\CategoryController::class,'editcategory'])->name('categories.edit');
    Route::post('categories/uploadfile',[\App\Http\Controllers\admin\CategoryController::class,'uploadfile'])->name('categories.uploadfile');
    Route::post('categories/removefile',[\App\Http\Controllers\admin\CategoryController::class,'removefile'])->name('categories.removefile');
    Route::get('categories/checkparentcat/{id}',[\App\Http\Controllers\admin\CategoryController::class,'checkparentcat'])->name('categories.checkparentcat');


    Route::get('products',[\App\Http\Controllers\admin\ProductController::class,'index'])->name('products.list');
    Route::get('products/create',[\App\Http\Controllers\admin\ProductController::class,'create'])->name('products.add');
    Route::get('getAttrVariation/{id}',[\App\Http\Controllers\admin\ProductController::class,'getAttrVariation'])->name('getAttrVariation');
    Route::get('addVariantbox/{id}',[\App\Http\Controllers\admin\ProductController::class,'addVariantbox'])->name('addVariantbox');
    Route::post('products/save',[\App\Http\Controllers\admin\ProductController::class,'save'])->name('products.save');
    Route::post('variant/uploadfile',[\App\Http\Controllers\admin\ProductController::class,'uploadfile'])->name('products.uploadfile');
    Route::post('variant/removefile',[\App\Http\Controllers\admin\ProductController::class,'removefile'])->name('products.removefile');
    Route::post('allproductlist',[\App\Http\Controllers\admin\ProductController::class,'allproductlist'])->name('allproductlist');
    Route::get('products/{id}/edit',[\App\Http\Controllers\admin\ProductController::class,'editproduct'])->name('products.edit');
    Route::get('changeproductstatus/{id}',[\App\Http\Controllers\admin\ProductController::class,'changeproductstatus'])->name('products.changeproductstatus');
    Route::get('products/{id}/delete',[\App\Http\Controllers\admin\ProductController::class,'deleteproduct'])->name('products.delete');
    Route::post('products/checksku',[\App\Http\Controllers\admin\ProductController::class,'sku_check'])->name('products.sku_check');

    Route::get('users',[\App\Http\Controllers\admin\UserController::class,'index'])->name('users.list');
    Route::post('addorupdateuser',[\App\Http\Controllers\admin\UserController::class,'addorupdateuser'])->name('users.addorupdate');
    Route::post('alluserslist',[\App\Http\Controllers\admin\UserController::class,'alluserslist'])->name('alluserslist');
    Route::get('changeuserstatus/{id}',[\App\Http\Controllers\admin\UserController::class,'changeuserstatus'])->name('users.changeuserstatus');
    Route::get('users/{id}/edit',[\App\Http\Controllers\admin\UserController::class,'edituser'])->name('users.edit');
    Route::get('users/{id}/delete',[\App\Http\Controllers\admin\UserController::class,'deleteuser'])->name('users.delete');
    Route::get('users/{id}/permission',[\App\Http\Controllers\admin\UserController::class,'permissionuser'])->name('users.permission');
    Route::post('savepermission',[\App\Http\Controllers\admin\UserController::class,'savepermission'])->name('users.savepermission');


    Route::get('faqs',[\App\Http\Controllers\admin\FaqController::class,'index'])->name('faqs.list');
    Route::get('faqs/create',[\App\Http\Controllers\admin\FaqController::class,'create'])->name('faq.add');
    Route::post('faqs/save',[\App\Http\Controllers\admin\FaqController::class,'save'])->name('faqs.save');
    Route::post('allFaqslist',[\App\Http\Controllers\admin\FaqController::class,'allFaqslist'])->name('allFaqsformlist');
    Route::get('faq/{id}/edit',[\App\Http\Controllers\admin\FaqController::class,'editFaq'])->name('faq.edit');
    Route::get('faq/{id}/delete',[\App\Http\Controllers\admin\FaqController::class,'deleteFaq'])->name('faq.delete');

    Route::get('suggestions',[\App\Http\Controllers\admin\SuggestionController::class,'index'])->name('suggestions.list');
    Route::post('allSuggestionslist',[\App\Http\Controllers\admin\SuggestionController::class,'allSuggestionslist'])->name('allSuggestionslist');
    Route::get('suggestion/{id}/delete',[\App\Http\Controllers\admin\SuggestionController::class,'deleteSuggestion'])->name('suggestion.delete');

    Route::get('settings',[\App\Http\Controllers\admin\SettingsController::class,'index'])->name('settings.list');
    Route::post('updateInvoiceSetting',[\App\Http\Controllers\admin\SettingsController::class,'updateInvoiceSetting'])->name('settings.updateInvoiceSetting');
    Route::get('settings/edit',[\App\Http\Controllers\admin\SettingsController::class,'editSettings'])->name('settings.edit');

    Route::get('infopage',[\App\Http\Controllers\admin\InfopageController::class,'index'])->name('infopage.list');
    Route::get('infopage/aboutus/edit',[\App\Http\Controllers\admin\InfopageController::class,'editAboutus'])->name('infopage.editAboutus');
    Route::post('updateAboutus',[\App\Http\Controllers\admin\InfopageController::class,'updateAboutus'])->name('infopage.updateAboutus');

    Route::get('teammembers',[\App\Http\Controllers\admin\TeamMemberController::class,'index'])->name('teammembers.list');
    Route::post('allteamslist',[\App\Http\Controllers\admin\TeamMemberController::class,'allteamslist'])->name('allteamslist');
    Route::get('changeteamstatus/{id}',[\App\Http\Controllers\admin\TeamMemberController::class,'changeteamstatus'])->name('teammembers.changeteamstatus');
    Route::post('addorupdateteam',[\App\Http\Controllers\admin\TeamMemberController::class,'addorupdateteam'])->name('teammembers.addorupdateteam');
    Route::get('teammembers/{id}/edit',[\App\Http\Controllers\admin\TeamMemberController::class,'editteam'])->name('teammembers.edit');
    Route::get('teammembers/{id}/delete',[\App\Http\Controllers\admin\TeamMemberController::class,'deleteteam'])->name('teammembers.delete');

    Route::get('partners',[\App\Http\Controllers\admin\PartnerController::class,'index'])->name('partners.list');
    Route::post('allpartnerslist',[\App\Http\Controllers\admin\PartnerController::class,'allpartnerslist'])->name('allpartnerslist');
    Route::get('changepartnerstatus/{id}',[\App\Http\Controllers\admin\PartnerController::class,'changepartnerstatus'])->name('partners.changepartnerstatus');
    Route::post('addorupdatepartner',[\App\Http\Controllers\admin\PartnerController::class,'addorupdatepartner'])->name('partners.addorupdatepartner');
    Route::get('partners/{id}/edit',[\App\Http\Controllers\admin\PartnerController::class,'editpartner'])->name('partners.edit');
    Route::get('partners/{id}/delete',[\App\Http\Controllers\admin\PartnerController::class,'deletepartner'])->name('partners.delete');

    Route::get('testimonials',[\App\Http\Controllers\admin\TestimonialController::class,'index'])->name('testimonials.list');
    Route::post('alltestimonialslist',[\App\Http\Controllers\admin\TestimonialController::class,'alltestimonialslist'])->name('alltestimonialslist');
    Route::get('changetestimonialstatus/{id}',[\App\Http\Controllers\admin\TestimonialController::class,'changetestimonialstatus'])->name('testimonials.changetestimonialstatus');
    Route::post('addorupdatetestimonial',[\App\Http\Controllers\admin\TestimonialController::class,'addorupdatetestimonial'])->name('testimonials.addorupdatetestimonial');
    Route::get('testimonials/{id}/edit',[\App\Http\Controllers\admin\TestimonialController::class,'edittestimonial'])->name('testimonials.edit');
    Route::get('testimonials/{id}/delete',[\App\Http\Controllers\admin\TestimonialController::class,'deletetestimonial'])->name('testimonials.delete');

    Route::get('contacts',[\App\Http\Controllers\admin\ContactusController::class,'index'])->name('contacts.list');
    Route::post('allcontactslist',[\App\Http\Controllers\admin\ContactusController::class,'allcontactslist'])->name('allcontactslist');
    Route::get('contacts/{id}/delete',[\App\Http\Controllers\admin\ContactusController::class,'deletecontact'])->name('contacts.delete');

    Route::get('privacy_policy',[\App\Http\Controllers\admin\InfopageController::class,'privacy_policy'])->name('privacy_policy.list');
    Route::post('updatePrivacyPolicy',[\App\Http\Controllers\admin\InfopageController::class,'updatePrivacyPolicy'])->name('privacy_policy.updatePrivacyPolicy');
    Route::get('privacy_policy/privacy_policy/edit',[\App\Http\Controllers\admin\InfopageController::class,'editPrivacyPolicy'])->name('privacy_policy.editPrivacyPolicy');

    Route::get('terms_condition',[\App\Http\Controllers\admin\InfopageController::class,'terms_condition'])->name('terms_condition.list');
    Route::post('updateTermsCondition',[\App\Http\Controllers\admin\InfopageController::class,'updateTermsCondition'])->name('terms_condition.updateTermsCondition');
    Route::get('terms_condition/terms_condition/edit',[\App\Http\Controllers\admin\InfopageController::class,'editTermsCondition'])->name('terms_condition.editTermsCondition');

    Route::get('free_engraving',[\App\Http\Controllers\admin\InfopageController::class,'free_engraving'])->name('free_engraving.list');
    Route::post('updateFreeEngraving',[\App\Http\Controllers\admin\InfopageController::class,'updateFreeEngraving'])->name('free_engraving.updateFreeEngraving');
    Route::get('terms_condition/free_engraving/edit',[\App\Http\Controllers\admin\InfopageController::class,'editFreeEngraving'])->name('free_engraving.editFreeEngraving');

    Route::get('free_resizing',[\App\Http\Controllers\admin\InfopageController::class,'free_resizing'])->name('free_resizing.list');
    Route::post('updateFreeResizing',[\App\Http\Controllers\admin\InfopageController::class,'updateFreeResizing'])->name('free_resizing.updateFreeResizing');
    Route::get('free_resizing/free_resizing/edit',[\App\Http\Controllers\admin\InfopageController::class,'editFreeResizing'])->name('free_resizing.editFreeResizing');

    Route::get('free_shipping',[\App\Http\Controllers\admin\InfopageController::class,'free_shipping'])->name('free_shipping.list');
    Route::post('updateFreeShipping',[\App\Http\Controllers\admin\InfopageController::class,'updateFreeShipping'])->name('free_shipping.updateFreeShipping');
    Route::get('free_shipping/free_shipping/edit',[\App\Http\Controllers\admin\InfopageController::class,'editFreeShipping'])->name('free_shipping.editFreeShipping');

    Route::get('lifetime_upgrade',[\App\Http\Controllers\admin\InfopageController::class,'lifetime_upgrade'])->name('lifetime_upgrade.list');
    Route::post('updateLifetimeUpgrade',[\App\Http\Controllers\admin\InfopageController::class,'updateLifetimeUpgrade'])->name('lifetime_upgrade.updateLifetimeUpgrade');
    Route::get('lifetime_upgrade/lifetime_upgrade/edit',[\App\Http\Controllers\admin\InfopageController::class,'editLifetimeUpgrade'])->name('lifetime_upgrade.editLifetimeUpgrade');

    Route::get('lifetime_warranty',[\App\Http\Controllers\admin\InfopageController::class,'lifetime_warranty'])->name('lifetime_warranty.list');
    Route::post('updateLifetimeWarranty',[\App\Http\Controllers\admin\InfopageController::class,'updateLifetimeWarranty'])->name('lifetime_warranty.updateLifetimeWarranty');
    Route::get('lifetime_warranty/lifetime_warranty/edit',[\App\Http\Controllers\admin\InfopageController::class,'editLifetimeWarranty'])->name('lifetime_warranty.editLifetimeWarranty');

    Route::get('payment_options',[\App\Http\Controllers\admin\InfopageController::class,'payment_options'])->name('payment_options.list');
    Route::post('updatePaymentOptions',[\App\Http\Controllers\admin\InfopageController::class,'updatePaymentOptions'])->name('payment_options.updatePaymentOptions');
    Route::get('payment_options/payment_options/edit',[\App\Http\Controllers\admin\InfopageController::class,'editPaymentOptions'])->name('payment_options.editPaymentOptions');

    Route::get('return_days',[\App\Http\Controllers\admin\InfopageController::class,'return_days'])->name('return_days.list');
    Route::post('updateReturnDays',[\App\Http\Controllers\admin\InfopageController::class,'updateReturnDays'])->name('return_days.updateReturnDays');
    Route::get('return_days/return_days/edit',[\App\Http\Controllers\admin\InfopageController::class,'editReturnDays'])->name('return_days.editReturnDays');

    Route::get('inquiries',[\App\Http\Controllers\admin\InquiryController::class,'index'])->name('inquiries.list');
    Route::post('allinquirieslist',[\App\Http\Controllers\admin\InquiryController::class,'allinquirieslist'])->name('allinquirieslist');
    Route::get('inquiries/{id}/delete',[\App\Http\Controllers\admin\InquiryController::class,'deleteinquiries'])->name('inquiries.delete');

    Route::get('blogcategories',[\App\Http\Controllers\admin\BlogCategoryController::class,'index'])->name('blogcategories.list');
    Route::get('blogcategories/create',[\App\Http\Controllers\admin\BlogCategoryController::class,'create'])->name('blogcategories.add');
    Route::post('blogcategories/save',[\App\Http\Controllers\admin\BlogCategoryController::class,'save'])->name('blogcategories.save');
    Route::post('allblogcategorylist',[\App\Http\Controllers\admin\BlogCategoryController::class,'allblogcategorylist'])->name('allblogcategorylist');
    Route::get('changeblogcategorystatus/{id}',[\App\Http\Controllers\admin\BlogCategoryController::class,'changeblogcategorystatus'])->name('blogcategories.changeblogcategorystatus');
    Route::get('blogcategories/{id}/delete',[\App\Http\Controllers\admin\BlogCategoryController::class,'deletecategory'])->name('blogcategories.delete');
    Route::get('blogcategories/{id}/edit',[\App\Http\Controllers\admin\BlogCategoryController::class,'editcategory'])->name('blogcategories.edit');

    Route::get('blogs',[\App\Http\Controllers\admin\BlogController::class,'index'])->name('blogs.list');
    Route::get('blogs/create',[\App\Http\Controllers\admin\BlogController::class,'create'])->name('blogs.add');
    Route::post('blogs/save',[\App\Http\Controllers\admin\BlogController::class,'save'])->name('blogs.save');
    Route::post('allbloglist',[\App\Http\Controllers\admin\BlogController::class,'allbloglist'])->name('allbloglist');
    Route::get('changeblogstatus/{id}',[\App\Http\Controllers\admin\BlogController::class,'changeblogstatus'])->name('blogs.changeblogstatus');
    Route::get('blogs/{id}/delete',[\App\Http\Controllers\admin\BlogController::class,'deleteblog'])->name('blogs.delete');
    Route::get('blogs/{id}/edit',[\App\Http\Controllers\admin\BlogController::class,'editblog'])->name('blogs.edit');
    Route::post('blogs/uploadfile',[\App\Http\Controllers\admin\BlogController::class,'uploadfile'])->name('blogs.uploadfile');
    Route::post('blogs/removefile',[\App\Http\Controllers\admin\BlogController::class,'removefile'])->name('blogs.removefile');

    
    Route::get('banners',[\App\Http\Controllers\admin\BannerController::class,'index'])->name('banners.list');
    Route::get('banners/create',[\App\Http\Controllers\admin\BannerController::class,'create'])->name('banners.add');
    Route::post('banners/save',[\App\Http\Controllers\admin\BannerController::class,'save'])->name('banners.save');
    Route::post('allbannerlist',[\App\Http\Controllers\admin\BannerController::class,'allbannerlist'])->name('allbannerlist');
    Route::get('changebannerstatus/{id}',[\App\Http\Controllers\admin\BannerController::class,'changebannerstatus'])->name('banners.changeblogstatus');
    Route::get('banners/{id}/delete',[\App\Http\Controllers\admin\BannerController::class,'deletebanner'])->name('banners.delete');
    Route::get('banners/{id}/edit',[\App\Http\Controllers\admin\BannerController::class,'editbanner'])->name('banners.edit');
    Route::post('banners/uploadfile',[\App\Http\Controllers\admin\BannerController::class,'uploadfile'])->name('banners.uploadfile');
    Route::post('banners/removefile',[\App\Http\Controllers\admin\BannerController::class,'removefile'])->name('banners.removefile');
    
});


