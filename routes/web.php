<?php

//admin
use App\Http\Controllers\admin\adminHomeController;
use App\Http\Controllers\admin\checkDownloadController;
use App\Http\Controllers\admin\craterJobController;
use App\Http\Controllers\admin\dasboaController;
use App\Http\Controllers\admin\DetailController;
use App\Http\Controllers\admin\detailOderController;
use App\Http\Controllers\admin\OderController;
use App\Http\Controllers\admin\productController;
use App\Http\Controllers\admin\sellerwixController;
use App\Http\Controllers\admin\totalController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\auth\cfController;
use App\Http\Controllers\auth\logincontroller;
use App\Http\Controllers\auth\regiterController;
use App\Http\Controllers\auth\resetpassController;
use App\Http\Controllers\client\AccountHistoryController;
use App\Http\Controllers\client\csvController;
use App\Http\Controllers\client\DesignerController;
use App\Http\Controllers\client\detailIdeaController;
use App\Http\Controllers\client\docController;
use App\Http\Controllers\client\finePngController;
use App\Http\Controllers\client\HomeController;
use App\Http\Controllers\client\indexController;
use App\Http\Controllers\client\RechargeHistoryController;
use App\Http\Controllers\client\toolController;
use App\Http\Controllers\excel\exportAmzController;
//clients
use App\Http\Controllers\S3\s3Controller;
use App\Http\Controllers\S3\s3DesignerController;
use Illuminate\Support\Facades\Route;

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

Route::get('/chinh', function () {
    return view('client.test');
});
Route::middleware(['CheckDesinger', 'veryMail'])->group(function () {
    Route::get('Dashboard', [DesignerController::class, 'Dashboard'])->name('Dashboard');
    Route::get('Detail/{id}', [DesignerController::class, 'Detail'])->name('Detail');
    // Route::post('acceptDetail/{id}', [DesignerController::class, 'acceptDetail'])->name('acceptDetail');
    Route::get('accept/{id}', [DesignerController::class, 'accept'])->name('accept');
    Route::get('complete', [DesignerController::class, 'complete'])->name('complete');
    Route::get('PendingDS', [DesignerController::class, 'PendingDS'])->name('PendingDS');
    Route::get('replay', [DesignerController::class, 'replay'])->name('replay');
    Route::get('NotSeen', [DesignerController::class, 'NotSeen'])->name('NotSeen');
    Route::get('prioritize', [DesignerController::class, 'prioritize'])->name('prioritize');
    Route::post('componentDesigner/{id}', [DesignerController::class, 'componentDesigner'])->name('componentDesigner');
    Route::post('addmocups/{id}', [DesignerController::class, 'addmocups'])->name('addmocups');


    Route::get('deleteds/{id}', [DesignerController::class, 'deleteds'])->name('deleteds');

});


Route::get('dasboa', [indexController::class, 'dasboa'])->name('dasboa');

Route::middleware(['CheckIdea', 'veryMail'])->group(function () {
    Route::post('addmocupidea/{id}', [s3Controller::class, 'addmocupidea'])->name('addmocupidea');

    Route::get('/', [HomeController::class, 'home'])->name('home');

    Route::get('done', [HomeController::class, 'done'])->name('done');
    Route::get('Pending', [HomeController::class, 'Pending'])->name('Pending');
    Route::get('allidea', [HomeController::class, 'allidea'])->name('allidea');
    Route::get('NotReceived', [HomeController::class, 'NotReceived'])->name('NotReceived');

    Route::get('warning/{id}', [HomeController::class, 'warning'])->name('warning');
    Route::get('EditShow/{id}', [HomeController::class, 'EditShow'])->name('EditShow');
    Route::get('approvalShow/{id}', [HomeController::class, 'approvalShow'])->name('approvalShow');
    Route::post('approval/{id}', [HomeController::class, 'approval'])->name('approval');
    Route::get('important/{id}', [HomeController::class, 'important'])->name('important');
    Route::post('showimage', [HomeController::class, 'showimage'])->name('showimage');
    Route::post('comment/{id}', [HomeController::class, 'comment'])->name('comment');
    Route::get('find', [HomeController::class, 'find'])->name('find');
    Route::get('addSku/{id}', [HomeController::class, 'addSku'])->name('addSku');

    Route::get('showdetail/{key1}/{key2}', [detailIdeaController::class, 'showdetail'])->name('showdetail');

    // find PNG

});

