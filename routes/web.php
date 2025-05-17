<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GotraController;
use App\Http\Controllers\AgeController;
use App\Http\Controllers\WorktypeController;
use App\Http\Controllers\CasteController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\AnnualincomeController;
use App\Http\Controllers\DiettypeController;
use App\Http\Controllers\DynamiccontentController;
use App\Http\Controllers\HeightController;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\PagewiseController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\MaritalStatusController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\SkinToneController;
use App\Http\Controllers\AllergicTypeController;
use App\Http\Controllers\DrinkTypeController;
use App\Http\Controllers\BeardTypeController;
use App\Http\Controllers\ManglikTypeController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\BodyTypeController;
use App\Http\Controllers\BenefitController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\QualityController;
use App\Http\Controllers\CommonQuestionController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\NotificationMsgController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LandingBannerController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\WebsiteController;



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
Route::get('/', [AuthController::class, 'index']);
Route::get('/privacy', [websiteController::class, 'privacyAndPolicy']);
Route::get('/aboutus', [websiteController::class, 'aboutus']);
Route::get('/terms', [websiteController::class, 'termsAndConditions']);
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [AuthController::class, 'dashboard'])->middleware('auth');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('getState', [StateController::class, 'index'])->name('state.get')->middleware('auth');
Route::get('addState', [StateController::class, 'add'])->name('addstate')->middleware('auth');
Route::post('saveState', [StateController::class, 'saveState'])->name('saveState')->middleware('auth');
Route::any('updateState/{id}', [StateController::class, 'updateState'])->name('updateState')->middleware('auth');
Route::post('saveUpdateState/{id}', [StateController::class, 'saveUpdateState'])->name('saveUpdateState')->middleware('auth');
Route::get('showState/{id}', [StateController::class, 'showState'])->name('showState')->middleware('auth');

Route::get('getCountry', [CountryController::class, 'index'])->name('country.get')->middleware('auth');
Route::get('addCountry', [CountryController::class, 'add'])->name('addCountry')->middleware('auth');
Route::post('saveCountry', [CountryController::class, 'saveCountry'])->name('saveCountry')->middleware('auth');
Route::any('updateCountry/{id}', [CountryController::class, 'updateCountry'])->name('updateCountry')->middleware('auth');
Route::any('saveUpdateCountry/{id}', [CountryController::class, 'saveUpdateCountry'])->name('saveUpdateCountry')->middleware('auth');
Route::get('showCountry/{id}', [CountryController::class, 'showCountry'])->name('showCountry')->middleware('auth');

Route::get('getAge', [AgeController::class, 'index'])->name('age.get')->middleware('auth');
Route::get('addAge', [AgeController::class, 'add'])->name('addAge')->middleware('auth');
Route::post('saveAge', [AgeController::class, 'saveAge'])->name('saveAge')->middleware('auth');
Route::any('updateAge/{id}', [AgeController::class, 'updateAge'])->name('updateAge')->middleware('auth');
Route::post('saveUpdateAge/{id}', [AgeController::class, 'saveUpdateAge'])->name('saveUpdateAge')->middleware('auth');
Route::get('showAge/{id}', [AgeController::class, 'showAge'])->name('showAge')->middleware('auth');

Route::get('getCaste', [CasteController::class, 'index'])->name('caste.get');
Route::get('addCaste', [CasteController::class, 'add'])->name('addCaste');
Route::post('saveCaste', [CasteController::class, 'saveCaste'])->name('saveCaste');
Route::any('updateCaste/{id}', [CasteController::class, 'updateCaste'])->name('updateGotra');
Route::post('saveUpdateCaste/{id}', [CasteController::class, 'saveUpdateCaste'])->name('saveUpdateCaste');
Route::get('showCaste/{id}', [CasteController::class, 'showCaste'])->name('showCaste');

Route::get('getGotra', [GotraController::class, 'index'])->name('gotra.get');
Route::get('addGotra', [GotraController::class, 'add'])->name('addGotra');
Route::post('saveGotra', [GotraController::class, 'saveGotra'])->name('saveGotra');
Route::any('updateGotra/{id}', [GotraController::class, 'updateGotra'])->name('updateGotra');
Route::post('saveUpdateGotra/{id}', [GotraController::class, 'saveUpdateGotra'])->name('saveUpdateGotra');
Route::get('showGotra/{id}', [GotraController::class, 'showGotra'])->name('showGotra');

