<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\admin\OpinionController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\TermConditionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\OtherPageController;
use App\Http\Controllers\NewsLatterController;
use App\Http\Controllers\DiamondController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\StepController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CountryStateCityController;

use Illuminate\Support\Facades\Artisan;
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

Route::get('/clear-cache', function() {
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    return "Cache is cleared";
});

//Frontend Route

Route::get('/',[HomeController::class,'index'])->name('frontend.home');
Route::get('infopage/about-us',[AboutUsController::class,'index'])->name('frontend.aboutus');
Route::get('infopage/contact-us',[ContactUsController::class,'index'])->name('frontend.contactus');
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


Route::get('gemver-difference',[OtherPageController::class,'gemverdifference'])->name('frontend.gemverdifference');
Route::get('infopage/customer-values',[OtherPageController::class,'customervalues'])->name('frontend.customervalues');
Route::get('infopage/market-need',[OtherPageController::class,'marketneed'])->name('frontend.marketneed');
Route::get('infopage/ethical-edge',[OtherPageController::class,'ethicaledge'])->name('frontend.ethicaledge');
Route::get('infopage/diamond-anatomy',[OtherPageController::class,'diamondanatomy'])->name('frontend.diamondanatomy');
Route::get('infopage/learn-about-lab-made-diamonds',[OtherPageController::class,'learnaboutlabmadediamonds'])->name('frontend.learnaboutlabmadediamonds');
Route::get('infopage/conflict-free-diamonds',[OtherPageController::class,'conflictfreediamonds'])->name('frontend.conflictfreediamonds');


// Route::view('engagement','frontend.engagement');
// Route::view('finejewellery','frontend.finejewellery');
// Route::view('labgrowndiamonds','frontend.labgrowndiamonds');
// Route::view('weddingbrands','frontend.weddingbands');
// Route::view('custommadejewellery','frontend.custommadejewellery');

 //Route::view('demo','frontend.engagement');

Route::get('engagement',[OtherPageController::class,'engagement']);
Route::get('finejewellery',[OtherPageController::class,'finejewellery']);
Route::get('labgrowndiamonds',[OtherPageController::class,'labgrowndiamonds']);
Route::get('custommadejewellery',[OtherPageController::class,'custommadejewellery']);
Route::get('weddingbands',[OtherPageController::class,'weddingbands']);


Route::get('/shop/{catid?}',[ProductController::class,'index'])->name('frontend.shop'); 
Route::get('/product-details/{variantslug}',[ProductController::class,'product_detail'])->name('frontend.product.productdetails');
Route::post('/product-filter',[ProductController::class,'fetchproduct'])->name('frontend.product.productfilter');
Route::post('/product-details-filter',[ProductController::class,'fetchproductdetails'])->name('frontend.product.productdetailsfilter');
Route::post('/product-details-variants',[ProductController::class,'fetchvariants'])->name('frontend.product.productdetailsvariants');
Route::post('/search_products',[ProductController::class,'search_products'])->name('frontend.search_products'); 

Route::get('infopage/blogs',[BlogController::class,'index'])->name('frontend.blogs');
Route::post('/blogs-filter',[BlogController::class,'fetchblogs'])->name('frontend.blogs.blogfilter');
Route::get('/blog/{id}',[BlogController::class,'blogdetails'])->name('frontend.blog.blog');

Route::get('infopage/testimonials',[TestimonialsController::class,'index'])->name('frontend.testimonials');

Route::post('/inquiry',[ContactUsController::class,'inquiry_save'])->name('frontend.inquiry.save');
Route::post('/news-latter',[NewsLatterController::class,'save'])->name('frontend.newslatter.save');
Route::post('/hint',[ContactUsController::class,'hint_save'])->name('frontend.hint.save');

Route::get('/diamond-setting/{catid}/{id?}',[DiamondController::class,'index']);
Route::post('/diamonds',[DiamondController::class,'getDiamonds']);
Route::get('/diamond-details/{catid}/{id}',[DiamondController::class,'getDiamondDetails']);
Route::get('/product-setting/{catid}/{id?}',[DiamondController::class,'customproducts']);
Route::post('/custom_products',[DiamondController::class,'getProducts']);
Route::get('/custom-product-details/{catid}/{id}/{vid}',[DiamondController::class,'getCustomProductDetails']);
Route::get('/product_complete/{catid}',[DiamondController::class,'getProductComplete']);

Route::get('/product-setting-edit/{id}/edit',[DiamondController::class,'editproductsetting']);
Route::get('/diamond-setting-edit/{id}/edit',[DiamondController::class,'editdiamondsetting']);

Route::post('/cart',[CartController::class,'save'])->name('frontend.cart.save');
Route::post('/compare',[CompareController::class,'save'])->name('frontend.compare.save');
Route::get('/compare/{id}',[CompareController::class,'index'])->name('frontend.compare.list');
Route::get('/compareladdiamond',[CompareController::class,'compareladdiamond'])->name('frontend.compareladdiamond.list');

Route::get('/lab-diamond/{shap?}/{color?}',[DiamondController::class,'laddiamond']);
Route::post('/alllab-diamond',[DiamondController::class,'getLadDiamonds']);
Route::get('/laddiamond-details/{id}',[DiamondController::class,'getLadDiamondDetails']);

Route::get('/step/{slug}/one',[StepController::class,'stepone']);
Route::get('/step/{slug}/two',[StepController::class,'steptwo']);
Route::get('/step/{slug}/three',[StepController::class,'stepthree']);
Route::get('/step/{slug}/four',[StepController::class,'stepfour']);

