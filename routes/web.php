<?php

use App\Http\Controllers\Admin\AdminCandidateController;
use App\Http\Controllers\Admin\AdminCompanyController;
use App\Http\Controllers\Admin\AdminCompanyIndustryController;
use App\Http\Controllers\Admin\AdminCompanyLocationController;
use App\Http\Controllers\Admin\AdminCompanySizeController;
use App\Http\Controllers\Admin\AdminContactPageController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminFaqPageController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminHomePageController;
use App\Http\Controllers\Admin\AdminJobCategoryController;
use App\Http\Controllers\Admin\AdminJobCategoryPageController;
use App\Http\Controllers\Admin\AdminJobExperienceController;
use App\Http\Controllers\Admin\AdminJobGenderController;
use App\Http\Controllers\Admin\AdminJobLocationController;
use App\Http\Controllers\Admin\AdminJobSalaryRangeController;
use App\Http\Controllers\Admin\AdminJobTypeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminOtherPageController;
use App\Http\Controllers\Admin\AdminPrivacyPageController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminTermPageController;
use App\Http\Controllers\Admin\AdminWhyChooseController;
use App\Http\Controllers\Admin\AdminPackageController;
use App\Http\Controllers\Admin\AdminPricingPageController;
use App\Http\Controllers\Candidate\CandidateController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Front\CompanyListingController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\FaqController;
use App\Http\Controllers\Front\ForgetPasswordController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\JobCategoryController;
use App\Http\Controllers\Front\JobListingController;
use App\Http\Controllers\Front\LoginController;
use App\Http\Controllers\Front\PricingController;
use App\Http\Controllers\Front\PrivacyController;
use App\Http\Controllers\Front\SignupController;
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
Route::get('job-listing', [JobListingController::class, 'index'])->name('job_listing');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('signup', [SignupController::class, 'index'])->name('signup');
Route::get('job/{id}', [JobListingController::class, 'detail'])->name('job');
Route::post('job/enquery/email', [JobListingController::class, 'send_email'])->name('job_enquery_form');

Route::get('company-listing', [CompanyListingController::class, 'index'])->name('company_listing');
// Route::get('company/{id}', [CompanyListingController::class, 'detail'])->name('company');
// Route::post('company/enquery/email', [CompanyListingController::class, 'send_email'])->name('company_enquery_form');

// company signup and login
Route::post('company_signup_submit', [SignupController::class, 'company_signup_submit'])->name('company_signup_submit');
Route::get('company_signup_verify/{token}/{email}', [SignupController::class, 'company_signup_verify'])->name('company_signup_verify');
Route::post('company_login_submit', [LoginController::class, 'company_login_submit'])->name('company_login_submit');
Route::get('/company/logout', [LoginController::class, 'company_logout'])->name('company_logout');
Route::get('forget_password_company', [ForgetPasswordController::class, 'company_forget_password'])->name('company_forget_password');
Route::post('company_forget_password/submit', [ForgetPasswordController::class, 'company_forget_password_submit'])->name('company_forget_password_submit');
Route::get('reset-password/company/{token}/{email}', [ForgetPasswordController::class, 'company_reset_password'])->name('company_reset_password');
Route::post('company-reset-password-submit', [ForgetPasswordController::class, 'company_reset_password_submit'])->name('company_reset_password_submit');

// candidate
Route::post('candidate_signup_submit', [SignupController::class, 'candidate_signup_submit'])->name('candidate_signup_submit');
Route::get('candidate_signup_verify/{token}/{email}', [SignupController::class, 'candidate_signup_verify'])->name('candidate_signup_verify');
Route::post('candidate_login_submit', [LoginController::class, 'candidate_login_submit'])->name('candidate_login_submit');
Route::get('/candidate/logout', [LoginController::class, 'candidate_logout'])->name('candidate_logout');
Route::get('forget_password_candidate', [ForgetPasswordController::class, 'candidate_forget_password'])->name('candidate_forget_password');
Route::post('candidate_forget_password/submit', [ForgetPasswordController::class, 'candidate_forget_password_submit'])->name('candidate_forget_password_submit');
Route::get('reset-password/candidate/{token}/{email}', [ForgetPasswordController::class, 'candidate_reset_password'])->name('candidate_reset_password');
Route::post('candidate-reset-password-submit', [ForgetPasswordController::class, 'candidate_reset_password_submit'])->name('candidate_reset_password_submit');