Route::get('getWorktype', [WorktypeController::class, 'index'])->name('worktype.get');
Route::get('addWorktype', [WorktypeController::class, 'add'])->name('addWorktype');
Route::post('saveWorktype', [WorktypeController::class, 'saveWorktype'])->name('saveWorktype');
Route::any('updateWorktype/{id}', [WorktypeController::class, 'updateWorktype'])->name('updateWorktype');
Route::post('saveUpdateWorktype/{id}', [WorktypeController::class, 'saveUpdateWorktype'])->name('saveUpdateWorktype');
Route::get('showWorktype/{id}', [WorktypeController::class, 'showWorktype'])->name('showWorktype');

Route::get('getProfession', [ProfessionController::class, 'getProfession'])->name('profession.get');
Route::get('addProfession', [ProfessionController::class, 'add'])->name('addProfession');
Route::post('saveProfession', [ProfessionController::class, 'saveProfession'])->name('saveProfession');
Route::any('updateProfession/{id}', [ProfessionController::class, 'updateProfession'])->name('updateProfession');
Route::post('saveUpdateProfession/{id}', [ProfessionController::class, 'saveUpdateProfession'])->name('saveUpdateProfession');
Route::get('showProfession/{id}', [ProfessionController::class, 'showProfession'])->name('showProfession');

Route::get('getAnnualincome', [AnnualincomeController::class, 'index'])->name('annualincome.get');
Route::get('addAnnualincome', [AnnualincomeController::class, 'add'])->name('addAnnualincome');
Route::post('saveAnnualincome', [AnnualincomeController::class, 'saveAnnualincome'])->name('saveAnnualincome');
Route::any('updateAnnualincome/{id}', [AnnualincomeController::class, 'updateAnnualincome'])->name('updateAnnualincome');
Route::post('saveUpdateAnnualincome/{id}', [AnnualincomeController::class, 'saveUpdateAnnualincome'])->name('saveUpdateAnnualincome');
Route::get('showAnnualincome/{id}', [AnnualincomeController::class, 'showAnnualincome'])->name('showAnnualincome');

Route::get('getDiettype', [DiettypeController::class, 'index'])->name('diettype.get');
Route::get('addDiettype', [DiettypeController::class, 'add'])->name('addDiettype');
Route::post('saveDiettype', [DiettypeController::class, 'saveDiettype'])->name('saveDiettype');
Route::any('updateDiettype/{id}', [DiettypeController::class, 'updateDiettype'])->name('updateDiettype');
Route::post('saveUpdateDiettype/{id}', [DiettypeController::class, 'saveUpdateDiettype'])->name('saveUpdateDiettype');
Route::get('showDiettype/{id}', [DiettypeController::class, 'showDiettype'])->name('showDiettype');

Route::get('getDynamiccontent', [DynamiccontentController::class, 'index'])->name('dynamiccontent.get');
Route::get('addDynamiccontent', [DynamiccontentController::class, 'add'])->name('addDynamiccontent');
Route::post('saveDynamiccontent', [DynamiccontentController::class, 'saveDynamiccontent'])->name('saveDynamiccontent');
Route::any('updateDynamiccontent/{id}', [DynamiccontentController::class, 'updateDynamiccontent'])->name('updateDynamiccontent');
Route::post('saveUpdateDynamiccontent/{id}', [DynamiccontentController::class, 'saveUpdateDynamiccontent'])->name('saveUpdateDynamiccontent');
Route::get('showDynamiccontent/{id}', [DynamiccontentController::class, 'showDynamiccontent'])->name('showDynamiccontent');

Route::get('getHeight', [HeightController::class, 'index'])->name('height.get');
Route::get('addHeight', [HeightController::class, 'add'])->name('addHeight');
Route::post('saveHeight', [HeightController::class, 'saveHeight'])->name('saveHeight');
Route::any('updateHeight/{id}', [HeightController::class, 'updateHeight'])->name('updateHeight');
Route::post('saveUpdateHeight/{id}', [HeightController::class, 'saveUpdateHeight'])->name('saveUpdateHeight');
Route::get('showHeight/{id}', [HeightController::class, 'showHeight'])->name('showHeight');

Route::get('getPagewise', [PagewiseController::class, 'index'])->name('pagewise.get');
Route::get('addPagewise', [PagewiseController::class, 'add'])->name('addPagewise');
Route::post('savePagewise', [PagewiseController::class, 'savePagewise'])->name('savePagewise');
Route::any('updatePagewise/{id}', [PagewiseController::class, 'updatePagewise'])->name('updatePagewise');
Route::post('saveUpdatePagewise/{id}', [PagewiseController::class, 'saveUpdatePagewise'])->name('saveUpdatePagewise');
Route::get('showPagewise/{id}', [PagewiseController::class, 'showPagewise'])->name('showPagewise');