Route::post('/opinion',[OpinionController::class,'save'])->name('frontend.opinion.save');

Route::post('add-to-wishlist',[WishlistController::class,'addtowishlist'])->name('frontend.addtowishlist');
Route::get('/load-wishlist-data',[WishlistController::class,'wishloadbyajax'])->name('frontend.wishloadbyajax');
Route::get('/wishlist',[WishlistController::class,'index'])->name('frontend.index');
Route::delete('/delete-from-wishlist',[WishlistController::class,'deletefromwishlist'])->name('frontend.deletefromwishlist');

Route::post('add-to-cart',[CartController::class,'addtocart'])->name('frontend.addtocart');
Route::get('/load-cart-data',[CartController::class,'cartloadbyajax'])->name('frontend.cartloadbyajax');
Route::get('/cart',[CartController::class,'index'])->name('frontend.index');
Route::delete('/delete-from-cart',[CartController::class,'deletefromcart'])->name('frontend.deletefromcart');
Route::post('/update-to-cart',[CartController::class,'updatetocart'])->name('frontend.updatetocart');



Route::get('login',[\App\Http\Controllers\AuthController::class,'index'])->name('frontend.login');
Route::post('frontendpostlogin', [\App\Http\Controllers\AuthController::class, 'postLogin'])->name('frontend.postlogin');
Route::get('register',[\App\Http\Controllers\AuthController::class,'register'])->name('frontend.register');
Route::post('frontendpostregister', [\App\Http\Controllers\AuthController::class, 'postRegister'])->name('frontend.postregister');
Route::get('forget-password',[\App\Http\Controllers\AuthController::class,'forgetpassword'])->name('frontend.forgetpassword');
Route::get('messagebox',[\App\Http\Controllers\AuthController::class,'messagebox'])->name('frontend.messagebox');
Route::post('postforgetpassword',[\App\Http\Controllers\AuthController::class,'postForgetpassword'])->name('frontend.postforgetpassword');
Route::get('resetpassword/{slug}',[\App\Http\Controllers\AuthController::class,'resetpassword'])->name('frontend.resetpassword');
Route::post('postresetpassword',[\App\Http\Controllers\AuthController::class,'postResetpassword'])->name('frontend.postresetpassword');
Route::post('redeem_coupon',[\App\Http\Controllers\CartController::class,'redeem_coupon'])->name('frontend.redeem_coupon');


Route::post('AddReview',[\App\Http\Controllers\ReviewController::class,'AddReview'])->name('frontend.AddReview');

Route::post('loadmore',[\App\Http\Controllers\ReviewController::class,'review'])->name('frontend.review');
Route::post('/loadmore/load_data',[\App\Http\Controllers\ReviewController::class,'load_data'])->name('frontend.load_data');

Route::get('country-state-city', [CountryStateCityController::class, 'index']);
Route::post('get-states-by-country', [CountryStateCityController::class, 'getState']);
Route::post('get-cities-by-state', [CountryStateCityController::class, 'getCity']);




Route::group(['middleware'=>['frontendauth']],function (){

    //order route
    Route::get('checkout',[\App\Http\Controllers\OrderController::class,'checkout'])->name('frontend.checkout');
    Route::post('orders/saveorder',[\App\Http\Controllers\OrderController::class,'saveorder'])->name('orders.saveorder');

    //my accound route
    Route::get('address', [\App\Http\Controllers\AddressController::class,'address'])->name('user.address');
    //Route::get('address',[\App\Http\Controllers\OrderController::class,'address'])->name('frontend.checkout');
    Route::post('address/save',[\App\Http\Controllers\AddressController::class,'addresssave'])->name('address.save');
    Route::get('address/{id}/delete',[\App\Http\Controllers\AddressController::class,'deleteaddress'])->name('address.delete');
    Route::get('address/{id}/edit',[\App\Http\Controllers\AddressController::class,'editaddress'])->name('address.edit');

    Route::post('updateAddress',[\App\Http\Controllers\AddressController::class,'updateAddress'])->name('address.update');


    Route::post('handle-payment', [\App\Http\Controllers\PayPalPaymentController::class,'handlePayment'])->name('make.payment');
    Route::get('cancel-payment', [\App\Http\Controllers\PayPalPaymentController::class,'paymentCancel'])->name('cancel.payment');
    Route::get('payment-success', [\App\Http\Controllers\PayPalPaymentController::class,'paymentSuccess'])->name('success.payment');

    Route::get('paymentsuccess', [\App\Http\Controllers\PayPalPaymentController::class,'paymentsuccesspage'])->name('success.paymentsuccess');
    Route::get('paymentcancel', [\App\Http\Controllers\PayPalPaymentController::class,'paymentcancelpage'])->name('success.paymentcancel');


    Route::get('orders', [\App\Http\Controllers\OrderController::class,'orders'])->name('order.orders');
    Route::get('orderdetails/{orderid}', [\App\Http\Controllers\OrderController::class,'orderdetails'])->name('order.orderdetails');

    Route::get('account', [\App\Http\Controllers\AuthController::class,'account'])->name('user.account');
    Route::post('updateProfile',[\App\Http\Controllers\AuthController::class,'updateProfile'])->name('user.update');
    Route::post('updatePassword',[\App\Http\Controllers\AuthController::class,'updatePassword'])->name('password.update');
    
});

Route::get('frontend/logout', function() {
    if(session()->has('customer')){
        session()->pull('customer');
    }
   return redirect('/');
});




//Admin  Rpute //////////////////////////////////////////////////////////////////////////////////////////////////////////