Route::middleware(['auth'])->group(function () {
    Route::get('showTool', [toolController::class, 'showTool'])->name('showtool');
    Route::post('postTypeProduct', [toolController::class, 'postTypeProduct'])->name('postTypeProduct');

    Route::post('cornerstone', [toolController::class, 'cornerstone'])->name('cornerstone');

    Route::post('cornerstoneProduct/{id}', [toolController::class, 'cornerstoneProduct'])->name('cornerstoneProduct');

    Route::get('/carbon', [toolController::class, 'carbon'])->name('carbon');
    Route::post('cornerstoneadd', [toolController::class, 'cornerstoneadd'])->name('cornerstoneadd');
    Route::post('cornerstonedele', [toolController::class, 'cornerstonedele'])->name('cornerstonedele');

    Route::get('addplasform', [toolController::class, 'addplasform'])->name('addplasform');
    Route::get('deleteplasform', [toolController::class, 'deleteplasform'])->name('deleteplasform'); 

    Route::get('showIdeaa', [toolController::class, 'showIdeaa'])->name('showIdeaa');
    Route::get('showPNGG', [toolController::class, 'showPNGG'])->name('showPNGG');
    Route::get('showMockup', [toolController::class, 'showMockup'])->name('showMockup');
    Route::get('Sku', [toolController::class, 'Sku'])->name('Sku');
    Route::get('findPNG', [finePngController::class, 'findPNG'])->name('findPNG');
    //import CSV

    Route::get('importCsv', [csvController::class, 'importCsv'])->name('importCsv');
    Route::post('postCsv', [csvController::class, 'postCsv'])->name('postCsv');

    Route::post('postCsvEbay', [csvController::class, 'postCsvEbay'])->name('postCsvEbay');

    Route::post('postCsvAmazon', [csvController::class, 'postCsvAmazon'])->name('postCsvAmazon');

    //download images

    Route::get('dowloadURL/{id}', [DesignerController::class, 'dowloadURL'])->name('dowloadURL');
    Route::get('dowloadMocupURL/{id}', [DesignerController::class, 'dowloadMocupURL'])->name('dowloadMocupURL');
    Route::get('dowloadMocupAll/{id}', [DesignerController::class, 'dowloadMocupAll'])->name('dowloadMocupAll');
    Route::get('dowloadPNGAll/{id}', [DesignerController::class, 'dowloadPNGAll'])->name('dowloadPNGAll');

    Route::get('success/{id}', [HomeController::class, 'success'])->name('success');
    Route::get('ajax/{id}', [HomeController::class, 'ajax'])->name('ajax');
    Route::get('checkdownloadClick/{id}', [checkDownloadController::class, 'checkdownloadClick'])->name('checkdownloadClick');

    //s3
    Route::post('addImage/{id}', [s3Controller::class, 'addImage'])->name('addImage');
    Route::post('addPngDetailsIdea/{id}', [s3Controller::class, 'addPngDetailsIdea'])->name('addPngDetailsIdea');
    Route::get('deleteImage/{id}', [s3Controller::class, 'deleteImage'])->name('deleteImage');
    Route::post('Edit/{id}', [s3Controller::class, 'Edit'])->name('Edit');
    Route::post('addIdea', [s3Controller::class, 'addIdea'])->name('addIdea');
    Route::get('delete/{id}', [s3Controller::class, 'delete'])->name('delete');

    Route::post('acceptDetail/{id}', [s3DesignerController::class, 'acceptDetail'])->name('acceptDetail');
    Route::post('addPngDetails/{id}', [s3DesignerController::class, 'addPngDetails'])->name('addPngDetails');
    Route::get('deleteMocupAll/{id}', [s3DesignerController::class, 'deleteMocupAll'])->name('deleteMocupAll');
    Route::get('deletePngAll/{id}', [s3DesignerController::class, 'deletePngAll'])->name('deletePngAll');
    Route::get('deletemocups/{id}', [s3DesignerController::class, 'deletemocups'])->name('deletemocups');
    Route::get('deleteProductPngDetails/{id}', [s3DesignerController::class, 'deleteProductPngDetails'])->name('deleteProductPngDetails');
    Route::get('deleteds/{id}', [s3DesignerController::class, 'deleteds'])->name('deleteds');

});
Route::get('detailAccountHistory/{id}', [AccountHistoryController::class, 'detailAccountHistory'])->middleware('auth')->name('detailAccountHistory');
Route::post('postcheckout/{id}', [HomeController::class, 'postcheckout'])->middleware('auth')->name('postcheckout');
Route::post('RechargeHistory', [RechargeHistoryController::class, 'RechargeHistory'])->name('RechargeHistory');
Route::get('sellerwix/{id}', [sellerwixController::class, 'index'])->name('sellerwix');
Route::get('sellerwixKetoan/{id}', [sellerwixController::class, 'sellerwixKetoan'])->name('sellerwixKetoan');
Route::get('transactions', [sellerwixController::class, 'transactions'])->name('transactions');
Route::get('getIdStore', [sellerwixController::class, 'getIdStore'])->name('getIdStore');