Route::get('getRole', [RoleController::class, 'index'])->name('role.get');
Route::get('addRole', [RoleController::class, 'add'])->name('addRole');
Route::post('saveRole', [RoleController::class, 'saveRole'])->name('saveRole');
Route::any('updateRole/{id}', [RoleController::class, 'updateRole'])->name('updateRole');
Route::post('saveUpdateRole/{id}', [RoleController::class, 'saveUpdateRole'])->name('saveUpdateRole');
Route::get('showRole/{id}', [RoleController::class, 'showRole'])->name('showRole');

Route::get('getWeight', [WeightController::class, 'index'])->name('weight.get');
Route::get('addWeight', [WeightController::class, 'add'])->name('addWeight');
Route::post('saveWeight', [WeightController::class, 'saveWeight'])->name('saveWeight');
Route::any('updateWeight/{id}', [WeightController::class, 'updateWeight'])->name('updateWeight');
Route::post('saveUpdateWeight/{id}', [WeightController::class, 'saveUpdateWeight'])->name('saveUpdateWeight');
Route::get('showWeight/{id}', [WeightController::class, 'showWeight'])->name('showWeight');

Route::get('getStatus', [StatusController::class, 'index'])->name('status.get');
Route::get('addStatus', [StatusController::class, 'add'])->name('addStatus');
Route::post('saveStatus', [StatusController::class, 'saveStatus'])->name('saveStatus');
Route::any('updateStatus/{id}', [StatusController::class, 'updateStatus'])->name('updateStatus');
Route::post('saveUpdateStatus/{id}', [StatusController::class, 'saveUpdateStatus'])->name('saveUpdateStatus');
Route::get('showStatus/{id}', [StatusController::class, 'showStatus'])->name('showStatus');

Route::get('getReligion', [ReligionController::class, 'index'])->name('religion.get');
Route::get('addReligion', [ReligionController::class, 'add'])->name('addReligion');
Route::post('saveReligion', [ReligionController::class, 'saveReligion'])->name('saveReligion');
Route::any('updateReligion/{id}', [ReligionController::class, 'updateReligion'])->name('updateReligion');
Route::post('saveUpdateReligion/{id}', [ReligionController::class, 'saveUpdateReligion'])->name('saveUpdateReligion');
Route::get('showReligion/{id}', [ReligionController::class, 'showReligion'])->name('showReligion');

Route::get('getSecurity', [SecurityController::class, 'index'])->name('security.get');
Route::get('addSecurity', [SecurityController::class, 'add'])->name('addSecurityQuestion');
Route::post('saveSecurity', [SecurityController::class, 'saveSecurityQuestion'])->name('saveSecurityQuestion');
Route::any('updateSecurity/{id}', [SecurityController::class, 'updateSecurityQuestion'])->name('updateSecurityQuestion');
Route::post('saveUpdateSecurity/{id}', [SecurityController::class, 'saveUpdateSecurityQuestion'])->name('saveUpdateSecurityQuestion');
Route::get('showSecurity/{id}', [SecurityController::class, 'showSecurityQuestion'])->name('showSecurityQuestion');

Route::get('getMaritalStatus', [MaritalStatusController::class, 'index'])->name('maritalstatus.get');
Route::get('addMaritalStatus', [MaritalStatusController::class, 'add'])->name('addMaritalStatus');
Route::post('saveMaritalStatus', [MaritalStatusController::class, 'saveMaritalStatus'])->name('saveMaritalStatus');
Route::any('updateMaritalStatus/{id}', [MaritalStatusController::class, 'updateMaritalStatus'])->name('updateMaritalStatus');
Route::post('saveUpdateMaritalStatus/{id}', [MaritalStatusController::class, 'saveUpdateMaritalStatus'])->name('saveUpdateMaritalStatus');
Route::get('showMaritalStatus/{id}', [MaritalStatusController::class, 'showMaritalStatus'])->name('showMaritalStatus');


