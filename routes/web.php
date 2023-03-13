<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ActiveUserController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProfileController;


use App\Http\Middleware\RedirectIfAuthenticated;

use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ReturnOrderController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\CompareController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\WishlistController;
use App\Models\User;

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


Route::middleware('auth')->group(function(){
    Route::get("/dashboard",[UserController::class,"index"])->name('dashboard');
    Route::get("/user/logout",[UserController::class,"logout"])->name("user.logout");
    Route::put("/user/profile/update",[UserController::class,"UserProfileUpdate"])->name("user.profile.update");
    Route::put("/user/update/password",[UserController::class,"UserUpdatePassword"])->name("user.update.password");
    
});

// Route::get('/', function () {
//     return view('frontend.index');
// });

Route::get('/', [IndexController::class, 'Index']);
Route::get('/vendor/details/{id}', [IndexController::class, 'VendorDetails'])->name('vendor.details');

Route::get('/vendor/all', [IndexController::class, 'AllVendors'])->name('vendor.all');

Route::get('category/products/{id}/{slug}', [IndexController::class, 'CategoryProducts'])->name("category.products");

Route::get('subcategory/products/{id}/{slug}', [IndexController::class, 'SubCategoryProducts'])->name("subcategory.products");
// ///////////// quick view with ajax /////////
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);
//// Add To Cart
Route::post('/cart/data/store/{id}', [CartController::class, 'addToCart']);
Route::get('/product/mini/cart', [CartController::class, 'miniCart']);

Route::get('/minicart/product/remove/{rowId}', [CartController::class, 'miniCartRemove']);


Route::post('/dcart/data/store/{id}', [CartController::class, 'addToCartDetails']);



Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishList']);

Route::post('/add-to-compare/{product_id}', [CompareController::class, 'AddToCompare']);


Route::post('/coupon-apply', [CartController::class, 'ApplyCoupon']);

Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);

Route::get('/coupon-remove', [CartController::class, 'couponRemove']);

Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');





///coupon-remove
///







//////wishlist




// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';








Route::middleware(['auth','role:vendor'])->group(function(){

   ///////////// Vendor Controller /////////////
    Route::controller(VendorController::class)->group(function(){
        Route::get("/vendor/dashboard","dashboard")->name("vendor.dashboard");
        Route::get("/vendor/dashboard","dashboard")->name("vendor.dashboard");
        Route::get("/vendor/logout","logout")->name("vendor.logout");
        Route::get("/vendor/profile","VendorProfile")->name("vendor.profile");
    
        Route::put("/vendor/profile/update","VendorProfileUpdate")->name("vendor.profile.update");
    
        Route::get("/vendor/change/password","VendorChangePassword")->name("vendor.change.password");
    
        Route::put("/vendor/update/password","VendorUpdatePassword")->name("vendor.update.password");

    });


    Route::controller(VendorProductController::class)->group(function(){

        Route::get("/vendor/product/all","AllProduct")->name("vendor.product.all");
        Route::get("/vendor/product/add","AddProduct")->name("vendor.product.add");
        Route::get("/vendor/subcategory/ajax/{category_id}","VendorGetSubCategory");
        Route::post("/vendor/product/store","StoreProduct")->name("vendor.store.product");
        Route::get("/vendor/product/edit/{id}","VendorEditProduct")->name('vendor.product.edit');
        Route::put("/vendor/update/product/{id}","UpdateProduct")->name("vendor.update.product");

        Route::put("/vendor/update/product/thambnail/{id}","UpdateProductThambnail")->name("vendor.update.product.thambnail");

        
        Route::put("/vendor/update/product/multiImg/{id}","UpdateProductMultiImg")->name("vendor.update.product.multiImg");

        Route::get("/vendor/product/multiImg/delete/{id}","DeleteImage")->name("vendor.product.multiimg.delete");

        Route::get("/vendor/product/delete/{id}","DeleteProduct")->name("vendor.product.delete");

        Route::get("/vendor/product/active/{id}","ActiveProduct")->name("vendor.product.active");

        Route::get("/vendor/product/inactive/{id}","InActiveProduct")->name("vendor.product.inactive");

        


        //vendor.order

     

        



    });


     /////////// All Vendor Orders /////////////////////// 

    Route::controller(VendorOrderController::class)->group(function(){

        Route::get("/vendor/order","VendorOrder")->name("vendor.order");
        Route::get("/vendor/return/order","VendorReturnOrder")->name("vendor.return.order");

        Route::get("/vendor/complete/return/order","VendorCompleteReturnOrder")->name("vendor.complete.return.order");

        Route::get("/vendor/order/details/{order_id}","VendorOrderDetails")->name("vendor.order.details");


        //{{route('vendor.order.details')}}


    });


       //////////////////// All Reviews Routes /////////////////
     
       Route::controller(ReviewController::class)->group(function(){

        Route::get("/vendor/all/review","AllReview")->name("vendor.all.review");


       });

    
});///////////////////// End Vendor Middlware /////////////////


