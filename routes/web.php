<?php

use App\Http\Controllers\Admin\AdminContactPageController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminFaqPageController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminHomePageController;
use App\Http\Controllers\Admin\AdminJobCategoryController;
use App\Http\Controllers\Admin\AdminJobCategoryPageController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminPrivacyPageController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminTermPageController;
use App\Http\Controllers\Admin\AdminWhyChooseController;
use App\Http\Controllers\Admin\AdminPackageController;
use App\Http\Controllers\Admin\AdminPricingPageController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\FaqController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\JobCategoryController;
use App\Http\Controllers\Front\PricingController;
use App\Http\Controllers\Front\PrivacyController;
use App\Http\Controllers\Front\TermsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('terms', [TermsController::class, 'index'])->name('terms');
Route::get('job-categories', [JobCategoryController::class, 'categories'])->name('job_categories');
Route::get('faq', [FaqController::class, 'index'])->name('faq');
Route::get('privacy-policy', [PrivacyController::class, 'index'])->name('privacy');
Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::post('contact-submit', [ContactController::class, 'submit'])->name('contact_submit');
Route::get('pricing', [PricingController::class, 'index'])->name('pricing');


/*Admin route*/
Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin_login');
Route::post('/admin/login-submit', [AdminLoginController::class, 'login_submit'])->name('admin_login_submit');
Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin_logout');
Route::get('/admin/forget-password', [AdminLoginController::class, 'forget_password'])->name('admin_forget_password');
Route::post('/admin/forget-password-submit', [AdminLoginController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
Route::get('/admin/reset-password/{token}/{email}', [AdminLoginController::class, 'reset_password'])->name('admin_reset_password');
Route::post('/admin/reset-password-submit', [AdminLoginController::class, 'reset_password_submit'])->name('admin_reset_password_submit');

Route::middleware(['admin:admin'])->group(function () {

    Route::get('/admin/home', [AdminHomeController::class, 'index'])
        ->name('admin_home');
    Route::get('/admin/edit-profile', [AdminProfileController::class, 'index'])
        ->name('admin_profile');
    Route::post('/admin/edit-profile-submit', [AdminProfileController::class, 'profile_submit'])
        ->name('admin_profile_submit');
    Route::get('/admin/home-page', [AdminHomePageController::class, 'index'])
        ->name('admin_home_page');
    Route::post('/admin/home-page/update', [AdminHomePageController::class, 'update'])
        ->name('admin_home_page_update');
    Route::get('/admin/faq-page', [AdminFaqPageController::class, 'index'])
        ->name('admin_faq_page');
    Route::post('/admin/faq-page/update', [AdminFaqPageController::class, 'update'])
        ->name('admin_faq_page_update');
    Route::get('/admin/term-page', [AdminTermPageController::class, 'index'])
        ->name('admin_term_page');
    Route::post('/admin/term-page/update', [AdminTermPageController::class, 'update'])
        ->name('admin_term_page_update');
    Route::get('/admin/privacy-page', [AdminPrivacyPageController::class, 'index'])
        ->name('admin_privacy_page');
    Route::post('/admin/privacy-page/update', [AdminPrivacyPageController::class, 'update'])
        ->name('admin_privacy_page_update');
    // contact route
    Route::get('/admin/contact-page', [AdminContactPageController::class, 'index'])
        ->name('admin_contact_page');
    Route::post('/admin/contact-page/update', [AdminContactPageController::class, 'update'])
        ->name('admin_contact_page_update');
    // job category page
    Route::get('/admin/job-category-page', [AdminJobCategoryPageController::class, 'index'])
        ->name('admin_job_category_page');
    Route::post('/admin/job-category-page/update', [AdminJobCategoryPageController::class, 'update'])
        ->name('admin_job_category_page_update');
    // pricing
    Route::get('/admin/pricing-page', [AdminPricingPageController::class, 'index'])
        ->name('admin_pricing_page');
    Route::post('/admin/pricing-page/update', [AdminPricingPageController::class, 'update'])
        ->name('admin_pricing_page_update');


    // Job category
    Route::get('/admin/job-category/view', [AdminJobCategoryController::class, 'index'])
        ->name('admin_job_category');
    Route::get('/admin/job-category/add', [AdminJobCategoryController::class, 'add_section'])
        ->name('admin_job_category_add');
    Route::post('/admin/job-category/store', [AdminJobCategoryController::class, 'store'])
        ->name('admin_job_category_store');
    Route::get('/admin/job-category/edit/{id}', [AdminJobCategoryController::class, 'edit'])
        ->name('admin_job_category_edit');
    Route::post('/admin/job-category/update{id}/', [AdminJobCategoryController::class, 'update'])
        ->name('admin_job_category_update');
    Route::get('/admin/job-category/delete/{id}', [AdminJobCategoryController::class, 'delete'])
        ->name('admin_job_category_delete');



    // Why choose
    Route::get('/admin/why-choose/view', [AdminWhyChooseController::class, 'index'])
        ->name('admin_why_choose_item');
    Route::get('/admin/why-choose/add', [AdminWhyChooseController::class, 'add_section'])
        ->name('admin_why_choose_item_add');
    Route::post('/admin/why-choose/store', [AdminWhyChooseController::class, 'store'])
        ->name('admin_why_choose_item_store');
    Route::get('/admin/why-choose/edit/{id}', [AdminWhyChooseController::class, 'edit'])
        ->name('admin_why_choose_item_edit');
    Route::post('/admin/why-choose/update{id}/', [AdminWhyChooseController::class, 'update'])
        ->name('admin_why_choose_item_update');
    Route::get('/admin/why-choose/delete/{id}', [AdminWhyChooseController::class, 'delete'])
        ->name('admin_why_choose_item_delete');

    // FAQ
    Route::get('/admin/faq/view', [AdminFaqController::class, 'index'])
        ->name('admin_faq');
    Route::get('/admin/faq/add', [AdminFaqController::class, 'add_section'])
        ->name('admin_faq_item_add');
    Route::post('/admin/faq/store', [AdminFaqController::class, 'store'])
        ->name('admin_faq_item_store');
    Route::get('/admin/faq/edit/{id}', [AdminFaqController::class, 'edit'])
        ->name('admin_faq_item_edit');
    Route::post('/admin/faq/update{id}/', [AdminFaqController::class, 'update'])
        ->name('admin_faq_item_update');
    Route::get('/admin/faq/delete/{id}', [AdminFaqController::class, 'delete'])
        ->name('admin_faq_item_delete');

    // Package
    Route::get('/admin/package/view', [AdminPackageController::class, 'index'])
        ->name('admin_package');
    Route::get('/admin/package/add', [AdminPackageController::class, 'add_section'])
        ->name('admin_package_item_add');
    Route::post('/admin/package/store', [AdminPackageController::class, 'store'])
        ->name('admin_package_item_store');
    Route::get('/admin/package/edit/{id}', [AdminPackageController::class, 'edit'])
        ->name('admin_package_item_edit');
    Route::post('/admin/package/update{id}/', [AdminPackageController::class, 'update'])
        ->name('admin_package_item_update');
    Route::get('/admin/package/delete/{id}', [AdminPackageController::class, 'delete'])
        ->name('admin_package_item_delete');
});