// candidate middleware
Route::middleware(['candidate:candidate'])->group(function () {
    Route::get('/candidate/dashboard', [CandidateController::class, 'dashboard'])->name('candidate_dashboard');
    Route::get('/candidate/edit-profile', [CandidateController::class, 'edit_profile'])->name('candidate_edit_profile');
    Route::post('/candidate/edit-profil/update', [CandidateController::class, 'edit_profile_update'])->name('candidate_edit_profile_update');
    Route::get('/candidate/change-password', [CandidateController::class, 'candidate_change_password'])->name('candidate_change_password');
    Route::post('/candidate/change-password/update', [CandidateController::class, 'candidate_change_password_update'])->name('candidate_change_password_update');
    Route::get('/candidate/education/view', [CandidateController::class, 'education'])->name('candidate_education');
    Route::get('/candidate/education/add', [CandidateController::class, 'add_section'])->name('candidate_education_add');
    Route::post('/candidate/education/store', [CandidateController::class, 'store'])->name('candidate_education_store');
    Route::get('/candidate/education/edit/{id}', [CandidateController::class, 'edit'])->name('candidate_education_edit');
    Route::post('/candidate/education/update{id}/', [CandidateController::class, 'update'])->name('candidate_education_update');
    Route::get('/candidate/education/delete/{id}', [CandidateController::class, 'delete'])->name('candidate_education_delete');
    Route::get('/candidate/skill/view', [CandidateController::class, 'skill'])->name('candidate_skill');
    Route::get('/candidate/skill/add', [CandidateController::class, 'skill_add_section'])->name('candidate_skill_add');
    Route::post('/candidate/skill/store', [CandidateController::class, 'skill_store'])->name('candidate_skill_store');
    Route::get('/candidate/skill/edit/{id}', [CandidateController::class, 'skill_edit'])->name('candidate_skill_edit');
    Route::post('/candidate/skill/update{id}/', [CandidateController::class, 'skill_update'])->name('candidate_skill_update');
    Route::get('/candidate/skill/delete/{id}', [CandidateController::class, 'skill_delete'])->name('candidate_skill_delete');

    Route::get('/candidate/work-experience/view', [CandidateController::class, 'work_experience'])->name('candidate_work_experience');
    Route::get('/candidate/work-experience/add', [CandidateController::class, 'work_experience_add_section'])->name('candidate_work_experience_add');
    Route::post('/candidate/work-experience/store', [CandidateController::class, 'work_experience_store'])->name('candidate_work_experience_store');
    Route::get('/candidate/work-experience/edit/{id}', [CandidateController::class, 'work_experience_edit'])->name('candidate_work_experience_edit');
    Route::post('/candidate/work-experience/update{id}/', [CandidateController::class, 'work_experience_update'])->name('candidate_work_experience_update');
    Route::get('/candidate/work-experience/delete/{id}', [CandidateController::class, 'work_experience_delete'])->name('candidate_work_experience_delete');

    Route::get('/candidate/resume/view', [CandidateController::class, 'resume'])->name('candidate_resume');
    Route::get('/candidate/resume/add', [CandidateController::class, 'resume_add_section'])->name('candidate_resume_add');
    Route::post('/candidate/resume/store', [CandidateController::class, 'resume_store'])->name('candidate_resume_store');
    Route::get('/candidate/resume/edit/{id}', [CandidateController::class, 'resume_edit'])->name('candidate_resume_edit');
    Route::post('/candidate/resume/update{id}/', [CandidateController::class, 'resume_update'])->name('candidate_resume_update');
    Route::get('/candidate/resume/delete/{id}', [CandidateController::class, 'resume_delete'])->name('candidate_resume_delete');
    Route::get('/candidate/apply/{id}', [CandidateController::class, 'apply'])->name('candidate_apply');
    Route::post('/candidate/apply-submit/{id}', [CandidateController::class, 'apply_submit'])->name('candidate_apply_submit');
    Route::get('/candidate/application', [CandidateController::class, 'application'])->name('candidate_application');
});