Route::get('admin',[\App\Http\Controllers\admin\AuthController::class,'index'])->name('admin.login');
Route::post('adminpostlogin', [\App\Http\Controllers\admin\AuthController::class, 'postLogin'])->name('admin.postlogin');
Route::get('logout', [\App\Http\Controllers\admin\AuthController::class, 'logout'])->name('admin.logout');
Route::get('admin/403_page',[\App\Http\Controllers\admin\AuthController::class,'invalid_page'])->name('admin.403_page');


Route::group(['prefix'=>'admin','middleware'=>['auth','userpermission'],'as'=>'admin.'],function () {
    Route::get('dashboard', [\App\Http\Controllers\admin\DashboardController::class, 'index'])->name('dashboard');
    Route::post('TodayallOrderlist',[\App\Http\Controllers\admin\DashboardController::class,'TodayallOrderlist'])->name('TodayallOrderlist');

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
    Route::get('categories/createSlug/{title}',[\App\Http\Controllers\admin\CategoryController::class,'createSlug'])->name('categories.createSlug');

    Route::get('categorysteppopup/{id}',[\App\Http\Controllers\admin\StepPopupController::class,'index'])->name('categorysteppopup.list');
    Route::get('steppopup/{id}/edit',[\App\Http\Controllers\admin\StepPopupController::class,'editsteppopup'])->name('steppopup.edit');
    Route::post('addorupdatestepPopup',[\App\Http\Controllers\admin\StepPopupController::class,'addorupdatestepPopup'])->name('steppopup.addorupdatestepPopup');

    Route::get('products',[\App\Http\Controllers\admin\ProductController::class,'index'])->name('products.list');
    Route::get('products/create',[\App\Http\Controllers\admin\ProductController::class,'create'])->name('products.add');
    Route::get('customproducts/custom',[\App\Http\Controllers\admin\ProductController::class,'create'])->name('customproducts.add');
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
    Route::get('createSlugTitle/{title}',[\App\Http\Controllers\admin\ProductController::class,'createSlugTitle'])->name('createSlugTitle.slug');
    Route::post('products/saveDraft',[\App\Http\Controllers\admin\ProductController::class,'saveDraft'])->name('products.saveDraft');

    Route::get('addAttributebox/{id}',[\App\Http\Controllers\admin\ProductController::class,'addAttributebox'])->name('addAttributebox');
    Route::get('addVariantAttributebox/{id}',[\App\Http\Controllers\admin\ProductController::class,'addVariantAttributebox'])->name('addVariantAttributebox');
    Route::post('productattribute/save',[\App\Http\Controllers\admin\ProductController::class,'productattributesave'])->name('productattribute.save');
    Route::post('subproductattribute/save',[\App\Http\Controllers\admin\ProductController::class,'subproductattributesave'])->name('subproductattribute.save');
    Route::post('subproductattribute/edit',[\App\Http\Controllers\admin\ProductController::class,'subproductattributeedit'])->name('subproductattribute.edit');

    Route::get('customproducts',[\App\Http\Controllers\admin\ProductController::class,'customproducts'])->name('customproducts.list');
    Route::post('allcustomproductlist',[\App\Http\Controllers\admin\ProductController::class,'allcustomproductlist'])->name('allcustomproductlist');

    Route::get('drafproducts',[\App\Http\Controllers\admin\ProductController::class,'drafproducts'])->name('drafproducts.list');
    Route::post('alldrafproductlist',[\App\Http\Controllers\admin\ProductController::class,'alldrafproductlist'])->name('alldrafproductlist');
    
    Route::get('users',[\App\Http\Controllers\admin\UserController::class,'index'])->name('users.list');
    Route::post('addorupdateuser',[\App\Http\Controllers\admin\UserController::class,'addorupdateuser'])->name('users.addorupdate');
    Route::post('alluserslist',[\App\Http\Controllers\admin\UserController::class,'alluserslist'])->name('alluserslist');
    Route::get('changeuserstatus/{id}',[\App\Http\Controllers\admin\UserController::class,'changeuserstatus'])->name('users.changeuserstatus');
    Route::get('users/{id}/edit',[\App\Http\Controllers\admin\UserController::class,'edituser'])->name('users.edit');
    Route::get('users/{id}/delete',[\App\Http\Controllers\admin\UserController::class,'deleteuser'])->name('users.delete');
    Route::get('users/{id}/permission',[\App\Http\Controllers\admin\UserController::class,'permissionuser'])->name('users.permission');
    Route::post('savepermission',[\App\Http\Controllers\admin\UserController::class,'savepermission'])->name('users.savepermission');

    Route::get('end_users',[\App\Http\Controllers\admin\EndUserController::class,'index'])->name('end_users.list');
    Route::post('addorupdateEnduser',[\App\Http\Controllers\admin\EndUserController::class,'addorupdateEnduser'])->name('end_users.addorupdate');
    Route::post('allEnduserlist',[\App\Http\Controllers\admin\EndUserController::class,'allEnduserlist'])->name('allEnduserlist');
    Route::get('changeEnduserstatus/{id}',[\App\Http\Controllers\admin\EndUserController::class,'changeEnduserstatus'])->name('end_users.changeEnduserstatus');
    Route::get('end_users/{id}/delete',[\App\Http\Controllers\admin\EndUserController::class,'deleteEnduser'])->name('end_users.delete');


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

    Route::get('homesettings',[\App\Http\Controllers\admin\HomeSettingController::class,'index'])->name('homesettings.create');
    Route::post('homesettings/edit',[\App\Http\Controllers\admin\HomeSettingController::class,'editHomeSettings'])->name('homesettings.edit');

    Route::get('page',[\App\Http\Controllers\admin\InfopageController::class,'page'])->name('infopage.page');

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

    Route::get('customer_value',[\App\Http\Controllers\admin\InfopageController::class,'customer_value'])->name('customer_value.list');
    Route::post('updateCustomerValue',[\App\Http\Controllers\admin\InfopageController::class,'updateCustomerValue'])->name('customer_value.updateCustomerValue');

    Route::get('market_need',[\App\Http\Controllers\admin\InfopageController::class,'market_need'])->name('market_need.list');
    Route::post('updateMarketNeed',[\App\Http\Controllers\admin\InfopageController::class,'updateMarketNeed'])->name('market_need.updateMarketNeed');

    Route::get('why_friendly',[\App\Http\Controllers\admin\InfopageController::class,'why_friendly'])->name('why_friendly.list');
    Route::post('updateWhyFriendly',[\App\Http\Controllers\admin\InfopageController::class,'updateWhyFriendly'])->name('market_need.updateWhyFriendly');
    
    Route::get('learn_about_lab_made_diamonds',[\App\Http\Controllers\admin\InfopageController::class,'learn_about_lab_made_diamonds'])->name('learn_about_lab_made_diamonds.list');
    Route::post('updateLearnAboutLabMadeDiamonds',[\App\Http\Controllers\admin\InfopageController::class,'updateLearnAboutLabMadeDiamonds'])->name('market_need.updateLearnAboutLabMadeDiamonds');

    Route::get('conflict_free_diamonds',[\App\Http\Controllers\admin\InfopageController::class,'conflict_free_diamonds'])->name('conflict_free_diamonds.list');
    Route::post('updateConflictFreeDiamonds',[\App\Http\Controllers\admin\InfopageController::class,'updateConflictFreeDiamonds'])->name('market_need.updateConflictFreeDiamonds');

    Route::get('diamond_anatomy',[\App\Http\Controllers\admin\InfopageController::class,'diamond_anatomy'])->name('diamond_anatomy.list');
    Route::get('infopage/diamond_anatomies/edit',[\App\Http\Controllers\admin\InfopageController::class,'editDiamondAnatomy'])->name('infopage.editDiamondAnatomy');
    Route::post('updateDiamondAnatomy',[\App\Http\Controllers\admin\InfopageController::class,'updateDiamondAnatomy'])->name('infopage.updateDiamondAnatomy');

    Route::get('gemver_difference',[\App\Http\Controllers\admin\InfopageController::class,'gemver_difference'])->name('gemver_difference.list');
    Route::get('infopage/gemver_difference/edit',[\App\Http\Controllers\admin\InfopageController::class,'editGemverDifference'])->name('infopage.editGemverDifference');
    Route::post('updateGemverDifference',[\App\Http\Controllers\admin\InfopageController::class,'updateGemverDifference'])->name('infopage.updateGemverDifference');

    Route::get('inquiries',[\App\Http\Controllers\admin\InquiryController::class,'index'])->name('inquiries.list');
    Route::post('allinquirieslist',[\App\Http\Controllers\admin\InquiryController::class,'allinquirieslist'])->name('allinquirieslist');
    Route::get('inquiries/{id}/delete',[\App\Http\Controllers\admin\InquiryController::class,'deleteinquiries'])->name('inquiries.delete');

    Route::get('opinions',[\App\Http\Controllers\admin\OpinionController::class,'index'])->name('opinions.list');
    Route::post('allopinionslist',[\App\Http\Controllers\admin\OpinionController::class,'allopinionslist'])->name('allopinionslist');
    Route::get('inquiries/{id}/delete',[\App\Http\Controllers\admin\OpinionController::class,'deleteinquiries'])->name('inquiries.delete');

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
    Route::get('blogs/createSlug/{title}',[\App\Http\Controllers\admin\BlogController::class,'createSlug'])->name('blogs.createSlug');

    
    Route::get('banners',[\App\Http\Controllers\admin\BannerController::class,'index'])->name('banners.list');
    Route::get('banners/create',[\App\Http\Controllers\admin\BannerController::class,'create'])->name('banners.add');
    Route::post('banners/save',[\App\Http\Controllers\admin\BannerController::class,'save'])->name('banners.save');
    Route::post('allbannerlist',[\App\Http\Controllers\admin\BannerController::class,'allbannerlist'])->name('allbannerlist');
    Route::get('changebannerstatus/{id}',[\App\Http\Controllers\admin\BannerController::class,'changebannerstatus'])->name('banners.changeblogstatus');
    Route::get('banners/{id}/delete',[\App\Http\Controllers\admin\BannerController::class,'deletebanner'])->name('banners.delete');
    Route::get('banners/{id}/edit',[\App\Http\Controllers\admin\BannerController::class,'editbanner'])->name('banners.edit');
    Route::post('banners/uploadfile',[\App\Http\Controllers\admin\BannerController::class,'uploadfile'])->name('banners.uploadfile');
    Route::post('banners/removefile',[\App\Http\Controllers\admin\BannerController::class,'removefile'])->name('banners.removefile');
    Route::post('banners/getBannerInfoVal',[\App\Http\Controllers\admin\BannerController::class,'getBannerInfoVal'])->name('banners.getBannerInfoVal');
    Route::get('banners/getproducts/{cat_id}',[\App\Http\Controllers\admin\BannerController::class,'getproducts'])->name('banners.getproducts');

    Route::get('newslatters',[\App\Http\Controllers\admin\NewsLatterController::class,'index'])->name('newslatter.list');
    Route::post('allnewslatterslist',[\App\Http\Controllers\admin\NewsLatterController::class,'allnewslatterslist'])->name('allnewslatterslist');
    Route::get('newslatters/create',[\App\Http\Controllers\admin\NewsLatterController::class,'create'])->name('newslatter.add');
    Route::post('newslatters/save',[\App\Http\Controllers\admin\NewsLatterController::class,'save'])->name('newslatter.save');

    Route::get('newslatters/welcome_mail',[\App\Http\Controllers\admin\NewsLatterController::class,'welcome_mail'])->name('newslatter.welcome_mail');
    Route::post('newslatters/save_welcome_mail',[\App\Http\Controllers\admin\NewsLatterController::class,'save_welcome_mail'])->name('newslatter.save_welcome_mail');

    Route::get('compoanies',[\App\Http\Controllers\admin\CompanyController::class,'index'])->name('company.list');
    Route::post('updateCompanyPercentage',[\App\Http\Controllers\admin\CompanyController::class,'updateCompanyPercentage'])->name('company.updateCompanyPercentage');
    Route::get('company/{id}/edit',[\App\Http\Controllers\admin\CompanyController::class,'editcompany'])->name('company.edit');
    
    Route::get('addDiamond',[\App\Http\Controllers\admin\DiamondController::class,'addDiamond'])->name('addDiamond');
    Route::get('diamond',[\App\Http\Controllers\admin\DiamondController::class,'index'])->name('diamond.list');
    Route::post('alldiamondlist',[\App\Http\Controllers\admin\DiamondController::class,'alldiamondlist'])->name('alldiamondlist');
    Route::get('file-import',[\App\Http\Controllers\admin\DiamondController::class,'importView'])->name('importview');
    //Route::post('import',[\App\Http\Controllers\admin\DiamondController::class,'import'])->name('diamonds.save');
    //Route::get('importnew', [\App\Http\Controllers\admin\DiamondController::class, 'importnew'])->name('diamonds.savenew');
    
    Route::get('changediamondstatus/{id}',[\App\Http\Controllers\admin\DiamondController::class,'changediamondstatus'])->name('diamonds.changediamondstatus');


    Route::get('steps',[\App\Http\Controllers\admin\StepController::class,'index'])->name('steps.list');
    Route::get('steps/create',[\App\Http\Controllers\admin\StepController::class,'create'])->name('steps.add');
    Route::post('steps/save',[\App\Http\Controllers\admin\StepController::class,'save'])->name('steps.save');
    Route::post('stepone/save',[\App\Http\Controllers\admin\StepController::class,'savestepone'])->name('stepone.save');
    Route::post('steptwo/save',[\App\Http\Controllers\admin\StepController::class,'savesteptwo'])->name('steptwo.save');
    Route::post('stepthree/save',[\App\Http\Controllers\admin\StepController::class,'savestepthree'])->name('stepthree.save');
    Route::post('stepfour/save',[\App\Http\Controllers\admin\StepController::class,'savestepfour'])->name('stepfour.save');
    Route::post('allsteplist',[\App\Http\Controllers\admin\StepController::class,'allsteplist'])->name('allsteplist');
    Route::get('changestepstatus/{id}',[\App\Http\Controllers\admin\StepController::class,'changestepstatus'])->name('steps.changestepstatus');
    Route::get('steps/{id}/delete',[\App\Http\Controllers\admin\StepController::class,'deletestep'])->name('steps.delete');
    Route::get('steps/{id}/edit',[\App\Http\Controllers\admin\StepController::class,'editstep'])->name('steps.edit');
    Route::get('stepone/{id}/edit',[\App\Http\Controllers\admin\StepController::class,'editstepone'])->name('stepone.edit');
    Route::get('steptwo/{id}/edit',[\App\Http\Controllers\admin\StepController::class,'editsteptwo'])->name('steptwo.edit');
    Route::get('stepthree/{id}/edit',[\App\Http\Controllers\admin\StepController::class,'editstepthree'])->name('stepthree.edit');
    Route::get('stepfour/{id}/edit',[\App\Http\Controllers\admin\StepController::class,'editstepfour'])->name('stepfour.edit');
    Route::post('steps/uploadfile',[\App\Http\Controllers\admin\StepController::class,'uploadfile'])->name('steps.uploadfile');
    Route::post('steps/removefile',[\App\Http\Controllers\admin\StepController::class,'removefile'])->name('steps.removefile');


    Route::get('shopbystyle',[\App\Http\Controllers\admin\ShopByStyleController::class,'index'])->name('shopbystyle.list');
    Route::get('shopbystyle/create',[\App\Http\Controllers\admin\ShopByStyleController::class,'create'])->name('shopbystyle.add');
    Route::post('shopbystyle/save',[\App\Http\Controllers\admin\ShopByStyleController::class,'save'])->name('shopbystyle.save');
    Route::post('allshopbystylelist',[\App\Http\Controllers\admin\ShopByStyleController::class,'allshopbystylelist'])->name('allshopbystylelist');
    Route::get('changeshopbystylestatus/{id}',[\App\Http\Controllers\admin\ShopByStyleController::class,'changeshopbystylestatus'])->name('shopbystyle.changeshopbystylestatus');
    Route::get('shopbystyle/{id}/delete',[\App\Http\Controllers\admin\ShopByStyleController::class,'deleteshopbystyle'])->name('shopbystyle.delete');
    Route::get('shopbystyle/{id}/edit',[\App\Http\Controllers\admin\ShopByStyleController::class,'editshopbystyle'])->name('shopbystyle.edit');
    Route::post('shopbystyle/uploadfile',[\App\Http\Controllers\admin\ShopByStyleController::class,'uploadfile'])->name('shopbystyle.uploadfile');
    Route::post('shopbystyle/removefile',[\App\Http\Controllers\admin\ShopByStyleController::class,'removefile'])->name('shopbystyle.removefile');
    Route::get('shopbystyle/checkparentcat/{id}',[\App\Http\Controllers\admin\ShopByStyleController::class,'checkparentcat'])->name('shopbystyle.checkparentcat');
    Route::get('shopbystyle/getterm/{id}', [\App\Http\Controllers\admin\ShopByStyleController::class, 'loadterm'])->name('shopbystyle.checkparentcat');

    Route::get('offers',[\App\Http\Controllers\admin\OfferController::class,'index'])->name('offers.list');
    Route::post('addorupdateoffer',[\App\Http\Controllers\admin\OfferController::class,'addorupdateoffer'])->name('offers.addorupdate');
    Route::post('allofferlist',[\App\Http\Controllers\admin\OfferController::class,'allofferlist'])->name('allofferlist');
    Route::get('offers/{id}/edit',[\App\Http\Controllers\admin\OfferController::class,'editoffer'])->name('offers.edit');
    Route::get('offers/{id}/delete',[\App\Http\Controllers\admin\OfferController::class,'deleteoffer'])->name('offers.delete');
    Route::get('chageofferstatus/{id}',[\App\Http\Controllers\admin\OfferController::class,'chageofferstatus'])->name('offers.chageofferstatus');

    Route::get('order_includes',[\App\Http\Controllers\admin\OrderIncludesController::class,'index'])->name('order_includes.list');
    Route::get('order_includes/create',[\App\Http\Controllers\admin\OrderIncludesController::class,'create'])->name('order_includes.add');
    Route::post('order_includes/save',[\App\Http\Controllers\admin\OrderIncludesController::class,'save'])->name('order_includes.save');
    Route::post('allorderinludeslist',[\App\Http\Controllers\admin\OrderIncludesController::class,'allorderinludeslist'])->name('allorderinludeslist');
    Route::get('changeorder_includesstatus/{id}',[\App\Http\Controllers\admin\OrderIncludesController::class,'changeorder_includestatus'])->name('order_includes.changeshopbystylestatus');
    Route::get('order_includes/{id}/delete',[\App\Http\Controllers\admin\OrderIncludesController::class,'deleteorder_includes'])->name('order_includes.delete');
    Route::get('order_includes/{id}/edit',[\App\Http\Controllers\admin\OrderIncludesController::class,'editorder_includes'])->name('order_includes.edit');
    Route::post('order_includes/uploadfile',[\App\Http\Controllers\admin\OrderIncludesController::class,'uploadfile'])->name('order_includes.uploadfile');
    Route::post('order_includes/removefile',[\App\Http\Controllers\admin\OrderIncludesController::class,'removefile'])->name('order_includes.removefile');
    Route::get('order_includes/checkparentcat/{id}',[\App\Http\Controllers\admin\OrderIncludesController::class,'checkparentcat'])->name('order_includes.checkparentcat');
    Route::get('order_includes/getterm/{id}', [\App\Http\Controllers\admin\OrderIncludesController::class, 'loadterm'])->name('order_includes.checkparentcat');

    Route::get('blogbanners',[\App\Http\Controllers\admin\BlogBannerController::class,'index'])->name('blogbanners.list');
    Route::get('blogbanners/create',[\App\Http\Controllers\admin\BlogBannerController::class,'create'])->name('blogbanners.add');
    Route::post('blogbanners/save',[\App\Http\Controllers\admin\BlogBannerController::class,'save'])->name('blogbanners.save');
    Route::post('allblogbannerlist',[\App\Http\Controllers\admin\BlogBannerController::class,'allblogbannerlist'])->name('allblogbannerlist');
    Route::get('changeblogbannerstatus/{id}',[\App\Http\Controllers\admin\BlogBannerController::class,'changeblogbannerstatus'])->name('blogbanners.changeblogbannerstatus');
    Route::get('blogbanners/{id}/delete',[\App\Http\Controllers\admin\BlogBannerController::class,'deletebanner'])->name('blogbanners.delete');
    Route::get('blogbanners/{id}/edit',[\App\Http\Controllers\admin\BlogBannerController::class,'editbanner'])->name('blogbanners.edit');
    Route::post('blogbanners/uploadfile',[\App\Http\Controllers\admin\BlogBannerController::class,'uploadfile'])->name('blogbanners.uploadfile');
    Route::post('blogbanners/removefile',[\App\Http\Controllers\admin\BlogBannerController::class,'removefile'])->name('blogbanners.removefile');
    Route::post('blogbanners/getBannerInfoVal',[\App\Http\Controllers\admin\BlogBannerController::class,'getBannerInfoVal'])->name('blogbanners.getBannerInfoVal');
    Route::post('viewhomesettings/edit',[\App\Http\Controllers\admin\BlogBannerController::class,'editHomeSettings'])->name('viewhomesettings.edit');

    Route::get('megamenus',[\App\Http\Controllers\admin\MegaMenuController::class,'index'])->name('megamenus.list');
    Route::post('updateMegaMenu',[\App\Http\Controllers\admin\MegaMenuController::class,'updateMegaMenu'])->name('megamenus.updateMegaMenu');
    Route::get('megamenus/{id}/edit',[\App\Http\Controllers\admin\MegaMenuController::class,'editmegamenus'])->name('megamenus.edit');

    Route::get('submenus/{id}',[\App\Http\Controllers\admin\MegaMenuController::class,'submenu'])->name('submenus.list');
    Route::post('updateSubMenu',[\App\Http\Controllers\admin\MegaMenuController::class,'updateSubMenu'])->name('submenus.updateSubMenu');
    Route::get('submenus/{id}/edit',[\App\Http\Controllers\admin\MegaMenuController::class,'editsubmenus'])->name('submenus.edit');

    Route::get('submenus/manage/{id}/{megaid}',[\App\Http\Controllers\admin\MegaMenuController::class,'submenumanage'])->name('submenus.manage');
    Route::post('updateMenuManage',[\App\Http\Controllers\admin\MegaMenuController::class,'updateMenuManage'])->name('submenus.updateMenuManage');
    Route::get('submenusmanage/{id}/edit',[\App\Http\Controllers\admin\MegaMenuController::class,'editsubmenumanage'])->name('submenus.manage.edit');
    Route::get('submenusmanage/{id}/delete',[\App\Http\Controllers\admin\MegaMenuController::class,'deletesubmenusmanage'])->name('submenusmanage.delete');

    Route::get('homebanners',[\App\Http\Controllers\admin\HomeBannerController::class,'index'])->name('homebanners.list');
    Route::get('homebanners/create',[\App\Http\Controllers\admin\HomeBannerController::class,'create'])->name('homebanners.add');
    Route::post('homebanners/save',[\App\Http\Controllers\admin\HomeBannerController::class,'save'])->name('homebanners.save');
    Route::post('allhomebannerlist',[\App\Http\Controllers\admin\HomeBannerController::class,'allhomebannerlist'])->name('allhomebannerlist');
    Route::get('changehomebannerstatus/{id}',[\App\Http\Controllers\admin\HomeBannerController::class,'changehomebannerstatus'])->name('homebanners.changehomebannerstatus');
    Route::get('homebanners/{id}/delete',[\App\Http\Controllers\admin\HomeBannerController::class,'deletebanner'])->name('homebanners.delete');
    Route::get('homebanners/{id}/edit',[\App\Http\Controllers\admin\HomeBannerController::class,'editbanner'])->name('homebanners.edit');
    Route::post('homebanners/uploadfile',[\App\Http\Controllers\admin\HomeBannerController::class,'uploadfile'])->name('homebanners.uploadfile');
    Route::post('homebanners/removefile',[\App\Http\Controllers\admin\HomeBannerController::class,'removefile'])->name('homebanners.removefile');
    Route::post('homebanners/getBannerInfoVal',[\App\Http\Controllers\admin\HomeBannerController::class,'getBannerInfoVal'])->name('homebanners.getBannerInfoVal');

    Route::get('pricerange',[\App\Http\Controllers\admin\PriceRangeController::class,'index'])->name('pricerange.list');
    Route::post('addorupdatepricerange',[\App\Http\Controllers\admin\PriceRangeController::class,'addorupdatepricerange'])->name('pricerange.addorupdate');
    Route::post('allpricerangeslist',[\App\Http\Controllers\admin\PriceRangeController::class,'allpricerangeslist'])->name('allpricerangeslist');
    Route::get('changepricerangestatus/{id}',[\App\Http\Controllers\admin\PriceRangeController::class,'changepricerangestatus'])->name('pricerange.changepricerangestatus');
    Route::get('pricerange/{id}/edit',[\App\Http\Controllers\admin\PriceRangeController::class,'editpricerange'])->name('pricerange.edit');
    Route::get('pricerange/{id}/delete',[\App\Http\Controllers\admin\PriceRangeController::class,'deletepricerange'])->name('pricerange.delete');

    Route::get('coupons',[\App\Http\Controllers\admin\CouponController::class,'index'])->name('coupons.list');
    Route::get('coupons/create',[\App\Http\Controllers\admin\CouponController::class,'create'])->name('coupons.add');
    Route::post('coupons/save',[\App\Http\Controllers\admin\CouponController::class,'save'])->name('coupons.save');
    Route::post('allcouponlist',[\App\Http\Controllers\admin\CouponController::class,'allcouponlist'])->name('allcouponlist');
    Route::get('coupons/{id}/edit',[\App\Http\Controllers\admin\CouponController::class,'editcoupon'])->name('coupons.edit');
    Route::get('coupons/{id}/delete',[\App\Http\Controllers\admin\CouponController::class,'deletecoupon'])->name('coupons.delete');

    Route::get('menupage/engagementpage',[\App\Http\Controllers\admin\MenuPageController::class,'engagementpage'])->name('menupage.engagementpage');
    Route::post('updateEngagementPage',[\App\Http\Controllers\admin\MenuPageController::class,'updateEngagementPage'])->name('menupage.updateEngagementPage');
    Route::get('menupage/{id}/edit',[\App\Http\Controllers\admin\MenuPageController::class,'editmenupage'])->name('menupage.edit');

    Route::get('menupage/weddingpage',[\App\Http\Controllers\admin\MenuPageController::class,'weddingpage'])->name('menupage.weddingpage');
    Route::post('updateWeddingPage',[\App\Http\Controllers\admin\MenuPageController::class,'updateWeddingPage'])->name('menupage.updateWeddingPage');

    Route::get('menupage/growndiamondpage',[\App\Http\Controllers\admin\MenuPageController::class,'growndiamondpage'])->name('menupage.growndiamondpage');
    Route::post('updateGrownDiamondPage',[\App\Http\Controllers\admin\MenuPageController::class,'updateGrownDiamondPage'])->name('menupage.updateGrownDiamondPage');

    Route::get('menupage/finejewellerypage',[\App\Http\Controllers\admin\MenuPageController::class,'finejewellerypage'])->name('menupage.finejewellerypage');
    Route::post('updateFineJewelleryPage',[\App\Http\Controllers\admin\MenuPageController::class,'updateFineJewelleryPage'])->name('menupage.updateFineJewelleryPage');

    Route::get('menupage/customjewellerypage',[\App\Http\Controllers\admin\MenuPageController::class,'customjewellerypage'])->name('menupage.customjewellerypage');
    Route::post('updateCustomJewelleryPage',[\App\Http\Controllers\admin\MenuPageController::class,'updateCustomJewelleryPage'])->name('menupage.updateCustomJewelleryPage');


    Route::get('orders',[\App\Http\Controllers\admin\OrderController::class,'index'])->name('orders.list');
    Route::post('allOrderlist',[\App\Http\Controllers\admin\OrderController::class,'allOrderlist'])->name('allOrderlist');
    Route::post('updateOrdernote',[\App\Http\Controllers\admin\OrderController::class,'updateOrdernote'])->name('updateOrdernote');
    Route::get('viewOrder/{orderid}',[\App\Http\Controllers\admin\OrderController::class,'viewOrder'])->name('orders.view');
    Route::post('orders/save',[\App\Http\Controllers\admin\OrderController::class,'save'])->name('orders.save');
    Route::post('change_order_status',[\App\Http\Controllers\admin\OrderController::class,'change_order_status'])->name('change_order_status');
    Route::post('change_order_item_status',[\App\Http\Controllers\admin\OrderController::class,'change_order_item_status'])->name('change_order_item_status');
    Route::get('orders/pdf/{id}',[\App\Http\Controllers\admin\OrderController::class,'generate_pdf'])->name('orders.pdf');
    Route::get('orders/{order_id}/play_video',[\App\Http\Controllers\admin\OrderController::class,'order_play_video'])->name('orders.play_video');

    Route::get('deliveryorders.list',[\App\Http\Controllers\admin\OrderController::class,'deliveryorders'])->name('deliveryorders.list');
    Route::post('allDeliveryOrderlist',[\App\Http\Controllers\admin\OrderController::class,'allDeliveryOrderlist'])->name('allDeliveryOrderlist');
    Route::post('checkorderotp',[\App\Http\Controllers\admin\OrderController::class,'checkorderotp'])->name('checkorderotp');
    Route::post('update_tracking_url',[\App\Http\Controllers\admin\OrderController::class,'updatetrackingurl'])->name('updatetrackingurl');

    Route::get('return_requests',[\App\Http\Controllers\admin\OrderController::class,'return_requests'])->name('return_requests.list');
    Route::post('allReturnRequestlist',[\App\Http\Controllers\admin\OrderController::class,'allReturnRequestlist'])->name('allReturnRequestlist');
    

    Route::get('return_requests_order',[\App\Http\Controllers\admin\OrderController::class,'return_requests_order'])->name('return_requests_order.list');
    Route::post('allReturnRequestOrderlist',[\App\Http\Controllers\admin\OrderController::class,'allReturnRequestOrderlist'])->name('allReturnRequestOrderlist');
    Route::get('payment_status_update/{order_id}',[\App\Http\Controllers\admin\OrderController::class,'payment_status_update'])->name('payment_status_update');

    Route::get('review',[\App\Http\Controllers\admin\ReviewController::class,'index'])->name('review.list');
    Route::post('allReviewlist',[\App\Http\Controllers\admin\ReviewController::class,'allReviewlist'])->name('allReviewlist');
    Route::get('review/create/{id}',[\App\Http\Controllers\admin\ReviewController::class,'create'])->name('review.add');
    Route::post('review/save',[\App\Http\Controllers\admin\ReviewController::class,'save'])->name('review.save');
    Route::get('rejectstatus/{id}',[\App\Http\Controllers\admin\ReviewController::class,'rejectstatus'])->name('review.rejectstatus');
    Route::get('acceptstatus/{id}',[\App\Http\Controllers\admin\ReviewController::class,'acceptstatus'])->name('review.acceptstatus');

    Route::get('menupage/footerpage',[\App\Http\Controllers\admin\MenuPageController::class,'footerpage'])->name('footerpage');
    Route::post('updatefooterpage',[\App\Http\Controllers\admin\MenuPageController::class,'updatefooterpage'])->name('updatefooterpage');

    Route::get('footerpagecategory',[\App\Http\Controllers\admin\MenuPageController::class,'category'])->name('footerpagecategory');
    
    Route::post('whyupdatefooterpage',[\App\Http\Controllers\admin\MenuPageController::class,'whyupdatefooterpage'])->name('whyupdatefooterpage');
    Route::post('contactupdatefooterpage',[\App\Http\Controllers\admin\MenuPageController::class,'contactupdatefooterpage'])->name('contactupdatefooterpage');

    
});

Route::group(['middleware'=>['auth']],function (){
    Route::get('profile',[\App\Http\Controllers\admin\ProfileController::class,'profile'])->name('profile');
    Route::get('profile/{id}/edit',[\App\Http\Controllers\admin\ProfileController::class,'edit'])->name('profile.edit');
    Route::post('profile/update',[\App\Http\Controllers\admin\ProfileController::class,'update'])->name('profile.update');
    
});

//Route::get('admin/importnewdiamond', [\App\Http\Controllers\admin\DiamondController::class, 'importnewdiamond'])->name('admin.diamonds.importnewdiamond');

Route::post('ckeditor/upload', [\App\Http\Controllers\admin\BlogController::class,'upload'])->name('ckeditor.image-upload');




