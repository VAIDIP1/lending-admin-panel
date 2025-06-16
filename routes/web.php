<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SystemsettingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Container\Attributes\Auth;

Route::get('/', function () {
    return view('layouts.main');
});

$admin_url = 'admin/';

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register/post', [AuthController::class, 'store'])->name('register.post');
Route::post('login/post', [AuthController::class, 'authenticate'])->name('login.post');

Route::get('/validate-email', [AuthController::class, 'validateEmail'])->name('validate-email');

// Admin Routes
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::post('/post-admin-login', [AuthController::class, 'postAdminLogin'])->name('admin.login.post');
Route::get('/admin/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


//CRUD modules
$crud_module_names = array(

    //Masters

    //Users & Role Management
    'permissions' => PermissionController::class,
    'roles' => RoleController::class,
    'users' => UserController::class,
    
    //Settings
    'systemsettings' => SystemsettingController::class,

);

if (!empty($crud_module_names)) {
    foreach ($crud_module_names as $crud_module_key => $crud_module_value) {

        Route::group(['middleware' => ['auth', 'prevent-back-history']], function () use ($crud_module_key, $crud_module_value, $admin_url) {
            Route::resource($admin_url . $crud_module_key, $crud_module_value);
        });
    }
}

//Import
$import_module_names = array(
    // 'schools.import' => \App\Http\Controllers\SchoolController::class,
);

if (!empty($import_module_names)) {
    foreach ($import_module_names as $import_module_key => $import_module_value) {

        Route::get($import_module_key, [$import_module_value, 'importExportView']);
        Route::post($import_module_key, [$import_module_value, 'import'])->name('import');
    }
}

//Datatable data
$module_names = array(

    //Masters
    'allpages' => \App\Http\Controllers\PageController::class,
    'allbanners' => BannerController::class,
    'alladvertisements' => AdvertisementController::class,
    'allkeyskills' => \App\Http\Controllers\KeySkillController::class,
    'allinterests' => \App\Http\Controllers\InterestController::class,
    'allSubscriptionPlans' => \App\Http\Controllers\SubscriptionPlanController::class,
    'allSubscriptionPlansAddons' => \App\Http\Controllers\SubscriptionPlanAddonController::class,
    'allvolunteertypes' => \App\Http\Controllers\VolunteerTypeController::class,

    //Events
    'allAdminEvents' => \App\Http\Controllers\EventsController::class,
    'allEventCategories' => EventCategoryController::class,
    'allEventSuperCategories' => EventSuperCategoryController::class,
    'allEventCategoryBanners' => EventCategoryBannerController::class,
    'allEventSubCategories' => EventSubCategoryController::class,
    'allEventOccurances' => \App\Http\Controllers\EventOccuranceController::class,
    'allEventTemplates' => \App\Http\Controllers\EventTemplateController::class,
    'allFormBuilders' => \App\Http\Controllers\FormBuilderController::class,
    'allEventVolunteers' => \App\Http\Controllers\SurveyFormBuilderController::class,
    'allAdminSurveyFormBuilders' => \App\Http\Controllers\Admin\SurveyFormBuilderController::class,
    'allSurveyFormBuilders' => \App\Http\Controllers\SurveyFormBuilderController::class,
    'allEventTasks' => \App\Http\Controllers\EventTaskController::class,
    'allEventTaskGroups' => \App\Http\Controllers\EventTaskGroupController::class,
    'allEventSessions' => \App\Http\Controllers\EventSessionController::class,
    'allEventDonatitons' => \App\Http\Controllers\DonationController::class,

    //Locations
    'allcountries' => \App\Http\Controllers\CountryController::class,
    'allstates' => \App\Http\Controllers\StateController::class,
    'allcities' => \App\Http\Controllers\CityController::class,

    //Users & Role Management
    'allpermissions' => \App\Http\Controllers\PermissionController::class,
    'allroles' => \App\Http\Controllers\RoleController::class,
    'allusers' => UserController::class,

    //Settings
    'allsystemsettings' => \App\Http\Controllers\SystemsettingController::class,

    //Notifications
    'allEmailGateways' => \App\Http\Controllers\EmailGatewayController::class,
    'allEmailTemplates' => \App\Http\Controllers\EmailTemplateController::class,

    //Events Reports
    'allEventsReports' => \App\Http\Controllers\EventReportController::class,
    'allEventTasksReports' => \App\Http\Controllers\EventTaskReportController::class,
    'allEventTeamsReports' => \App\Http\Controllers\EventTeamReportController::class,
    'allEventTicketsReports' => \App\Http\Controllers\EventTicketReportController::class,
    'allEventDonationsReports' => \App\Http\Controllers\EventDonationReportController::class,

    //Reports
    'allUsersReports' => \App\Http\Controllers\UserReportController::class,
    'allOrganizersReports' => \App\Http\Controllers\OrganizerReportController::class,
    'allVolunteersReports' => \App\Http\Controllers\VolunteerReportController::class,
    'allSponsorsReports' => \App\Http\Controllers\SponsorReportController::class,

    'allEventPdfRegenration' => \App\Http\Controllers\ReportController::class,

    //All Ajax Dropdown
    'citydropdown' => \App\Http\Controllers\CommonController::class,
    'taskdropdown' => \App\Http\Controllers\CommonController::class,
    'categorydropdown' => \App\Http\Controllers\CommonController::class,
    'eventtemplatecategorydropdown' => \App\Http\Controllers\CommonController::class,
    'eventoccurancedropdown' => \App\Http\Controllers\CommonController::class,
    'volunteerdropdown' => \App\Http\Controllers\CommonController::class,
    'taskgroupsdropdown' => \App\Http\Controllers\CommonController::class,
    'sessionSlotsDropdown' => \App\Http\Controllers\CommonController::class,
    //All Ajax Dropdown
    'allsmsgateways' => SmsGatewayController::class,
    'allsmstemplates' => SmsTemplateController::class,

    //Marketing Advertisements
    'allMarketingAdvertisements' => MarketingAdvertisementUserController::class,
);
if (!empty($module_names)) {
    foreach ($module_names as $module_key => $module_value) {
        Route::get($module_key, [$module_value, $module_key]);
    }
}

//Delete data
$delete_module_names = array(


    //Masters
    'pages' => \App\Http\Controllers\PageController::class,

    //Locations
    'countries' => \App\Http\Controllers\CountryController::class,
    'states' => \App\Http\Controllers\StateController::class,
    'cities' => \App\Http\Controllers\CityController::class,

    //Users & Role Management
    'permissions' => \App\Http\Controllers\PermissionController::class,
    'users' => UserController::class,

    //Settings
    'systemsettings' => \App\Http\Controllers\SystemsettingController::class,

);

if (!empty($delete_module_names)) {
    foreach ($delete_module_names as $delete_module_key => $delete_module_value) {
        Route::get('admin/' . $delete_module_key . '/delete/{id}', [$delete_module_value, 'destroy'])->name($delete_module_key . '.destroy');
    }
}