// company middleware
Route::middleware(['company:company'])->group(function () {
    Route::get('/company/dashboard', [CompanyController::class, 'dashboard'])->name('company_dashboard');
    Route::get('/company/make-payment', [CompanyController::class, 'make_payment'])->name('company_make_payment');
    Route::get('/company/orders', [CompanyController::class, 'orders'])->name('company_orders');
    Route::post('/company/paypal/payment', [CompanyController::class, 'paypal'])->name('paypal');
    Route::get('/company/paypal/success', [CompanyController::class, 'paypal_success'])->name('paypal_success');
    Route::get('/company/paypal/cancel', [CompanyController::class, 'paypal_cancel'])->name('paypal_cancel');
    Route::post('/company/stripe/payment', [CompanyController::class, 'company_stripe'])->name('company_stripe');
    Route::get('/company/stripe/success', [CompanyController::class, 'stripe_success'])->name('stripe_success');
    Route::get('/company/stripe/cancel', [CompanyController::class, 'stripe_cancel'])->name('stripe_cancel');
    Route::get('/company/edit-profile', [CompanyController::class, 'edit_profile'])->name('company_edit_profile');
    Route::post('/company/edit-profil/update', [CompanyController::class, 'edit_profile_update'])->name('company_edit_profile_update');
    Route::get('/company/photos', [CompanyController::class, 'photos'])->name('company_photos');
    Route::post('/company/photos/submit', [CompanyController::class, 'company_photo_submit'])->name('company_photo_submit');
    Route::get('/company/photos/delete/{id}', [CompanyController::class, 'delete_photos'])->name('company_photo_delete');
    Route::get('/company/videos', [CompanyController::class, 'videos'])->name('company_videos');
    Route::post('/company/videos/submit', [CompanyController::class, 'company_video_submit'])->name('company_video_submit');
    Route::get('/company/videos/delete/{id}', [CompanyController::class, 'delete_videos'])->name('company_video_delete');
    Route::get('/company/change-password', [CompanyController::class, 'company_change_password'])->name('company_change_password');
    Route::post('/company/change-password/update', [CompanyController::class, 'company_change_password_update'])->name('company_change_password_update');
    Route::get('/company/create-job', [CompanyController::class, 'jobs_create'])->name('company_jobs_create');
    Route::post('/company/create-job/submit', [CompanyController::class, 'jobs_create_submit'])->name('company_jobs_create_submit');
    Route::get('/company/jobs', [CompanyController::class, 'jobs'])->name('company_jobs');
    Route::get('/company/job-edit/{id}', [CompanyController::class, 'edit_jobs'])->name('company_jobs_edit');
    Route::post('/company/job-update/{id}', [CompanyController::class, 'jobs_update'])->name('company_jobs_update');
    Route::get('/company/job-delete/{id}', [CompanyController::class, 'jobs_delete'])->name('company_jobs_delete');
    Route::get('/company/candidate-applications', [CompanyController::class, 'candidate_applications'])->name('company_candidate_applications');
    Route::get('/company/applicants/{id}', [CompanyController::class, 'applicants'])->name('company_applicants');
    Route::get('/company/applicants-resume/{id}', [CompanyController::class, 'applicant_resume'])->name('company_applicant_resume');
    Route::post('/company/applicants-status-change', [CompanyController::class, 'applicant_status'])->name('company_applicant_status_change');
});