Route::get("/admin/login",[AdminController::class,"AdminLogin"])->middleware(RedirectIfAuthenticated::class);
Route::get("/vendor/login",[VendorController::class,"VendorLogin"])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
Route::get("/become/vendor",[VendorController::class,"BecomeVendor"])->name('become.vendor');

Route::post("/vendor/register",[VendorController::class,"VendorRegister"])->name('vendor.register');

















Route::middleware(['auth','role:admin'])->group(function(){

    ////////////////// Admin Control ///////

    Route::controller(AdminController::class)->group(function(){

       ////////////////// Admin Control ///////

       
        Route::get("/admin/dashboard","dashboard")->name("admin.dashboard");

        Route::get("/admin/logout","logout")->name("admin.logout");
        Route::get("/admin/profile","AdminProfile")->name("admin.profile");
        Route::put("/admin/profile/update","AdminProfileUpdate")->name("admin.profile.update");
    
        Route::get("/admin/change/password","AdminChangePassword")->name("admin.change.password");
    
        Route::put("/admin/update/password","AdminUpdatePassword")->name("admin.update.password");




        ////////////////// manage vendor /////////////

        Route::get("inactive/vendor","InactiveVendor")->name("inactive.vendor");
        Route::get("inactive/vendor/details/{id}","InactiveVendorDetails")->name("inactive.vendor.details");
        Route::put("inactive/vendor/approve/{id}","InactiveVendorApprove")->name("inactive.vendor.approve");

        

        Route::get("active/vendor","ActiveVendor")->name("active.vendor");
        Route::get("active/vendor/details/{id}","ActiveVendorDetails")->name("active.vendor.details");

        Route::put("active/vendor/disapprove/{id}","ActiveVendorDisApprove")->name("active.vendor.disapprove");



    });



    ////////////// Brands /////////////////////////

    Route::controller(BrandController::class)->group(function(){
        Route::get("/brand/all","AllBrands")->name("all.brand");
        Route::get("/brand/add","AddBrand")->name("add.brand");
        Route::post("/brand/add/store","AddBrandStore")->name("add.brand.store");

        Route::get("/brand/edit/{id}","EditBrand")->name("brand.edit");
        Route::put("/brand/update/{id}","BrandUpdate")->name('brand.update');

        Route::get("/brand/delete/{id}","DeleteBrand")->name("brand.delete");




       


        
     });



    /////////////////  Category ///////////////////

    Route::controller(CategoryController::class)->group(function(){
        Route::get("/category/all","AllCategories")->name("category.all");
        Route::get("/category/add","AddCategory")->name("category.add");
        Route::post("/category/add/store","AddCategoryStore")->name("category.add.store");

        Route::get("/category/edit/{id}","EditCategory")->name("category.edit");
        Route::put("/category/update/{id}","CategoryUpdate")->name('category.update');

        Route::get("/category/delete/{id}","DeleteCategory")->name("category.delete");




     


        
    });





    ///////////////// Sub Category ///////////////////


    Route::controller(SubCategoryController::class)->group(function(){
        Route::get("/subcategory/all","AllSubCategories")->name("subcategory.all");
        Route::get("/subcategory/add","AddSubCategory")->name("subcategory.add");
        Route::post("/subcategory/add/store","AddSubCategoryStore")->name("subcategory.add.store");

        Route::get("/subcategory/edit/{id}","EditSubCategory")->name("subcategory.edit");
        Route::put("/subcategory/update/{id}","SubCategoryUpdate")->name('subcategory.update');

        Route::get("/subcategory/delete/{id}","DeleteSubCategory")->name("subcategory.delete");

        Route::get("/subcategory/ajax/{category_id}","GetSubCategory");

        
    });



    ///////////////////// manage product /////////
        Route::controller(ProductController::class)->group(function(){

        Route::get("/product/all","AllProducts")->name("product.all");
        Route::get("/product/add","AddProduct")->name("product.add");
        Route::post("/product/store","StoreProduct")->name("store.product");
        Route::get("/product/edit/{id}","EditProduct")->name("product.edit");
        Route::put("/product/update/{id}","UpdateProduct")->name("update.product");
        Route::put("/product/update/thambnail/{id}","UpdateProductThambnail")->name("update.product.thambnail");

        Route::get("/product/active/{id}","ActiveProduct")->name("product.active");
        Route::get("/product/inactive/{id}","InActiveProduct")->name("product.inactive");

        Route::get("/product/delete/{id}","DeleteProduct")->name("product.delete");


        Route::put("/product/update/multiimg/{id}","UpdateProductMultiImg")->name("update.product.multiImg");

        Route::get("/product/multiimg/delete/{id}","DeleteImage")->name("product.multiimg.delete");


           ///////// stock ////////////

           Route::get('/product/stock' , 'ProductStock')->name('product.stock');
        


        





                //update.product.multiImg



        //{{route('product.inactive')}}





        //update.product.thambnail




        



        });



     /////////////////  Slider ///////////////////

      Route::controller(SliderController::class)->group(function(){
        Route::get("/slider/all","AllSliders")->name("slider.all");
        Route::get("/slider/add","AddSlider")->name("slider.add");
        Route::post("/slider/add/store","AddSliderStore")->name("slider.add.store");

        Route::get("/slider/edit/{id}","EditSlider")->name("slider.edit");
        Route::put("/slider/update/{id}","SliderUpdate")->name('slider.update');

        Route::get("/slider/delete/{id}","DeleteSlider")->name("slider.delete");




     


        
      });


         /////////////////  Banner ///////////////////

         Route::controller(BannerController::class)->group(function(){
            Route::get("/banner/all","AllBanners")->name("banner.all");
            Route::get("/banner/add","AddBanner")->name("banner.add");
            Route::post("/banner/add/store","AddBannerStore")->name("banner.add.store");
    
            Route::get("/banner/edit/{id}","EditBanner")->name("banner.edit");
            Route::put("/banner/update/{id}","BannerUpdate")->name('banner.update');
    
            Route::get("/banner/delete/{id}","DeleteBanner")->name("banner.delete");
    
    
    
    
         
    
    
            
         });


         ///////////////// Coupon //////////////

         Route::controller(CouponController::class)->group(function(){
            Route::get("/coupon/all","AllCoupon")->name("coupon.all");
            Route::get("/coupon/add","AddCoupon")->name("coupon.add");
            Route::post("/coupon/add/store","AddCouponStore")->name("coupon.add.store");
    
            Route::get("/coupon/edit/{id}","EditCoupon")->name("coupon.edit");
            Route::put("/coupon/update/{id}","CouponUpdate")->name('coupon.update');
    
            Route::get("/coupon/delete/{id}","DeleteCoupon")->name("coupon.delete");
    
    
            
         });



         //////////// Shipping Area //////////////




         
         Route::controller(ShippingAreaController::class)->group(function(){
            /////// Division //////////

            Route::get("/division/all","AllDivision")->name("all.division");
            Route::get("/division/add","AddDivision")->name("division.add");

            Route::post("/division/add/store","AddDivisionStore")->name("division.add.store");

            Route::get("/division/edit/{id}","EditDivision")->name("division.edit");

            Route::put("/division/update/{id}","DivisionUpdate")->name('division.update');

            Route::get("/division/delete/{id}","DeleteDivision")->name("division.delete");



            ///////// District ////////////

            Route::get("/district/all","AllDistrict")->name("all.district");

            Route::get("/district/add","AddDistrict")->name("district.add");

            Route::post("/district/add/store","AdddDistrictStore")->name("district.add.store");

            Route::get("/district/edit/{id}","EditDistrict")->name("district.edit");

            Route::put("/district/update/{id}","DistrictUpdate")->name('district.update');

            Route::get("/district/delete/{id}","DeleteDistrict")->name("district.delete");


              
             /////////// All State Routes ///////////

            Route::get("/state/all","AllState")->name("all.state");

            Route::get("/state/add","AddState")->name("state.add");

            Route::post("/state/add/store","AdddStateStore")->name("state.add.store");

            Route::get("/state/edit/{id}","EditState")->name("state.edit");

            Route::put("/state/update/{id}","StateUpdate")->name('state.update');

            Route::get("/state/delete/{id}","DeleteState")->name("state.delete");


            Route::get("/district/ajax/{id}","LoadDistrict");






            // /district/ajax


         });



         ///////////// All Order Routes /////////

         Route::controller(OrderController::class)->group(function(){

            Route::get("admin/pending/order","PendingOrder")->name("admin.pending.order");
            Route::get("admin/order/details/{order_id}","OrderDetails")->name("admin.order.details");

            Route::get("admin/confirmed/order","ConfirmedOrder")->name("admin.confirmed.order");

            
            Route::get("admin/processing/order","ProcessingOrder")->name("admin.processing.order");

            
            Route::get("admin/delivered/order","DeliveredOrder")->name("admin.delivered.order");

            Route::get("admin/pending/to/confirm/{order_id}","PendingToConfirm")->name("pending-to-confirm");

            Route::get("admin/confirm/to/processing/{order_id}","ConfirmToProcessing")->name("confirm-to-processing");


            //admin.invoice.download


            Route::get("admin/processing/to/delivered/{order_id}","ProcessingToDelivered")->name("processing-to-delivered");



            
            Route::get("admin/invoice/download/{order_id}","AdminInvoiceDownload")->name("admin.invoice.download");



            //admin.confirm.order



         });


          ////////////////// Return Order routes ///////////

    Route::controller(ReturnOrderController::class)->group(function(){

        Route::get('/admin/return/request' , 'ReturnRequest')->name('return.request');

        Route::get('/admin/return/request/complete' , 'ReturnRequestComplete')->name('return.request.complete');

        Route::get('/admin/return/request/approved/{order_id}' , 'ReturnRequestApproved')->name('return.request.approved');


        //return.request.complete

    });




    /////////////// ALL Reports Routes ////////

    Route::controller(ReportController::class)->group(function(){

        Route::get('/admin/all/reports' , 'AllReports')->name('all.reports');

        Route::get('/admin/order/by/user' , 'OrderByUser')->name('order.by.user');


        Route::post('/admin/search/by/date' , 'SearchByDate')->name('search-by-date');

        Route::post('/admin/search/by/month' , 'SearchByMonth')->name('search-by-month');

        Route::post('/admin/search/by/year' , 'SearchByYear')->name('search-by-year');

        Route::post('/admin/search/by/user' , 'SearchByUser')->name('search-by-user');



    });



    ///////////////// Manage active users/ vendors  /////////////

    Route::controller(ActiveUserController::class)->group(function(){

        Route::get('/admin/all/users' , 'AllUsers')->name('all.users');

        Route::get('/admin/all/vendors' , 'AllVendors')->name('all.vendors');



    });


    //////////////////// All Blog Routes ////////////


    Route::controller(BlogController::class)->group(function(){

        ////////// Blog Categories Routes //////////////

        Route::get('/admin/blog/category' , 'AdminBlogCategory')->name('admin.blog.category');


        Route::get('/add/blog/category' , 'AddBlogCategory')->name('add.blog.categroy');

        Route::post('/store/blog/category' , 'StoreBlogCategory')->name('store.blog.category');

        Route::get('/edit/blog/category/{id}' , 'EditBlogCategory')->name('edit.blog.category');

        Route::put('/update/blog/category/{id}' , 'UpdateBlogCategory')->name('update.blog.category');

        Route::get('/delete/blog/category/{id}' , 'DeleteBlogCategory')->name('delete.blog.category');



        ////////////// Blog Post routes ////////////

        Route::get('/admin/blog/post' , 'AdminBlogPost')->name('admin.blog.post');


        Route::get('/add/blog/post' , 'AddBlogPost')->name('add.blog.post');

        Route::post('/store/blog/post' , 'StoreBlogPost')->name('store.blog.post');

        Route::get('/edit/blog/post/{id}' , 'EditBlogPost')->name('edit.blog.post');

        Route::put('/update/blog/post/{id}' , 'UpdateBlogPost')->name('update.blog.post');

        Route::get('/delete/blog/post/{id}' , 'DeleteBlogPost')->name('delete.blog.post');


        //admin.blog.post


    });




    

      //////////////////// All Reviews Routes /////////////////
     
    Route::controller(ReviewController::class)->group(function(){


        Route::get('/admin/pending/review' , 'PendingReview')->name('pending.review');

        Route::get('/admin/publish/review' , 'PublishReview')->name('publish.review');

        Route::get('/admin/approve/review/{id}' , 'ApproveReview')->name('review.approve');


        Route::get('/admin/delete/review/{id}' , 'DeleteReview')->name('review.delete');

        //review.delete



    });


    //////////////////// All Site Setting Routes /////////////

    Route::controller(SiteSettingController::class)->group(function(){

        
        Route::get('/admin/site/setting' , 'SiteSetting')->name('site.setting');


        Route::post('/admin/site/setting/update/{id}' , 'SiteSettingUpdate')->name('site.setting.update');

        Route::get('/admin/seo/setting' , 'SeoSetting')->name('seo.setting');

        Route::post('/admin/seo/setting/update/{id}' , 'SeoSettingUpdate')->name('seo.setting.update');


        ///site.setting.update

        //seo.setting.update

    });



    
    //////////////////// All Permissions  Routes /////////////

    Route::controller(RoleController::class)->group(function(){



        ///////////// All Permissions Routes /////////////

        
        Route::get('/admin/all/permission' , 'AllPermission')->name('all.permission');

        Route::get('/admin/edit/permission/{id}' , 'EditPermission')->name('edit.permission');

        Route::get('/admin/delete/permission/{id}' , 'DeletePermission')->name('delete.permission');

        Route::get('/admin/add/permission' , 'AddPermission')->name('add.permission');

        Route::post('/admin/store/permission' , 'StorePermission')->name('store.permission');


        Route::get('/admin/edit/permission/{id}' , 'EditPermission')->name('edit.permission');

        Route::put('/admin/update/permission/{id}' , 'UpdatePermission')->name('update.permission');

        Route::post('/admin/delete/permission/{id}' , 'DeletePermission')->name('delete.permission');

        //edit.permission


        
        ///////////// All Roles Routes /////////////

        
        Route::get('/admin/all/role' , 'AllRole')->name('all.role');

        Route::get('/admin/edit/role/{id}' , 'EditRole')->name('edit.role');

        Route::get('/admin/delete/role/{id}' , 'DeleteRole')->name('delete.role');

        Route::get('/admin/add/role' , 'AddRole')->name('add.role');

        Route::post('/admin/store/role' , 'StoreRole')->name('store.role');


        Route::get('/admin/edit/role/{id}' , 'EditRole')->name('edit.role');

        Route::put('/admin/update/role/{id}' , 'UpdateRole')->name('update.role');

        Route::post('/admin/delete/role/{id}' , 'DeleteRole')->name('delete.roles');



        
        ///////////// All Roles In Permission Routes /////////////

        

       

        Route::get('/admin/add/role/permission' , 'AddRolePermission')->name('add.role.permission');

        Route::post('/admin/role/permission/store' , 'RolePermissionStore')->name('role.permission.store');


        Route::get('/all/roles/permission' , 'AllRolesPermission')->name('all.roles.permission');


        Route::get('/admin/edit/roles/{id}' , 'AdminEditRoles')->name('admin.edit.roles');

        //admin.edit.roles

        Route::put('/admin/roles/update/{id}' , 'AdminRolesUpdate')->name('admin.roles.update');

        Route::get('/admin/delete/roles/{id}' , 'AdminDeleteRoles')->name('admin.delete.roles');


    });




     //////////////////// All Admin User  Routes /////////////

     Route::controller(AdminController::class)->group(function(){


        Route::get('/all/admin' , 'AllAdmin')->name('all.admin',);

        Route::get('/add/admin' , 'AddAdmin')->name('add.admin',);

        Route::post('/admin/user/store' , 'AdminUserStore')->name('admin.user.store',);



        Route::get('edit/admin/role/{id}' , 'EditAdminRole')->name('edit.admin.role',);


        Route::put('admin/user/update/{id}' , 'AdminUserUpdate')->name('admin.user.update',);


        Route::get('delete/admin/role/{id}' , 'DeleteAdminRole')->name('delete.admin.role',);


      


     });


  




    
}); /////////// End Admin Middlware ///////////