Route::get('getCity', [CityController::class, 'index'])->name('city.get');
Route::get('addCity', [CityController::class, 'add'])->name('addCity');
Route::post('saveCity', [CityController::class, 'saveCity'])->name('saveCity');
Route::any('updateCity/{id}', [CityController::class, 'updateCity'])->name('updateGity');
Route::post('saveUpdateCity/{id}', [CityController::class, 'saveUpdateCity'])->name('saveUpdateCity');
Route::get('showCity/{id}', [CityController::class, 'showCity'])->name('showCity');

Route::get('getDistrict', [DistrictController::class, 'index'])->name('district.get');
Route::get('addDistrict', [DistrictController::class, 'add'])->name('addDistrict');
Route::post('saveDistrict', [DistrictController::class, 'saveDistrict'])->name('saveDistrict');
Route::any('updateDistrict/{id}', [DistrictController::class, 'updateDistrict'])->name('updateDistrict');
Route::post('saveUpdateDistrict/{id}', [DistrictController::class, 'saveUpdateDistrict'])->name('saveUpdateDistrict');
Route::get('showDistrict/{id}', [DistrictController::class, 'showDistrict'])->name('showDistrict');

Route::get('getCommonQuestion', [CommonQuestionController::class, 'index'])->name('common.get');
Route::get('addCommonQuestion', [CommonQuestionController::class, 'add'])->name('addCommonQuestion');
Route::post('saveCommonQuestion', [CommonQuestionController::class, 'saveCommonQuestion'])->name('saveCommonQuestion');
Route::any('updateCommonQuestion/{id}', [CommonQuestionController::class, 'updateCommonQuestion'])->name('updateCommonQuestion');
Route::post('saveUpdateCommonQuestion/{id}', [CommonQuestionController::class, 'saveUpdateCommonQuestion'])->name('saveUpdateCommonQuestion');
Route::get('showCommonQuestion/{id}', [CommonQuestionController::class, 'showCommonQuestion'])->name('showCommonQuestion');