/*Admin route*/
Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin_login');
Route::post('/admin/login-submit', [AdminLoginController::class, 'login_submit'])->name('admin_login_submit');
Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin_logout');
Route::get('/admin/forget-password', [AdminLoginController::class, 'forget_password'])->name('admin_forget_password');
Route::post('/admin/forget-password-submit', [AdminLoginController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
Route::get('/admin/reset-password/{token}/{email}', [AdminLoginController::class, 'reset_password'])->name('admin_reset_password');
Route::post('/admin/reset-password-submit', [AdminLoginController::class, 'reset_password_submit'])->name('admin_reset_password_submit');

Route::middleware(['admin:admin'])->group(function () {
    Route::get('/admin/home', [AdminHomeController::class, 'index'])->name('admin_home');
    Route::get('/admin/edit-profile', [AdminProfileController::class, 'index'])->name('admin_profile');
    Route::post('/admin/edit-profile-submit', [AdminProfileController::class, 'profile_submit'])->name('admin_profile_submit');
    Route::get('/admin/home-page', [AdminHomePageController::class, 'index'])->name('admin_home_page');
    Route::post('/admin/home-page/update', [AdminHomePageController::class, 'update'])->name('admin_home_page_update');
    Route::get('/admin/faq-page', [AdminFaqPageController::class, 'index'])->name('admin_faq_page');
    Route::post('/admin/faq-page/update', [AdminFaqPageController::class, 'update'])->name('admin_faq_page_update');
    Route::get('/admin/term-page', [AdminTermPageController::class, 'index'])->name('admin_term_page');
    Route::post('/admin/term-page/update', [AdminTermPageController::class, 'update'])->name('admin_term_page_update');
    Route::get('/admin/privacy-page', [AdminPrivacyPageController::class, 'index'])->name('admin_privacy_page');
    Route::post('/admin/privacy-page/update', [AdminPrivacyPageController::class, 'update'])->name('admin_privacy_page_update');
    // contact route
    Route::get('/admin/contact-page', [AdminContactPageController::class, 'index'])->name('admin_contact_page');
    Route::post('/admin/contact-page/update', [AdminContactPageController::class, 'update'])->name('admin_contact_page_update');
    // job category page
    Route::get('/admin/job-category-page', [AdminJobCategoryPageController::class, 'index'])->name('admin_job_category_page');
    Route::post('/admin/job-category-page/update', [AdminJobCategoryPageController::class, 'update'])->name('admin_job_category_page_update');
    // pricing
    Route::get('/admin/pricing-page', [AdminPricingPageController::class, 'index'])->name('admin_pricing_page');
    Route::post('/admin/pricing-page/update', [AdminPricingPageController::class, 'update'])->name('admin_pricing_page_update');
    // others
    Route::get('/admin/other-page', [AdminOtherPageController::class, 'index'])->name('admin_other_page');
    Route::post('/admin/other-page/update', [AdminOtherPageController::class, 'update'])->name('admin_other_page_update');

    // Job category
    Route::get('/admin/job-category/view', [AdminJobCategoryController::class, 'index'])->name('admin_job_category');
    Route::get('/admin/job-category/add', [AdminJobCategoryController::class, 'add_section'])->name('admin_job_category_add');
    Route::post('/admin/job-category/store', [AdminJobCategoryController::class, 'store'])->name('admin_job_category_store');
    Route::get('/admin/job-category/edit/{id}', [AdminJobCategoryController::class, 'edit'])->name('admin_job_category_edit');
    Route::post('/admin/job-category/update{id}/', [AdminJobCategoryController::class, 'update'])->name('admin_job_category_update');
    Route::get('/admin/job-category/delete/{id}', [AdminJobCategoryController::class, 'delete'])->name('admin_job_category_delete');

    // Job location
    Route::get('/admin/job-location/view', [AdminJobLocationController::class, 'index'])->name('admin_job_location');
    Route::get('/admin/job-location/add', [AdminJobLocationController::class, 'add_section'])->name('admin_job_location_add');
    Route::post('/admin/job-location/store', [AdminJobLocationController::class, 'store'])->name('admin_job_location_store');
    Route::get('/admin/job-location/edit/{id}', [AdminJobLocationController::class, 'edit'])->name('admin_job_location_edit');
    Route::post('/admin/job-location/update{id}/', [AdminJobLocationController::class, 'update'])->name('admin_job_location_update');
    Route::get('/admin/job-location/delete/{id}', [AdminJobLocationController::class, 'delete'])->name('admin_job_location_delete');

    // Job Type
    Route::get('/admin/job-type/view', [AdminJobTypeController::class, 'index'])->name('admin_job_type');
    Route::get('/admin/job-type/add', [AdminJobTypeController::class, 'add_section'])->name('admin_job_type_add');
    Route::post('/admin/job-type/store', [AdminJobTypeController::class, 'store'])->name('admin_job_type_store');
    Route::get('/admin/job-type/edit/{id}', [AdminJobTypeController::class, 'edit'])->name('admin_job_type_edit');
    Route::post('/admin/job-type/update{id}/', [AdminJobTypeController::class, 'update'])->name('admin_job_type_update');
    Route::get('/admin/job-type/delete/{id}', [AdminJobTypeController::class, 'delete'])->name('admin_job_type_delete');

    // Job Experience
    Route::get('/admin/job-experience/view', [AdminJobExperienceController::class, 'index'])->name('admin_job_experience');
    Route::get('/admin/job-experience/add', [AdminJobExperienceController::class, 'add_section'])->name('admin_job_experience_add');
    Route::post('/admin/job-experience/store', [AdminJobExperienceController::class, 'store'])->name('admin_job_experience_store');
    Route::get('/admin/job-experience/edit/{id}', [AdminJobExperienceController::class, 'edit'])->name('admin_job_experience_edit');
    Route::post('/admin/job-experience/update{id}/', [AdminJobExperienceController::class, 'update'])->name('admin_job_experience_update');
    Route::get('/admin/job-experience/delete/{id}', [AdminJobExperienceController::class, 'delete'])->name('admin_job_experience_delete');

    // Gender
    Route::get('/admin/job-gender/view', [AdminJobGenderController::class, 'index'])->name('admin_job_gender');
    Route::get('/admin/job-gender/add', [AdminJobGenderController::class, 'add_section'])->name('admin_job_gender_add');
    Route::post('/admin/job-gender/store', [AdminJobGenderController::class, 'store'])->name('admin_job_gender_store');
    Route::get('/admin/job-gender/edit/{id}', [AdminJobGenderController::class, 'edit'])->name('admin_job_gender_edit');
    Route::post('/admin/job-gender/update{id}/', [AdminJobGenderController::class, 'update'])->name('admin_job_gender_update');
    Route::get('/admin/job-gender/delete/{id}', [AdminJobGenderController::class, 'delete'])->name('admin_job_gender_delete');

    // Salary
    Route::get('/admin/job-salary-range/view', [AdminJobSalaryRangeController::class, 'index'])->name('admin_job_salary_range');
    Route::get('/admin/job-salary-range/add', [AdminJobSalaryRangeController::class, 'add_section'])->name('admin_job_salary_range_add');
    Route::post('/admin/job-salary-range/store', [AdminJobSalaryRangeController::class, 'store'])->name('admin_job_salary_range_store');
    Route::get('/admin/job-salary-range/edit/{id}', [AdminJobSalaryRangeController::class, 'edit'])->name('admin_job_salary_range_edit');
    Route::post('/admin/job-salary-range/update{id}/', [AdminJobSalaryRangeController::class, 'update'])->name('admin_job_salary_range_update');
    Route::get('/admin/job-salary-range/delete/{id}', [AdminJobSalaryRangeController::class, 'delete'])->name('admin_job_salary_range_delete');

    // Company Location
    Route::get('/admin/job-company-location/view', [AdminCompanyLocationController::class, 'index'])->name('admin_job_company_location');
    Route::get('/admin/job-company-location/add', [AdminCompanyLocationController::class, 'add_section'])->name('admin_job_company_location_add');
    Route::post('/admin/job-company-location/store', [AdminCompanyLocationController::class, 'store'])->name('admin_job_company_location_store');
    Route::get('/admin/job-company-location/edit/{id}', [AdminCompanyLocationController::class, 'edit'])->name('admin_job_company_location_edit');
    Route::post('/admin/job-company-location/update{id}/', [AdminCompanyLocationController::class, 'update'])->name('admin_job_company_location_update');
    Route::get('/admin/job-company-location/delete/{id}', [AdminCompanyLocationController::class, 'delete'])->name('admin_job_company_location_delete');


    // Company Industry
    Route::get('/admin/job-company-industry/view', [AdminCompanyIndustryController::class, 'index'])->name('admin_job_company_industry');
    Route::get('/admin/job-company-industry/add', [AdminCompanyIndustryController::class, 'add_section'])->name('admin_job_company_industry_add');
    Route::post('/admin/job-company-industry/store', [AdminCompanyIndustryController::class, 'store'])->name('admin_job_company_industry_store');
    Route::get('/admin/job-company-industry/edit/{id}', [AdminCompanyIndustryController::class, 'edit'])->name('admin_job_company_industry_edit');
    Route::post('/admin/job-company-industry/update{id}/', [AdminCompanyIndustryController::class, 'update'])->name('admin_job_company_industry_update');
    Route::get('/admin/job-company-industry/delete/{id}', [AdminCompanyIndustryController::class, 'delete'])->name('admin_job_company_industry_delete');

    // Company Size
    Route::get('/admin/job-company-size/view', [AdminCompanySizeController::class, 'index'])->name('admin_job_company_size');
    Route::get('/admin/job-company-size/add', [AdminCompanySizeController::class, 'add_section'])->name('admin_job_company_size_add');
    Route::post('/admin/job-company-size/store', [AdminCompanySizeController::class, 'store'])->name('admin_job_company_size_store');
    Route::get('/admin/job-company-size/edit/{id}', [AdminCompanySizeController::class, 'edit'])->name('admin_job_company_size_edit');
    Route::post('/admin/job-company-size/update{id}/', [AdminCompanySizeController::class, 'update'])->name('admin_job_company_size_update');
    Route::get('/admin/job-company-size/delete/{id}', [AdminCompanySizeController::class, 'delete'])->name('admin_job_company_size_delete');

    // Why choose
    Route::get('/admin/why-choose/view', [AdminWhyChooseController::class, 'index'])->name('admin_why_choose_item');
    Route::get('/admin/why-choose/add', [AdminWhyChooseController::class, 'add_section'])->name('admin_why_choose_item_add');
    Route::post('/admin/why-choose/store', [AdminWhyChooseController::class, 'store'])->name('admin_why_choose_item_store');
    Route::get('/admin/why-choose/edit/{id}', [AdminWhyChooseController::class, 'edit'])->name('admin_why_choose_item_edit');
    Route::post('/admin/why-choose/update{id}/', [AdminWhyChooseController::class, 'update'])->name('admin_why_choose_item_update');
    Route::get('/admin/why-choose/delete/{id}', [AdminWhyChooseController::class, 'delete'])->name('admin_why_choose_item_delete');

    // FAQ
    Route::get('/admin/faq/view', [AdminFaqController::class, 'index'])->name('admin_faq');
    Route::get('/admin/faq/add', [AdminFaqController::class, 'add_section'])->name('admin_faq_item_add');
    Route::post('/admin/faq/store', [AdminFaqController::class, 'store'])->name('admin_faq_item_store');
    Route::get('/admin/faq/edit/{id}', [AdminFaqController::class, 'edit'])->name('admin_faq_item_edit');
    Route::post('/admin/faq/update{id}/', [AdminFaqController::class, 'update'])->name('admin_faq_item_update');
    Route::get('/admin/faq/delete/{id}', [AdminFaqController::class, 'delete'])->name('admin_faq_item_delete');

    // Package
    Route::get('/admin/package/view', [AdminPackageController::class, 'index'])->name('admin_package');
    Route::get('/admin/package/add', [AdminPackageController::class, 'add_section'])->name('admin_package_item_add');
    Route::post('/admin/package/store', [AdminPackageController::class, 'store'])->name('admin_package_item_store');
    Route::get('/admin/package/edit/{id}', [AdminPackageController::class, 'edit'])->name('admin_package_item_edit');
    Route::post('/admin/package/update{id}/', [AdminPackageController::class, 'update'])->name('admin_package_item_update');
    Route::get('/admin/package/delete/{id}', [AdminPackageController::class, 'delete'])->name('admin_package_item_delete');

    // company profile controller
    Route::get('/admin/companies', [AdminCompanyController::class, 'index'])->name('admin_companies');
    Route::get('/admin/companies-detail/{id}', [AdminCompanyController::class, 'companies_detail'])->name('admin_companies_detail');
    Route::get('/admin/companies-jobs/{id}', [AdminCompanyController::class, 'companies_jobs'])->name('admin_companies_jobs');
    Route::get('/admin/companies-applicants/{id}', [AdminCompanyController::class, 'companies_applicants'])->name('admin_companies_applicants');
    Route::get('/admin/companies-applicant-resume/{id}', [AdminCompanyController::class, 'companies_applicant_resume'])->name('admin_companies_applicant_resume');
    Route::get('/admin/companies-delete/{id}', [AdminCompanyController::class, 'delete'])->name('admin_companies_delete');

    // candidate data 
    Route::get('/admin/candidates', [AdminCandidateController::class, 'index'])->name('admin_candidates');
    Route::get('/admin/candidates-detail/{id}', [AdminCandidateController::class, 'candidates_detail'])->name('admin_candidates_detail');
    Route::get('/admin/candidates-delete/{id}', [AdminCandidateController::class, 'delete'])->name('admin_candidates_delete');
    Route::get('/admin/candidates-applied-job/{id}', [AdminCandidateController::class, 'candidates_applied_job'])->name('admin_candidates_applied_job');
});