//////////////// Front End //////////////

Route::get("/product/details/{id}/{slug}",[IndexController::class,"ProductDetails"]);


  /////////// Cart //////////
      
  Route::controller(CartController::class)->group(function(){

    route::get("/mycart","MyCart")->name('mycart');

    route::get("get-cart-product/","GetCartProducts");
    route::get("/cart-remove/{id}","RemoveCartProduct");
    route::get("/cart-increment/{id}","CartIncrement");
    route::get("/cart-decrement/{id}","CartDecrement");





    /////cart-increment


});



    ////////// FrontEnd Blog  Routes //////////////


Route::controller(BlogController::class)->group(function(){


    Route::get('/all/blog' , 'AllBlog')->name('home.blog');

    Route::get('/post/details/{id}/{slug}' , 'PostDetails');

    Route::get('/post/category/{id}/{slug}' , 'CategoryPosts');




 

});




    ////////// All Shop  Routes //////////////


    Route::controller(ShopController::class)->group(function(){


        Route::get('/shop' , 'ShopPage')->name('shop.page');
        Route::post('/shop/filter' , 'ShopFilter')->name('shop.filter');



        //shop.filter
    
     
    
    
    
    
     
    
    });
    



    ////////// Search Product  Routes //////////////


    Route::controller(IndexController::class)->group(function(){

      Route::post('/product/search' , 'ProductSearch')->name('product.search');
 
      Route::post('/search-product' , 'SearchProduct');


      //search-product

    });




