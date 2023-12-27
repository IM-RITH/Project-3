<?php

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminHomePageController;
use App\Http\Controllers\Admin\AdminJobCategoryController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminWhyChooseController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\JobCategoryController;
use App\Http\Controllers\Front\TermsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('terms', [TermsController::class, 'index'])->name('terms');
Route::get('job-categories', [JobCategoryController::class, 'categories'])->name('job_categories');

/*Admin route*/
Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin_login');
Route::post('/admin/login-submit', [AdminLoginController::class, 'login_submit'])->name('admin_login_submit');
Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin_logout');
Route::get('/admin/forget-password', [AdminLoginController::class, 'forget_password'])->name('admin_forget_password');
Route::post('/admin/forget-password-submit', [AdminLoginController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
Route::get('/admin/reset-password/{token}/{email}', [AdminLoginController::class, 'reset_password'])->name('admin_reset_password');
Route::post('/admin/reset-password-submit', [AdminLoginController::class, 'reset_password_submit'])->name('admin_reset_password_submit');

Route::middleware(['admin:admin'])->group(function () {
    // Profile
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
});