Route::get('getUser', [UserController::class, 'index'])->name('user.get');
Route::get('downloadfile', [UserController::class, 'downloadfile'])->name('user.downloadfile');
Route::post('getUser', [UserController::class, 'searchUser'])->name('user.get');
Route::get('addUser', [UserController::class, 'add'])->name('adduser');
Route::get('updateUser/{id}', [UserController::class, 'edit'])->name('updateUser');
Route::get('deleteUser/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
Route::post('saveEditUser', [UserController::class, 'saveEdit'])->name('saveEdit');
Route::post('importUser', [UserController::class, 'importUser'])->name('importUser');

Route::get('getTempUser', [UserController::class, 'getTempUser'])->name('getTempUser');
Route::post('getTUser', [UserController::class, 'searchTempUser'])->name('searchTempUser');
Route::get('editTempUser/{id}', [UserController::class, 'editTempUser'])->name('editTempUser');
Route::post('saveEditTempUser', [UserController::class, 'saveTempEdit'])->name('saveTempEdit');
Route::get('saveTempMoveToMain/{id}', [UserController::class, 'saveTempMoveToMain'])->name('saveTempMoveToMain');

Route::get('getSkinTone', [SkinToneController::class, 'index'])->name('skinTone.get');
Route::get('addSkinTone', [SkinToneController::class, 'add'])->name('addSkinTone');
Route::post('saveSkinTone', [SkinToneController::class, 'saveSkinTone'])->name('saveSkinTone');
Route::any('updateSkinTone/{id}', [SkinToneController::class, 'updateSkinTone'])->name('updateSkinTone');
Route::post('saveUpdateSkinTone/{id}', [SkinToneController::class, 'saveUpdateSkinTone'])->name('saveUpdateSkinTone');
Route::get('showSkinTone/{id}', [SkinToneController::class, 'showSkinTone'])->name('showSkinTone');

Route::get('getAllergicType', [AllergicTypeController::class, 'index'])->name('allergicType.get');
Route::get('addAllergicType', [AllergicTypeController::class, 'add'])->name('addAllergicType');
Route::post('saveAllergicType', [AllergicTypeController::class, 'saveAllergicType'])->name('saveAllergicType');
Route::any('updateAllergicType/{id}', [AllergicTypeController::class, 'updateAllergicType'])->name('updateAllergicType');
Route::post('saveUpdateAllergicType/{id}', [AllergicTypeController::class, 'saveUpdateAllergicType'])->name('saveUpdateAllergicType');
Route::get('showAllergicType/{id}', [AllergicTypeController::class, 'showAllergicType'])->name('showAllergicType');

Route::get('getDrinkType', [DrinkTypeController::class, 'index'])->name('drinkType.get');
Route::get('addDrinkType', [DrinkTypeController::class, 'add'])->name('addDrinkType');
Route::post('saveDrinkType', [DrinkTypeController::class, 'saveDrinkType'])->name('saveDrinkType');
Route::any('updateDrinkType/{id}', [DrinkTypeController::class, 'updateDrinkType'])->name('updateDrinkType');
Route::post('saveUpdateDrinkType/{id}', [DrinkTypeController::class, 'saveUpdateDrinkType'])->name('saveUpdateDrinkType');
Route::get('showDrinkType/{id}', [DrinkTypeController::class, 'showDrinkType'])->name('showDrinkType');

Route::get('getBeardType', [BeardTypeController::class, 'index'])->name('beardType.get');
Route::get('addBeardType', [BeardTypeController::class, 'add'])->name('addBeardType');
Route::post('saveBeardType', [BeardTypeController::class, 'saveBeardType'])->name('saveBeardType');
Route::any('updateBeardType/{id}', [BeardTypeController::class, 'updateBeardType'])->name('updateBeardType');
Route::post('saveUpdateBeardType/{id}', [BeardTypeController::class, 'saveUpdateBeardType'])->name('saveUpdateBeardType');
Route::get('showBeardType/{id}', [BeardTypeController::class, 'showBeardType'])->name('showBeardType');

Route::get('getManglikType', [ManglikTypeController::class, 'index'])->name('manglikType.get');
Route::get('addManglikType', [ManglikTypeController::class, 'add'])->name('addManglikType');
Route::post('saveManglikType', [ManglikTypeController::class, 'saveManglikType'])->name('saveManglikType');
Route::any('updateManglikType/{id}', [ManglikTypeController::class, 'updateManglikType'])->name('updateManglikType');
Route::post('saveUpdateManglikType/{id}', [ManglikTypeController::class, 'saveUpdateManglikType'])->name('saveUpdateManglikType');
Route::get('showManglikType/{id}', [ManglikTypeController::class, 'showManglikType'])->name('showManglikType');

Route::get('getNationality', [NationalityController::class, 'index'])->name('nationality.get');
Route::get('addNationality', [NationalityController::class, 'add'])->name('addNationality');
Route::post('saveNationality', [NationalityController::class, 'saveNationality'])->name('saveNationality');
Route::any('updateNationality/{id}', [NationalityController::class, 'updateNationality'])->name('updateNationality');
Route::post('saveUpdateNationality/{id}', [NationalityController::class, 'saveUpdateNationality'])->name('saveUpdateNationality');
Route::get('showNationality/{id}', [NationalityController::class, 'showNationality'])->name('showNationality');

Route::get('getJob', [JobController::class, 'index'])->name('job.get');
Route::get('addJob', [JobController::class, 'add'])->name('addJob');
Route::post('saveJob', [JobController::class, 'saveJob'])->name('saveJob');
Route::any('updateJob/{id}', [JobController::class, 'updateJob'])->name('updateJob');
Route::post('saveUpdateJob/{id}', [JobController::class, 'saveUpdateJob'])->name('saveUpdateJob');
Route::get('showJob/{id}', [JobController::class, 'showJob'])->name('showJob');

Route::get('getEducation', [EducationController::class, 'index'])->name('education.get');
Route::get('addEducation', [EducationController::class, 'add'])->name('addEducation');
Route::post('saveEducation', [EducationController::class, 'saveEducation'])->name('saveEducation');
Route::any('updateEducation/{id}', [EducationController::class, 'updateEducation'])->name('updateEducation');
Route::post('saveUpdateEducation/{id}', [EducationController::class, 'saveUpdateEducation'])->name('saveUpdateEducation');
Route::get('showEducation/{id}', [EducationController::class, 'showEducation'])->name('showEducation');

Route::get('getBodyType', [BodyTypeController::class, 'index'])->name('bodyType.get');
Route::get('addBodyType', [BodyTypeController::class, 'add'])->name('addBodyType');
Route::post('saveBodyType', [BodyTypeController::class, 'saveBodyType'])->name('saveBodyType');
Route::any('updateBodyType/{id}', [BodyTypeController::class, 'updateBodyType'])->name('updateBodyType');
Route::post('saveUpdateBodyType/{id}', [BodyTypeController::class, 'saveUpdateBodyType'])->name('saveUpdateBodyType');
Route::get('showBodyType/{id}', [BodyTypeController::class, 'showBodyType'])->name('showBodyType');

Route::get('getBenefit', [BenefitController::class, 'index'])->name('benefit.get');
Route::get('addBenefit', [BenefitController::class, 'add'])->name('addBenefit');
Route::post('saveBenefit', [BenefitController::class, 'saveBenefit'])->name('saveBenefit');
Route::any('updateBenefit/{id}', [BenefitController::class, 'updateBenefit'])->name('updateBenefit');
Route::post('saveUpdateBenefit/{id}', [BenefitController::class, 'saveUpdateBenefit'])->name('saveUpdateBenefit');
Route::get('showBenefit/{id}', [BenefitController::class, 'showBenefit'])->name('showBenefit');

Route::get('getQualification', [QualificationController::class, 'index'])->name('qualification.get');
Route::get('addQualification', [QualificationController::class, 'add'])->name('addQualification');
Route::post('saveQualification', [QualificationController::class, 'saveQualification'])->name('saveQualification');
Route::any('updateQualification/{id}', [QualificationController::class, 'updateQualification'])->name('updateQualification');
Route::post('saveUpdateQualification/{id}', [QualificationController::class, 'saveUpdateQualification'])->name('saveUpdateQualification');
Route::get('showQualification/{id}', [QualificationController::class, 'showQualification'])->name('showQualification');

Route::get('getQuality', [QualityController::class, 'index'])->name('quality.get');
Route::get('addQuality', [QualityController::class, 'add'])->name('addQuality');
Route::post('saveQuality', [QualityController::class, 'saveQuality'])->name('saveQuality');
Route::any('updateQuality/{id}', [QualityController::class, 'updateQuality'])->name('updateQuality');
Route::post('saveUpdateQuality/{id}', [QualityController::class, 'saveUpdateQuality'])->name('saveUpdateQuality');
Route::get('showQuality/{id}', [QualityController::class, 'showQuality'])->name('showQuality');

Route::get('getNotificationMsg', [NotificationMsgController::class, 'index'])->name('quality.get');
Route::get('addNotificationMsg', [NotificationMsgController::class, 'add'])->name('addNotificationMsg');
Route::post('saveNotificationMsg', [NotificationMsgController::class, 'saveNotificationMsg'])->name('saveNotificationMsg');
Route::any('updateNotificationMsg/{id}', [NotificationMsgController::class, 'updateNotificationMsg'])->name('updateNotificationMsg');
Route::post('saveUpdateNotificationMsg/{id}', [NotificationMsgController::class, 'saveUpdateNotificationMsg'])->name('saveUpdateNotificationMsg');
Route::get('showNotificationMsg/{id}', [NotificationMsgController::class, 'showNotificationMsg'])->name('showNotificationMsg');


Route::get('getFile', [FileController::class, 'index'])->name('file.get');
Route::get('addFile', [FileController::class, 'add'])->name('addFile');
Route::post('saveFile', [FileController::class, 'saveFile'])->name('saveFile');
Route::get('updateFile/{id}', [FileController::class, 'updateFile'])->name('updateFile');
Route::post('saveUpdateFile/{id}', [FileController::class, 'saveUpdateFile'])->name('saveUpdateFile');


Route::get('getLandingBanner', [LandingBannerController::class, 'index'])->name('file.get');
Route::get('addLandingBanner', [LandingBannerController::class, 'add'])->name('add');
Route::post('saveLandingBanner', [LandingBannerController::class, 'savebanner'])->name('savebanner');
Route::get('updateLandingBanner/{id}', [LandingBannerController::class, 'updateBanner'])->name('updateBanner');
Route::post('saveUpdateLandingBanner/{id}', [LandingBannerController::class, 'saveUpdateBanner'])->name('saveUpdateBanner');


Route::get('getPlan', [PlanController::class, 'index'])->name('file.get');
Route::get('addPlan', [PlanController::class, 'add'])->name('add');
Route::post('savePlan', [PlanController::class, 'savePlan'])->name('savePlan');
Route::get('updatePlan/{id}', [PlanController::class, 'updatePlan'])->name('updatePlan');
Route::post('saveUpdatePlan/{id}', [PlanController::class, 'saveUpdatePlan'])->name('saveUpdatePlan');

Route::get('getContactUs', [ContactUsController::class, 'index'])->name('file.get');
Route::get('showContactUs/{id}', [ContactUsController::class, 'showContactUs'])->name('showContactUs');


// Route::get('/', function () {
//     return view('welcome');
// });