// ///////// All User Routes ///////

Route::middleware(['auth','role:user'])->group(function(){


    //////////WishList All Routes //////////

    Route::controller(WishlistController::class)->group(function(){

        route::get("/wishlist","AllWishlist")->name('wishlist');
        route::get("get-wishlist-product/","GetWishListProduct");
        route::get("wishlist-remove/{id}","RemoveWishListProduct");
        /////add-to-compare/

    });


    /////////// Add To Compare //////////

    Route::controller(CompareController::class)->group(function(){

        route::get("/compare","AllCompare")->name('compare');
        route::get("get-compare-product/","GetCompareProduct");
        route::get("/compare-remove/{id}","RemoveCompareProduct");
        /////add-to-compare/
        ///get-compare-product/

    });

            ///////////// Checkout all routes /////////// 
    Route::controller(CheckoutController::class)->group(function(){
        Route::get("/district/ajax/{id}","LoadDistrict");
        Route::get("/state/ajax/{id}","LoadState");
      Route::post('/checkout/store' , 'CheckoutStore')->name('checkout.store');






        ///state/ajax


    });




    ////////////////// Stripe All Routes /////////


    Route::controller(StripeController::class)->group(function(){

      Route::post('/stripe/order' , 'StripeOrder')->name('stripe.order');
      Route::post('/cash/order' , 'CashOrder')->name('cash.order');


    


    });




    //////////////// All User Dashboard ////////

    
    Route::controller(AllUserController::class)->group(function(){

        Route::get('/user/account/page' , 'UserAccount')->name('user.account.page');

        Route::get('/user/change/password' , 'UserChangePassword')->name('user.change.password');

        Route::get('/user/order/page' , 'UserOrderPage')->name('user.order.page');

         Route::get('/user/order_details/{order_id}' , 'UserOrderDetails');

         Route::get('/user/invoice_download/{order_id}' , 'UserOrderInvoice');  

        Route::post('/return/order/{order_id}' , 'ReturnOrder')->name('return.order');

        Route::get('/return/order/page' , 'ReturnOrderPage')->name('return.order.page');

        // Order Tracking 
        Route::get('/user/track/order' , 'UserTrackOrder')->name('user.track.order');
         Route::post('/order/tracking' , 'OrderTracking')->name('order.tracking');

    });





     //////////////// All User Review  ////////

    
     Route::controller(ReviewController::class)->group(function(){


        Route::post('/user/store/review/{product_id}' , 'StoreReview')->name('store.review');



     });





   







  

}); ///////End User Middleware ////////