Route::get('/export-users/{id}/{time1}/{time2}', [sellerwixController::class, 'exportUsers'])->name('export-users');
Route::get('exportslw/{time1}', [sellerwixController::class, 'exportslw'])->name('exportslw');

Route::get('exportsamz/{id}', [exportAmzController::class, 'exportsamz'])->name('exportsamz');

//============Auth==========//

Route::prefix('auth')->group(function () {
    //login
    Route::get('login', [logincontroller::class, 'index'])->name('login');

    Route::post('login', [logincontroller::class, 'login'])->name('auth.login');

    Route::get('logout', [logincontroller::class, 'logout'])->name('logout');

    //register

    Route::get('regiter', [regiterController::class, 'index'])->name('regiter');

    Route::post('postList', [regiterController::class, 'postList'])->name('postregiter');
    //mail
    Route::get('/senmail/{remember_token}', [cfController::class, 'update'])->name('senmail');

    Route::get('alert', [cfController::class, 'alert'])->name('alert');

    Route::get('/email', [resetpassController::class, 'forgotpass'])->name('forgotpass');

    Route::post('/chekcmail', [resetpassController::class, 'checkmail'])->name('checkmail');

    Route::get('/sendMailChangepass/{email}', [resetpassController::class, 'sendMailChangepass'])->name('sendMailChangepass');

    Route::post('/changePasss/{email}', [resetpassController::class, 'changePass'])->name('changePass');

    //doccument Controller
    Route::get('showDoc', [docController::class, 'showDoc'])->name('showDoc');

    Route::get('detailDoc/{id}', [docController::class, 'detailDoc'])->name('detailDoc');

    Route::get('addlDoc', [docController::class, 'addlDoc'])->name('addlDoc');

    Route::get('deleteDoc/{id}', [docController::class, 'deleteDoc'])->name('deleteDoc');

    Route::get('editDoc/{id}', [docController::class, 'editDoc'])->name('editDoc');

    Route::post('storeAdd', [docController::class, 'storeAdd'])->name('storeAdd');

    Route::post('documentAddUser/{id}', [docController::class, 'documentAddUser'])->name('documentAddUser');

    Route::get('accset/{id}', [docController::class, 'accset'])->middleware('checkAdmin')->name('accset');

});
//middleware('checkAdmin')->
//============ ADMIN  ====================//
Route::middleware(['checkAdmin', 'veryMail'])->prefix('admin')->group(function () {
    //=======dasboa=========//
    //show dasboa
    Route::get('showdasboa', [dasboaController::class, 'showdasboa'])->name('showdasboa');
    // phana cua adminHomeController
    Route::get('AadminHome', [adminHomeController::class, 'home'])->name('AadminHome');
    Route::get('showIdea', [adminHomeController::class, 'showIdea'])->name('showIdea');
    Route::get('showPNG', [adminHomeController::class, 'showPNG'])->name('showPNG');
    // chi tiêt hóa dơn user
    Route::get('DetailMember/{id}', [dasboaController::class, 'DetailMember'])->name('DetailMember');

    // show php idea
    Route::get('totalidea', [totalController::class, 'totalidea'])->name('totalidea');
    Route::get('totalDesigner', [totalController::class, 'totalDesigner'])->name('totalDesigner');
    Route::get('totalall', [totalController::class, 'totalall'])->name('totalall');

    //show user
    Route::get('showUser', [UserController::class, 'showUser'])->name('showUser');
    // edit user
    Route::get('editList/user/{id}', [UserController::class, 'editList'])->name('editUser');
    Route::post('update/show/{id}', [UserController::class, 'updatesuser'])->name('updatesuser');
    // add user
    Route::get('addList/user', [UserController::class, 'addList'])->name('addUser');
    Route::post('postList/user', [UserController::class, 'postList'])->name('postList');
    // delete user
    Route::get('/deleteUser/{id}', [UserController::class, 'delete'])->name('deleteUser');
    // show trackuser
    Route::get('trackuser', [UserController::class, 'trackuser'])->name('trackuser');
    //show activeruser
    Route::get('activeruser', [UserController::class, 'activeruser'])->name('activeruser');
    // khoi phuc thung rac
    Route::get('/restoreUser/{id}', [UserController::class, 'restoreUser'])->name('restoreUser');
    // action tổng hợp trong uer
    Route::get('action', [UserController::class, 'action'])->name('action');

    Route::get('findUser', [UserController::class, 'findUser'])->name('findUser');

    Route::get('DetailDesigner/{id}', [DetailController::class, 'DetailDesigner'])->name('DetailDesigner');
    Route::get('DetailIdea/{id}', [DetailController::class, 'DetailIdea'])->name('DetailIdea');

    //show tinh tracing
    Route::get('totalDone', [totalController::class, 'totalDone'])->name('totalDone');
    Route::get('totalPending', [totalController::class, 'totalPending'])->name('totalPending');
    Route::get('totalNotReceived', [totalController::class, 'totalNotReceived'])->name('totalNotReceived');
    //=========khoi categoru============//

    Route::get('productaction', [productController::class, 'action'])->name('productaction');

    Route::post('jobPublic', [craterJobController::class, 'jobPublic'])->name('jobPublic');

    // create job public
    Route::post('jobPrivate', [craterJobController::class, 'jobPrivate'])->name('jobPrivate');
    // create jobPrivate
    // create job public
    Route::get('deletejob/{id}', [craterJobController::class, 'deletejob'])->name('deletejob');
    // create job public
    Route::get('updateJob/{id}', [craterJobController::class, 'updateJob'])->name('updateJob');
    //oder_Admin
    Route::get('OderAdmin', [OderController::class, 'OderAdmin'])->name('OderAdmin');

    Route::get('estydetail/{name}', [detailOderController::class, 'estydetail'])->name('estydetail');
    Route::get('ebaydetail/{name}', [detailOderController::class, 'ebaydetail'])->name('ebaydetail');

    Route::get('EditShow/ajax/{id}', [totalController::class, 'EditShowajax'])->name('EditShowajax');

    Route::get('detailUser/{id}', [UserController::class, 'detailUser'])->name('detailUser');
    Route::get('detailUserIdea/{id}', [UserController::class, 'detailUserIdea'])->name('detailUserIdea');

    Route::get('detailUserdone/{id}', [UserController::class, 'detailUserdone'])->name('detailUserdone');
    Route::get('detailUserPending/{id}', [UserController::class, 'detailUserPending'])->name('detailUserPending');
    Route::get('detailUserIdeaDone/{id}', [UserController::class, 'detailUserIdeaDone'])->name('detailUserIdeaDone');
    Route::get('detailUserIdeaPending/{id}', [UserController::class, 'detailUserIdeaPending'])->name('detailUserIdeaPending');
    Route::get('checkDownload', [checkDownloadController::class, 'checkDownload'])->name('checkDownload');

});

//=========khôi client===========//
//===========Home=================//
Route::prefix('client')->group(function () {

    //show home

    //show product_type
    Route::get('product_type/{id_type}', [HomeController::class, 'product_type'])->name('product_type');
    //show product
    Route::get('product/{id}', [HomeController::class, 'product'])->name('product');
    //show contact
    Route::get('contact', [HomeController::class, 'contact'])->name('contact');
    //show about
    Route::get('about', [HomeController::class, 'about'])->name('about');
    //show shopping
    Route::get('shopping/{id}', [HomeController::class, 'shopping'])->middleware('auth')->name('shopping');
    //show addcart
    Route::get('deletecart/{rowID}', [HomeController::class, 'deletecart'])->name('deletecart');
    //show checkout
    Route::get('checkout', [HomeController::class, 'checkout'])->name('checkout');
    //show checkout

});
Route::get('shows3', [s3Controller::class, 'shows3'])->name('shows3');

Route::post('/postUpload', [s3Controller::class, 'postUpload'])->name('postUpload');
