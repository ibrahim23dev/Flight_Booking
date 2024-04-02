<?php

use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Roles_Permissions\RolesandPermissionsController;
use PhpParser\Node\Expr\Assign;
use App\Http\Controllers\Roles_Permissions\PermissionManage;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\TouresController;
use App\Http\Controllers\frontend\SearchController;
use App\Http\Controllers\frontend\FlightBookingController;
use App\Http\Controllers\frontend\PaymentsController;
use App\Http\Controllers\Booking\BookingManageController;
use App\Http\Controllers\Booking\FlightController;
use App\Http\Controllers\settings\SettingController;
use App\Http\Controllers\settings\BlogController;
use App\Http\Controllers\settings\CurrencyExhangeController;
use App\Http\Controllers\settings\GeneralController;
use App\Http\Controllers\settings\CustomeFeesController;
use App\Http\Controllers\payments\PaymentMethodController;
use App\Http\Controllers\payments\TransactionsController;
use App\Http\Controllers\support\SupportController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\payments\BankController;
use App\Http\Controllers\payments\DepositsController;
use App\Http\Controllers\payments\WithdrawController;
use App\Http\Controllers\adds\AdvertisementsController;
use App\Http\Controllers\adds\GoogleAdController;
use App\Http\Controllers\packages\PackagesController;
use App\Http\Controllers\packages\PackageCategoryController;
use App\Http\Controllers\packages\FlightPackagesController;
use App\Http\Controllers\packages\HotelsPackagesController;
use App\Http\Controllers\packages\CarsPackagesController;
use App\Http\Controllers\settings\CommissionsController;
use App\Http\Controllers\properties\PropertyController;
use App\Http\Controllers\properties\RoomsController;
use App\Http\Controllers\membershipsAndplans\MembershipController;
use App\Http\Controllers\membershipsAndplans\PlansController;
use App\Http\Controllers\support\ChatController;
use App\Http\Controllers\general\ReviewController;
use App\Http\Controllers\settings\PromoCodesController;
use App\Http\Controllers\settings\EmailSettingsController;
use App\Http\Controllers\settings\PagesController;
use App\Http\Controllers\settings\ModulesController;
use App\Http\Controllers\settings\ModulesApiController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/linkstorage', function () {
//     Artisan::call('storage:link');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/flight-to-{areaName}', [HomeController::class, 'dealIndex'])->name('home-deal');// for deals page
Route::get('/contact', [HomeController::class, 'contact'])->name('/contact');
Route::post('/contact', [HomeController::class, 'contactSave'])->name('/contactSave');
Route::get('/about', [HomeController::class, 'about'])->name('/about');
Route::get('/faq', [HomeController::class, 'faq'])->name('/faq');
Route::get('/terms', [HomeController::class, 'terms'])->name('/terms');
Route::post('/get-page-content', [HomeController::class, 'getPageContent'])->name('getPageContent');

Route::prefix('/blog')->group(function () { 
Route::get('/list/{category?}', [HomeController::class, 'blogList'])->name('/blog-list');   
Route::get('/{blog}', [HomeController::class, 'blogSingle'])->name('/blog-single');   

});

Route::get('/toures', [TouresController::class, 'toures'])->name('tours.list');   

Route::get('/tour/{id}', [TouresController::class, 'singleTour'])->name('tours.single');
Route::match(['get', 'post'], '/tour/book/{id}', [TouresController::class, 'bookTour'])->name('tours.book');
 
 
Route::prefix('/flight')->group(function () { 
    Route::get('/list/{data?}', [SearchController::class, 'search'])->name('flight-list');
    Route::match(['get', 'post'], '/book', [FlightBookingController::class, 'book'])->name('/flight-book');
    Route::get('/checkout/{data?}', [FlightBookingController::class, 'checkout'])->name('checkout');

    Route::post('/book-form', [FlightBookingController::class, 'bookingForm'])->name('/flight-form');
    Route::get('/final/{data}', [FlightBookingController::class, 'final'])->name('/flight-final');      
});

Route::prefix('/payment')->group(function () { 

    Route::match(['get', 'post'],'/initialize/{id}', [PaymentsController::class, 'paymentInitialize'])->name('/payment-initialize');

    Route::match(['get', 'post'],'/proceed/{id}', [PaymentsController::class, 'paymentProceed'])->name('/payment-proceed');

    // paypal success and cancel routes

    Route::get('paypal/checkout/{id}', [PaymentsController::class, 'paypalCheckout'])->name('paypal.checkout');
    Route::get('paypal/success', [PaymentsController::class, 'success'])->name('paypal.success');
    Route::get('paypal/cancel', [PaymentsController::class, 'cancel'])->name('paypal.cancel');
  
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/change-password', [ProfileController::class, 'change'])->name('password.change');

    // can view attendances 
    Route::get('/attendance',[AttendanceController::class,'index'])->name('Accounts/attendance.index');
    Route::get('/attendance/create',[AttendanceController::class,'create'])->name('Accounts/attendance.create');
    Route::post('/attendance',[AttendanceController::class,'store'])->name('Accounts/attendance.store');
    Route::post('/attendance/{id}',[AttendanceController::class,'endShift'])->name('Accounts/attendance.endShift');
});

