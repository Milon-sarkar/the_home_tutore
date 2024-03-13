<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\HireController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TclassController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\TuitionController;
use App\Http\Controllers\banner_imageController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\hire_banner_imageController;
use App\Http\Controllers\PhoneNumberController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Route::get('/test', function () {
//     return view('test');
// })->name('test');


Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/password', '\App\Http\Controllers\Auth\LoginController@password')->name('auth.password');
Route::post('/password-login', '\App\Http\Controllers\Auth\LoginController@loginwithPassword')->name('auth.loginwithPassword');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
Route::get('/verification-confirmation/{code}', 'Auth\VerificationController@verification_confirmation')->name('email.verification.confirmation');
Route::post('check_phone_number', [\App\Http\Controllers\Auth\VerificationController::class, 'check_phone_number'])->name('check_phone_number');
Route::post('check_email', [\App\Http\Controllers\Auth\VerificationController::class, 'check_email'])->name('check_email');

Route::get('/email_change/callback', 'HomeController@email_change_callback')->name('email_change.callback');
Route::post('/password/reset/email/submit', 'HomeController@reset_password_with_code')->name('password.update');
Route::get('/hire', [HireController::class, 'hire'])->name('frontend.hire.hire');
Route::post('/hire/store', [HireController::class, 'store'])->name('frontend.hire.store');



Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::post('/insert_phone_save', 'Auth\PhoneVerificationController@insert_phone_save')->name('insert_phone_save');
    Route::post('/phone_otp_resend', 'Auth\PhoneVerificationController@phone_otp_resend')->name('phone_verification.resend');
    Route::post('/phone_otp_verify', 'Auth\PhoneVerificationController@phone_otp_verify')->name('phone_verification.verify');

    Route::get('/', 'HomeController@home')->name('index');
    Route::get('/', 'HomeController@home')->name('index');
    Route::get('/public', 'HomeController@home')->name('index');
    Route::get('/public/public', 'HomeController@home')->name('index');
    Route::get('/registration/', 'HomeController@registration')->name('registration');
    Route::get('/tutor_registration', 'HomeController@tutor_registration')->name('tutor_registration');
    Route::get('/tutor_list', 'HomeController@tutor_list')->name('tutor_list');
    Route::get('/tutor_profile/{id}', 'HomeController@tutor_profile')->name('tutor_profile');
    Route::post('/number_store', 'HomeController@number_store')->name('number_store');
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/complete_profile', 'HomeController@complete_profile')->name('complete_profile');
        Route::get('/profile', 'HomeController@profile')->name('profile');
        Route::get('/notification', 'HomeController@notification')->name('notification');
        Route::get('/student_profile', 'HomeController@student_profile')->name('student_profile');
        Route::get('/opinion', 'HomeController@opinion')->name('opinion');
        Route::post('/store', 'HomeController@store')->name('store');
        Route::get('/tutor_pasword_change/{id}', 'HomeController@tutor_pasword_change')->name('tutor_pasword_change');
        Route::post('/tutor_pasword_change_store', 'HomeController@tutor_pasword_change_store')->name('tutor_pasword_change_store');
        Route::get('/student_pasword_change/{id}', 'HomeController@student_pasword_change')->name('student_pasword_change');
        Route::post('/student_pasword_change_store', 'HomeController@student_pasword_change_store')->name('student_pasword_change_store');
        Route::post('/tutor_complete_profile_update/{id}', 'HomeController@tutor_complete_profile_update')->name('tutor_complete_profile_update');
        Route::post('/tutor_profile_update/{id}', 'HomeController@tutor_profile_update')->name('tutor_profile_update');
        Route::post('/studnt_profile_update/{id}', 'HomeController@studnt_profile_update')->name('studnt_profile_update');
        Route::get('/profile_change', 'HomeController@profile_change')->name('profile_change');
        Route::get('/my_tuition_post', 'HomeController@my_tuition_post')->name('my_tuition_post');
        Route::get('/my_tuition', 'HomeController@my_tuition')->name('my_tuition');
        Route::get('/edit_account', 'HomeController@edit_account')->name('edit_account');
        Route::post('/update_basic_information', 'HomeController@update_basic_information')->name('update_basic_information');
        Route::get('/my_apply', 'HomeController@my_apply')->name('my_apply');
        Route::get('/create_tuition', 'HomeController@create_tuition')->name('create_tuition');
        Route::post('/tuition_store', 'HomeController@tuition_store')->name('tuition_store');
        Route::get('/tuition_edit/{id}', 'HomeController@tuition_edit')->name('tuition_edit');
        Route::get('/tuition_delete/{id}', 'HomeController@tuition_delete')->name('tuition_delete');
        Route::patch('/tuition_update/{id}', 'HomeController@tuition_update')->name('tuition_update');
    });

    Route::get('/tuition_list', 'HomeController@tuition_list')->name('tuition_list');
    Route::get('/tuition_details/{tuition_id}', 'HomeController@tuition_details')->name('tuition_details');
    Route::resource('subscribers', 'SubscriberController');
    Route::get('/pages/{slug}', 'HomeController@pages')->name('pages');
    Route::post('/ajax/getDistrictByDivition', 'HomeController@getDistrictByDivition')->name('getDistrictByDivition');
    Route::post('/ajax/getAreaByDistrict', 'HomeController@getAreaByDistrict')->name('getAreaByDistrict');
    Route::post('/ajax/getAreaByThana', 'HomeController@getAreaByThana')->name('getAreaByThana');
    Route::post('/ajax/getAreaByThana_sameValue', 'HomeController@getAreaByThana_sameValue')->name('getAreaByThana_sameValue');
    Route::post('/ajax/getAreaByThanaArray', 'HomeController@getAreaByThanaArray')->name('getAreaByThanaArray');
    Route::post('/ajax/getAreaByThanaArray2', 'HomeController@getAreaByThanaArray2')->name('getAreaByThanaArray2');
    Route::post('/ajax/getThanaByDistrict', 'HomeController@getThanaByDistrict')->name('getThanaByDistrict');
    Route::post('/ajax/getUpazilaByDistrict', 'HomeController@getUpazilaByDistrict')->name('getUpazilaByDistrict');
    Route::post('/ajax/add_reaction', 'HomeController@add_reaction')->name('add_reaction');
    Route::post('checkDuplicateEmailForUser', 'HomeController@checkDuplicateEmailForUser')->name('checkDuplicateEmailForUser');
    Route::get('users-list', 'UsersController@users_list')->name('users-list');
    Route::post('user_type', 'HomeController@user_type')->name('user_type');
    Route::post('tutor_book_apply', 'HomeController@tutor_book_apply')->name('tutor_book_apply');
    Route::post('tution_book_apply', 'HomeController@tution_book_apply')->name('tution_book_apply');
    Route::post('unapply_tuition', 'HomeController@unapply_tuition')->name('unapply_tuition');
    Route::get('package-list', 'HomeController@package_list')->name('package_list');
    Route::get('/contact_page', 'HomeController@contact')->name('contact_page');
    Route::post('/contact_store', 'HomeController@contact_store')->name('contact_store');
    Route::post('review_comment', 'HomeController@review_comment')->name('review_comment');
    Route::get('/social-login/redirect/{provider}', '\App\Http\Controllers\Auth\LoginController@redirectToProvider')->name('social.login');
    Route::get('/social-login/{provider}/callback', '\App\Http\Controllers\Auth\LoginController@handleProviderCallback')->name('social.callback');
    // Route::get('/admin',  function (){
    //         return redirect('/admin/dashboard');
    // })->name('admin');

    // Route::get('/home', function (){
    //         return redirect('/admin/dashboard');
    // })->name('home');


    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/admin', function () {
        $admin = true;
        return  view('auth.login', compact('admin'));
    })->name('admin');
    Route::group(['middleware' => ['auth', 'permission'], 'prefix' => 'admin'], function () {
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');
        Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs');
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UsersController@index')->name('users.index');
            Route::get('/create', 'UsersController@create')->name('users.create');

            Route::post('/create', 'UsersController@store')->name('users.store');
            Route::get('/{user}/show', 'UsersController@show')->name('users.show');
            Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
            Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
            Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
        });

        // Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('roles', 'RolesController');
        Route::resource('permissions', 'PermissionsController');
        Route::resource('tuition_category', 'TuitionCategoryController');
        Route::resource('tutor_faculty', 'TutorFacultyController');
        Route::resource('tutor_institute_type', 'TutorInstituteTypeController');
        Route::resource('subject', 'SubjectController');
        Route::resource('class', 'TclassController');
        Route::resource('weekly', 'WeeklyController');
        Route::resource('timely', 'TimelyController');
        Route::resource('medium', 'MediumController');
        Route::resource('premium_package', 'PremiumPackageController');
        Route::resource('premium_package_items', 'PremiumPackageItemsController');
        Route::resource('area', 'AreaController');
        Route::resource('setting', 'SettingController');
        Route::resource('tuition_book', 'TuitionBookController');
        // In your routes/web.php
        Route::get('tuition_book_application_details', 'TuitionBookController@application_details')->name('tuition_book.application_details');
        Route::get('tuition_book_application_edit/{id}', 'TuitionBookController@application_edit')->name('tuition_book.application_edit');
        // Route::get('/tuitions/{id}/edit', 'TuitionController@edit')->name('tuitions.edit');
        Route::post('tuition_book_application_update/{id}', 'TuitionBookController@application_update')->name('tuition_book.application_update');
        Route::post('delete_application', 'TuitionBookController@delete_application')->name('delete_application');
        Route::get('/tuition_book/{tuition_book}/status', 'TuitionBookController@status')->name('tuition_book.status');
        Route::get('/tutors/{tutor}/status', 'TutorController@status')->name('tutors.status');
        Route::get('/tutors/{tutor}/print', 'TutorController@print')->name('tutors.print');
        Route::resource('tutors', 'TutorController');
        Route::resource('admin_page', 'PageController');
        Route::get('/tuitions/{tuition}/status', 'TuitionController@status')->name('tuitions.status');
        Route::post('/is_blocked_application', 'TuitionController@is_blocked_application')->name('is_blocked_application');
        Route::resource('tuitions', 'TuitionController');

        Route::post('/update_note', 'TuitionBookController@update_note')->name('update_note');
        Route::get('/contact_delete/{id?}', 'ContactController@contact_delete')->name('contact_delete');
        Route::resource('contact', 'ContactController');
        Route::get('tuition_comment/status', 'AdminTuitionCommentController@status')->name('tuition_comment.status');
        Route::get('tuition_comment/verified', 'AdminTuitionCommentController@verified')->name('tuition_comment.verified');
        Route::resource('tuition_comment', 'AdminTuitionCommentController');
        Route::resource('subscriber_lists', 'SubscriberListController');

        Route::resource('guardian_or_student', 'GuardianStudentController');
        Route::post('guardian_or_student/status', 'GuardianStudentController@status')->name('guardian_or_student.status');

        Route::post('send_sms', 'SendSMSController@send_sms')->name('send_sms');
        Route::post('send_notification', 'SendNotificationController@send_notification')->name('send_notification');
        Route::get('sent_notification', 'SendNotificationController@sent_notification')->name('sent_notification');
        Route::get('sent_sms', 'SendSMSController@sent_sms')->name('sent_sms');
        Route::resource('sms_templates', 'SmsTemplateController');
        Route::resource('notification_templates', 'NotificationTemplateController');
        Route::resource('tuition_condition_templates', 'TuitionConditionTemplateController');
        Route::resource('payment', 'PaymentController');
    });
    Route::post('/searchtuitions', [TuitionController::class, 'searchByGuardianNumber'])->name('tuitions.searchByGuardianNumber');
    Route::get('/tuitions/{tuition}/invoices/create', [InvoiceController::class, 'generateInvoice'])->name('invoice.create');
    Route::post('sendSms', 'SendSMSController@sendSms')->name('sendSms');
    Route::resource('/title_templates', 'TitleController');
    Route::resource('/banner_image', 'banner_imageController');
    Route::resource('/hire_banner_image', 'hire_banner_imageController');
    Route::resource('/home_page_video', 'home_page_videoController');
    Route::get('urgent_contact', 'urgentContactController@urgent_contact')->name('urgent_contact');
    Route::get('review', 'reviewController@review')->name('review');
    // Route::get('approve.contact', 'reviewController@review')->name('review');
    Route::post('/approve-review/{id}', 'reviewController@approvereview')->name('approve.review');
    Route::delete('/delete-review/{id}', 'reviewController@deletereview')->name('delete.review');


    // Route::resource('/title_templates', [TitleController::class, 'index'])->name('backend.title_template.index');
    Route::get('tuition_book_tution_edit/{id}', 'TuitionBookController@tution_edit')->name('tuition_book.tution_edit');
});