// users routes: can perform  users crud operations
Route::middleware(['auth','permission:manage users'])->group(function () {
    
    Route::resource('users', UserController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
});
    // roles routes: can perform  roles crud operations
    Route::prefix('/RolesandPermissions')->middleware(['auth','permission:manage roles'])->group(function () {

    Route::get('/roles', [RolesandPermissionsController::class, 'rolesIndex'])->name('/roles.index');  // index page
    Route::get('/roles/create', [RolesandPermissionsController::class, 'rolesCreate'])->name('/roles.create'); //  create form
    Route::post('/roles', [RolesandPermissionsController::class, 'rolesStore'])->name('/roles.store'); // update method
    Route::get('/roles/{role}/edit', [RolesandPermissionsController::class, 'rolesEdit'])->name('/roles.edit'); // edit form
    Route::post('/roles/{role}', [RolesandPermissionsController::class, 'rolesUpdate'])->name('/roles.Update');  // edit-update form 
});  

    // Permissions routes: can perform  permissions crud operations 
    Route::prefix('/RolesandPermissions')->middleware(['auth','permission:manage permissions'])->group(function () {

    Route::get('/permissions', [RolesandPermissionsController::class, 'PermissionsIndex'])->name('/permissions.index');  // index page
    Route::get('/permissions/create', [RolesandPermissionsController::class, 'permissionsCreate'])->name('/permissions.create'); //  create form
    Route::post('/permissions', [RolesandPermissionsController::class, 'permissionsStore'])->name('/permissions.store'); // update method
     Route::get('/permissions/{permission}/edit', [RolesandPermissionsController::class, 'permissionsEdit'])->name('/permissions.edit'); // edit form
     Route::post('/permissions/{permission}', [RolesandPermissionsController::class, 'permissionUpdate'])->name('/permission.Update');  // edit-update form 

      //  Assign or revoke single permission to user or role 
    Route::post('assign-permission/{permission}', [PermissionManage::class, 'assignRevokePermission'])->name('assignRevokePermission');

    Route::post('assign-permission-role/{role}', [PermissionManage::class, 'assignRevokePermissionRole'])->name('assignRevokePermissionRole');

    Route::post('assign-permission-user/{user}', [PermissionManage::class, 'assignRevokePermissionUser'])->name('assignRevokePermissionUser');
}); 

// manage booking routes 

Route::prefix('/booking')->middleware(['auth'])->group(function () {

        Route::get('/all/{data?}', [BookingManageController::class, 'index'])->name('/booking-list');
        
        Route::get('/view-ticket/{id}', [BookingManageController::class, 'viewTicket'])->name('/view-ticket');
        Route::get('/edit-ticket/{id}', [BookingManageController::class, 'editTicket'])->name('/edit-ticket');
        Route::post('/update-ticket/{id}', [BookingManageController::class, 'updateTicket'])->name('/update-ticket');


        Route::post('/cancel/{id}', [BookingManageController::class, 'cancelbooking'])->name('/cancel-booking');

        // flight bookings 
        Route::resource('/flight', FlightController::class)->only(['index', 'create', 'store','show', 'edit', 'update', 'destroy']);

        Route::post('/cancel-booking/{id}', [FlightController::class, 'cancelBooking'])->name('cancelBooking');

        Route::post('/update-passengers/{id}', [FlightController::class, 'updatePassengers'])->name('/update-passengers');


        Route::get('/booking-inquiry/{id?}', [BookingManageController::class, 'bookingInquiry'])->name('booking-inquiry')->middleware(['permission:manage booking inquiries']);
        Route::post('/booking-inquiry-update/{id}', [BookingManageController::class, 'bookingInquiryUpdate'])->name('booking-inquiry-update')->middleware(['permission:manage booking inquiries']);

        // tour bookings 
        Route::resource('/tour-bookings', TouresController::class)->only(['index', 'create', 'store','show', 'edit', 'update', 'destroy']);
          
});

// settings routes 

Route::prefix('/settings')->middleware(['auth','permission:manage settings'])->group(function () { 

    Route::get('/sections', [SettingController::class, 'sectionsIndex'])->name('/settings/section.index');
    Route::get('/sections/edit/{section}', [SettingController::class, 'sectionsEdit'])->name('/settings/section.edit');
    Route::post('/sections/update/{section}', [SettingController::class, 'sectionUpdate'])->name('/settings/section.update');
    Route::get('/sections/add/{section}', [SettingController::class, 'sectionAdd'])->name('/settings/section.add');
    Route::post('/sections/add/{section}', [SettingController::class, 'sectionCreate'])->name('/settings/section.create');

    Route::get('/sections/removeContent/{sectionId}/{contentIndex}', [SettingController::class, 'removeContent'])
    ->name('/section.removeContent');
    // section routes ends // 

    Route::get('/site-identity', [SettingController::class, 'siteIdentityIndex'])->name('siteIdentity.index');
    Route::post('/site-identity/update/{id}', [SettingController::class, 'siteIdentityUpdate'])->name('site-identity.update');
    // site identity route ends//

    Route::resource('/testimonials', SettingController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    // testimonials route ends //

    Route::get('/pages/contact', [SettingController::class, 'contactPageIndex'])->name('/settings/contact.index');
    Route::post('/pages/contact/update/{contact}', [SettingController::class, 'contactPageUpdate'])->name('/settings/pages/contactPage.update');
    // contact route ends //
    
    Route::resource('/blogs', BlogController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    Route::resource('/currency-rates', CurrencyExhangeController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    Route::post('/blog/upload-image', [BlogController::class, 'uploadImage'])->name('blogs.uploadImage');
    
    // blogs routes //

    Route::resource('/pages', PagesController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    Route::post('/pages/upload-image', [PagesController::class, 'uploadImage'])->name('pages.uploadImage');


    // pages routes //


    Route::resource('/modules', ModulesController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']); 

    Route::post('/modules/change-status/{id}', [ModulesController::class, 'changeStatus'])->name('modulesChangeStatus');

    //module apis 
    Route::resource('/modules-apis', ModulesApiController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']); 

    Route::post('/modules-apis/change-status/{id}', [ModulesApiController::class, 'changeStatus'])->name('modulesApiChangeStatus');

    // terms privacy routes
    Route::get('/terms', [SettingController::class, 'termsIndex'])->name('/settings/terms.index');
    Route::get('/terms/edit/{id}', [SettingController::class, 'termsEdit'])->name('/settings/terms.edit');
    Route::post('/terms/update/{id}', [SettingController::class, 'termsUpdate'])->name('/settings/terms.update');

});


// general mangement routes: can perform  general operations
Route::prefix('/general')->middleware(['auth','permission:general management'])->group(function () {
    
    Route::get('/contact-queries', [GeneralController::class,'contactQueries'])->name('/general/contact-queries');
    Route::post('/contact-queries', [GeneralController::class,'updateMessageStatus'])->name('/general/updateMessageStatus');
    Route::delete('/contact-queries/delete/{id}', [GeneralController::class,'deleteMessage'])->name('/general/delete-message');

     // reviews methods 
     Route::resource('/reviews', ReviewController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
});
   

// payments  routes: can perform  payments operations 
Route::prefix('payments')->middleware(['auth','permission:manage payments'])->group(function () {
    // payment methods 
    Route::resource('/payment-methods', PaymentMethodController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    Route::post('/payment-methods/change-status/{id}', [PaymentMethodController::class, 'changeStatus'])->name('paymentMethodChangeStatus');
    //transactions
    Route::resource('/transactions', TransactionsController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    //banks
    Route::resource('/banks', BankController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

}); 

// deposits routes for user acces

    Route::middleware(['auth'])->group(function () {
    
        Route::resource('deposits', DepositsController::class)->only(['index', 'create','store', 'edit', 'update', 'destroy']);
        Route::patch('deposits-accepts/{id}',[DepositsController::class,'depositsAccept'])->name('deposits.accepts');
    });

// support tickets  routes: can perform  support tickets operations 
Route::prefix('support-ticket')->middleware(['auth'])->group(function () {
    // payment methods 
    Route::resource('/tickets', SupportController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::patch('/tickets/{id}/change-status', [SupportController::class, 'changeStatus'])->name('tickets.changeStatus');
});
Route::get('/tickets/{id}/fetch-messages', [SupportController::class, 'fetchMessages']);


// withdraw   routes: can perform  withdraw operations 
Route::prefix('withdraws')->middleware(['auth'])->group(function () {
    // withdraw methods 
    Route::resource('/withdraw', WithdrawController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::patch('/withdraw/{id}/change-status', [WithdrawController::class, 'withdrawAccept'])->name('withdraw.withdrawAccept');

}); 


// advertisements  routes: can perform  advertisements operations 
Route::prefix('advertisements')->middleware(['auth','permission:manage adds'])->group(function () {
    // custom ads 
    Route::resource('/advertisements', AdvertisementsController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    // google ads
    Route::resource('/google-ads', GoogleAdController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
}); 

// packages  routes: can perform  packages operations 
Route::prefix('packages')->middleware(['auth','permission:manage packages'])->group(function () {

    // packages  
    Route::resource('/packages', PackagesController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    Route::resource('/categories', PackageCategoryController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    // flights  
    Route::resource('/flight-packages', FlightPackagesController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    //  cars 
    Route::resource('/car-packages', CarsPackagesController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    Route::get('/car-packages/{car}/delete-image/{index}', [CarsPackagesController::class, 'deleteImage'])->name('car-packages.delete-image');
    //  hotels 
    Route::resource('/hotel-packages', HotelsPackagesController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);


    Route::get('/hotel-packages/{hotel}/delete-image/{index}', [HotelsPackagesController::class, 'deleteImage'])->name('hotel-packages.delete-image');


}); 




// properties  routes: can perform  properties operations 
Route::prefix('properties')->middleware(['auth'])->group(function () {

    // properties  
    Route::resource('/properties', PropertyController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']); 


    Route::get('/properties/{property}/delete-image/{index}', [PropertyController::class, 'deleteImage'])->name('properties.delete-image');

    Route::patch('/update-amenities/{property}',  [PropertyController::class, 'updateAmenities'])->name('update-amenities');

    // surroundings route for properties
    Route::get('/properties/{property}/surroundings', [PropertyController::class, 'editSurrounding'])->name('properties.edit-surroundings');

    Route::patch('/properties/{property}/surroundings', [PropertyController::class, 'updateSurrounding'])->name('properties.update-surroundings');


    // property rooms 
      
    Route::resource('/properties/{property}/rooms', RoomsController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    Route::get('/properties/{property}/{room}/delete-image/{index}', [RoomsController::class, 'deleteImage'])->name('rooms.delete-image');

    Route::patch('/update-amenities/{property}/{room}',  [RoomsController::class, 'updateAmenities'])->name('update-amenities-room');

}); 

// membership  routes: can perform  membership operations 
Route::prefix('MembershipAndPlans')->middleware(['auth','permission:manage plans'])->group(function () {

    // membership  
    Route::resource('/plans', PlansController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']); 
    Route::patch('/update-plans/{plan}',  [PlansController::class, 'updatePlans'])->name('update-plans');

        // membership  subscriptions
        Route::resource('/memberships', MembershipController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']); 

}); 


// second chat 

Route::middleware(['auth'])->group(function () {

Route::get('/chat', [ChatController::class, 'chat'])->name('chat');


Route::get('/conversations', [ChatController::class, 'index'])->name('conversations.index');


Route::get('/conversations/{user_id}', [ChatController::class, 'show'])->name('conversations.show');
 
Route::post('/messages', [ChatController::class, 'store'])->name('messages.store');
Route::get('/conversations/{conversation}/messages', [ChatController::class, 'fetch'])->name('messages.fetch');

Route::get('/messages/unread', [ChatController::class, 'fetchUnreadMessages'])->name('messages.unread');

// deleting conversation
Route::get('delete-conversation/{id}',[ChatController::class,'deleteConversation'])->name('delete.conversation');

});


Route::prefix('promosAndDiscounts')->middleware(['auth','permission:manage promo'])->group(function () {

    Route::resource('/promo-codes', PromoCodesController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']); 

    Route::get('/promo-codes/usages/{id?}',[PromoCodesController::class,'promoUsages'])->name('promo.usages');

    // comissions  routes: can perform  comissions operations 
 
    Route::resource('/commissions', CommissionsController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])->middleware(['auth','permission:manage commissions']);

    // custome  commissions for specific airline
    Route::resource('/custom-fees', CustomeFeesController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])->middleware(['auth','permission:manage commissions']);

});

Route::prefix('configurations')->middleware(['auth','permission:manage configurations'])->group(function () {

    Route::resource('/email-settings', EmailSettingsController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']); 

});

Route::get('/account-settings',[GeneralController::class,'accountSettings'])->name('accountSettings');

Route::get('/Flights/SearchAirports', [HomeController::class,'airportAutoComplete']);


Route::get('/test', function(){
    return view('frontend.flights.Bdfare.list');
});
require __DIR__.'/auth.php';
require __DIR__.'/cpanel.php';

