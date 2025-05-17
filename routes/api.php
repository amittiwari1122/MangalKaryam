<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\MasterapiController;
use App\Http\Controllers\Api\RegisterapiController;
use App\Http\Controllers\Api\ExecutiveapiController;
use App\Http\Controllers\Api\CommonapiController;
use App\Http\Controllers\Api\CandidateapiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::post('login', [ApiController::class, 'authenticate']);
Route::post('sendEmail', [MasterapiController::class, 'sendEmail']);
Route::post('generateOtp', [ApiController::class, 'generateOtp']);
Route::post('resendOtp', [ApiController::class, 'postGenerateOtp']);
Route::post('personalDetails', [ApiController::class, 'register']);
Route::post('executive/personalDetails', [ApiController::class, 'exec_register']); //new
Route::post('registerWithMobile', [ApiController::class, 'registerMobile']);
Route::post('checkOtp', [ApiController::class, 'checkOtp']);
Route::post('addMobile', [MasterapiController::class, 'addMobile']);

Route::post('addUser', [MasterapiController::class, 'addUser']);
Route::get('state', [MasterapiController::class, 'getState']);
Route::get('country', [MasterapiController::class, 'getCountry']);
Route::get('gotra', [MasterapiController::class, 'getGotra']);
Route::get('age', [MasterapiController::class, 'getAge']);
Route::get('caste', [MasterapiController::class, 'getCaste']);
Route::get('workType', [MasterapiController::class, 'getWorktype']);
Route::get('profession', [MasterapiController::class, 'getProfession']);
Route::get('subprofession', [MasterapiController::class, 'getSubProfession']);
Route::get('workingas', [MasterapiController::class, 'getWorkingAs']);
Route::get('region', [MasterapiController::class, 'getRegion']);
Route::get('height', [MasterapiController::class, 'getHeight']);
Route::get('weight', [MasterapiController::class, 'getWeight']);
Route::get('dietType', [MasterapiController::class, 'getDiet']);
Route::get('securityQuestion', [MasterapiController::class, 'getSecurity']);
Route::get('maritalStatus', [MasterapiController::class, 'getMaritalstatus']);
Route::get('city', [MasterapiController::class, 'getCity']);
Route::get('skinTone', [MasterapiController::class, 'getSkin']);
Route::get('allergicType', [MasterapiController::class, 'getAllergic']);
Route::get('drinkType', [MasterapiController::class, 'getDrink']);
Route::get('beardType', [MasterapiController::class, 'getBeard']);
Route::get('manglikType', [MasterapiController::class, 'getManglik']);
Route::get('nationality', [MasterapiController::class, 'getNationality']);
Route::get('job', [MasterapiController::class, 'getJob']);
Route::get('education', [MasterapiController::class, 'getEducation']);
Route::get('bodyType', [MasterapiController::class, 'getBodyType']);
Route::get('quality', [MasterapiController::class, 'getQuality']);
Route::post('test', [MasterapiController::class, 'getTest']);

Route::get('qualification', [MasterapiController::class, 'getQualification']);
Route::get('annualIncome', [MasterapiController::class, 'getAnnualIncome']);
Route::get('religion', [MasterapiController::class, 'getReligion']);
Route::get('imageType', [MasterapiController::class, 'getFileType']);
Route::get('aboutUs', [MasterapiController::class, 'getAboutUs']);
Route::get('getHobbies', [MasterapiController::class, 'getHobbies']);
Route::post('contactUs', [MasterapiController::class, 'postContactUs']);
Route::get('district', [MasterapiController::class, 'getDistrict']);
Route::get('executive/getBenefit', [ExecutiveapiController::class, 'getBenefit']);

Route::post('checkOldUserDetails', [RegisterapiController::class, 'oldUserName']);
Route::post('getOldUserSecurityQuestion', [RegisterapiController::class, 'getUserWithSecurityQuestion']);
Route::post('changeNewMobileEmail', [RegisterapiController::class, 'updateMobleEmail']);
Route::post('registerWithSocialMedia', [ApiController::class, 'registerWithSocialMedia']);

Route::get('getPlan', [MasterapiController::class, 'getPlan']);
Route::get('firstThreePages', [MasterapiController::class, 'firstThreePages']);
Route::post('checkOldUser', [RegisterapiController::class, 'oldUserName']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('logout', [ApiController::class, 'logout']);
    Route::get('get_user', [ApiController::class, 'get_user']);
    Route::get('userCheck', [ApiController::class, 'getUserCheck']);

    Route::post('userBasics', [ApiController::class, 'addBasicDetails']);
    Route::post('userContact', [ApiController::class, 'addContactDetails']);
    Route::get('products/{id}', [ProductController::class, 'show']);
    Route::post('create', [ProductController::class, 'store']);
    Route::put('update/{product}',  [ProductController::class, 'update']);
    Route::delete('delete/{product}',  [ProductController::class, 'destroy']);

    Route::get('getProfileQualification', [MasterapiController::class, 'getProfileQualification']);
    Route::get('getProfileOthers', [MasterapiController::class, 'getProfileOthers']);
    Route::get('getProfileAbout', [MasterapiController::class, 'getProfileAbout']);
    Route::get('getAboutMe', [MasterapiController::class, 'getAboutMe']);
    Route::post('updateAbout', [MasterapiController::class, 'updateAbout']);
    Route::post('updateOthers', [MasterapiController::class, 'updateOthers']);
    Route::post('updateQualification', [MasterapiController::class, 'updateQualification']);
    Route::post('updateAboutMe', [MasterapiController::class, 'updateAboutMe']);
    Route::post('uploadProfileImg', [MasterapiController::class, 'profileImage']);
    Route::post('executive/uploadCandidateProfileImg', [MasterapiController::class, 'execforcandiateprofileImage']);

    Route::post('executive/uploadProfileImg', [MasterapiController::class, 'executiveProfileImage']); //new
    Route::post('executive/uploadPanCard', [MasterapiController::class, 'executivePanImage']); //new
    Route::post('executive/uploadAadharCard', [MasterapiController::class, 'executiveAadharImage']); //new
    Route::post('executive/uploadManagmentImage', [MasterapiController::class, 'executiveManagmentImage']); //new
    Route::get('executive/getHomeUploadManagmentImage', [MasterapiController::class, 'getExecutiveManagmentImage']);
    
    Route::get('getBasic', [RegisterapiController::class, 'getBasic']);
    Route::get('getLookingFor', [RegisterapiController::class, 'getLookingFor']);
    Route::get('getContact', [RegisterapiController::class, 'getContact']);
    Route::get('getCareer', [RegisterapiController::class, 'getCareer']);
    Route::get('getFamily', [RegisterapiController::class, 'getFamily']); 
    Route::get('getCurrentLocation', [RegisterapiController::class, 'getCurrentLocation']);
    Route::post('updateBasic', [RegisterapiController::class, 'updateBasic']);
    Route::post('updateLookingFor', [RegisterapiController::class, 'updateLookingFor']);
    Route::post('updateContact', [RegisterapiController::class, 'updateContact']);
    Route::post('updateCareer', [RegisterapiController::class, 'updateCareer']);
    Route::post('updateFamily', [RegisterapiController::class, 'updateFamily']);
    Route::post('updateCurrentLocation', [RegisterapiController::class, 'updateCurrentLocation']);

    Route::get('getAllInformation', [RegisterapiController::class, 'getAllInformation']);
    Route::get('getProfileCompletion', [RegisterapiController::class, 'getProfileCompletion']);
    Route::get('getAllInfoCandidateWise', [RegisterapiController::class, 'getAllInfoCandidateWise']);
    Route::get('getUserHobby', [RegisterapiController::class, 'getUserHobby']);
    Route::post('updateUserHobby', [RegisterapiController::class, 'updateUserHobby']);

    Route::get('executive/getCandidate', [ExecutiveapiController::class, 'getCandidate']);
    Route::get('executive/getLookingFor', [ExecutiveapiController::class, 'getLookingFor']);
    Route::get('executive/getOther', [ExecutiveapiController::class, 'getOther']);
    Route::get('executive/getQualification', [ExecutiveapiController::class, 'getQualification']);
    Route::post('executive/addCandidate', [ExecutiveapiController::class, 'addCandidate']);
    Route::post('executive/addLookingFor', [ExecutiveapiController::class, 'addLookingFor']);
    Route::post('executive/addOther', [ExecutiveapiController::class, 'addOther']);
    Route::post('executive/addQualification', [ExecutiveapiController::class, 'addQualification']);
    Route::post('executive/updateCandidate', [ExecutiveapiController::class, 'updateCandidate']);
    Route::post('executive/updateLookingFor', [ExecutiveapiController::class, 'updateLookingFor']);
    Route::post('executive/updateOther', [ExecutiveapiController::class, 'updateOther']);
    Route::post('executive/updateQualification', [ExecutiveapiController::class, 'updateQualification']);

    Route::get('executive/getAllInformation', [ExecutiveapiController::class, 'getAllInformation']);
    Route::get('executive/getAllcandidate', [ExecutiveapiController::class, 'getAllcandidate']);
    Route::get('executive/getProfile', [ExecutiveapiController::class, 'getExcutiveProfile']);

    Route::get('executive/getManagement', [ExecutiveapiController::class, 'getUserManagement']);
    Route::post('executive/addManagement', [ExecutiveapiController::class, 'addUserManagement']);
    Route::post('executive/updateManagement', [ExecutiveapiController::class, 'updateUserManagement']);

    Route::get('getBenefit', [CommonapiController::class, 'getBenefit']);
    Route::get('getSearch', [CommonapiController::class, 'getSearch']);
    Route::get('getFilter', [CommonapiController::class, 'getFilter']);
    Route::get('like', [CommonapiController::class, 'like']);
    Route::get('dislike', [CommonapiController::class, 'dislike']);
    Route::get('archive', [CommonapiController::class, 'archive']);

    Route::get('getLikedByYou', [CandidateapiController::class, 'getLikedByYou']);
    Route::get('getLikedByOther', [CandidateapiController::class, 'getLikedByOther']);
    Route::get('getDisLikedByYou', [CandidateapiController::class, 'getDisLikedByYou']);
    Route::get('getCurrentlyAdded', [CandidateapiController::class, 'getCurrentlyAdded']);
    Route::get('getNotification', [CommonapiController::class, 'getNotification']);
    Route::get('getNotificationCount', [CommonapiController::class, 'getNotificationCount']);
    Route::get('setNotificationRead', [CommonapiController::class, 'getNotificationRead']);
    Route::get('setRecentVisited', [CandidateapiController::class, 'setRecentVisited']);
    Route::get('getRecentVisitedToYou', [CandidateapiController::class, 'getRecentVisitedToYou']);
    Route::get('getRecentYouVisited', [CandidateapiController::class, 'getRecentYouVisited']);
    Route::get('getArchive', [CandidateapiController::class, 'getArchiveByYou']);
    Route::get('setArchiveDelete', [CandidateapiController::class, 'setArchiveDelete']);
    Route::post('setArchiveDeleteAll', [CandidateapiController::class, 'setArchiveDeleteAll']);

    Route::get('getTodayMatch', [CandidateapiController::class, 'getTodayMatch']);
    Route::get('getMyMatch', [CandidateapiController::class, 'getMayMatch']);
    Route::get('executive/getExecutiveWiseUserMatch', [ExecutiveapiController::class, 'getExecutiveWiseUserMatch']);
    Route::get('getNearYou', [CandidateapiController::class, 'getNearYou']);
    Route::get('getReferCode', [CandidateapiController::class, 'getReferCode']);
    Route::post('selectLang', [MasterapiController::class, 'setUserLang']);
    Route::post('addUserWiseSecurityQuestion', [CommonapiController::class, 'addUserWiseSecurityQuestion']);
    Route::get('getCountAll', [CandidateapiController::class, 'getCountAll']); 

    Route::get('executive/getCountAll', [ExecutiveapiController::class, 'getCountAll']);
    Route::get('executive/getNearYou', [ExecutiveapiController::class, 'getNearYou']);
    Route::get('executive/getMyMatch', [ExecutiveapiController::class, 'getMyMatch']);
    Route::get('executive/getByCaste', [ExecutiveapiController::class, 'getByCaste']);

    Route::get('getExecutiveUser', [CandidateapiController::class, 'getExecutiveUsers']);
    Route::get('setArchiveRevert', [CandidateapiController::class, 'setArchiveRevert']);
    Route::get('setStarUser', [CandidateapiController::class, 'setStarUser']);
    Route::get('getStarByYou', [CandidateapiController::class, 'getStarByYou']);
    Route::get('getMatchCandidate', [CandidateapiController::class, 'getMatchCandidate']);
    Route::get('getUserMatchCandidate', [CandidateapiController::class, 'getUserMatchCandidate']);
    Route::get('executive/getUserLookingFor', [ExecutiveapiController::class, 'getUserLookingFor']);
    Route::get('executive/dashboard', [ExecutiveapiController::class, 'dashboard']);

    Route::get('getReferByAgent', [CandidateapiController::class, 'getReferByAgent']);
    Route::get('executive/getReferUser', [ExecutiveapiController::class, 'getReferUser']);
    Route::post('executive/addMatchmaking', [ExecutiveapiController::class, 'addMatchmaking']);
    Route::post('verifyMobile', [CandidateapiController::class, 'verifyMobile']);
    Route::post('recommenedForYou', [CommonapiController::class, 'recommenedForYou']);

    Route::post('setBlur', [CommonapiController::class, 'setBlur']);
    Route::post('setPreferCommunication', [CommonapiController::class, 'setPreferCommuni']);
    Route::post('setUserRequestContact', [CommonapiController::class, 'setUserRequestContact']);
    Route::post('setOnlineOffline', [CommonapiController::class, 'setOnlineOffline']);
    Route::get('getUserImageGallery', [CommonapiController::class, 'getUserImageGallery']);
    Route::post('setMyPrefer', [CommonapiController::class, 'setMyPrefer']);

    Route::post('addUserMatching', [CandidateapiController::class, 'addUserMatching']);
    Route::get('getUserMatching', [CandidateapiController::class, 'getUserMatching']);
    Route::post('userDeactivate', [CandidateapiController::class, 'userDeactivate']);

    Route::post('executive/updateProfile', [ExecutiveapiController::class, 'updateExcutiveProfile']);
    Route::get('getFinalUsersMatch', [CandidateapiController::class, 'getUserMatchData']);
    Route::get('getDataMatchKundali', [CandidateapiController::class, 'getDataMatchKundali']);

    Route::post('executive/updateAboutMe', [ExecutiveapiController::class, 'updateAboutMe']);
    Route::get('executive/getAboutMe', [ExecutiveapiController::class, 'getAboutMe']);
    Route::get('executive/getFilter', [CommonapiController::class, 'getFilter']);
    Route::post('executive/addPost', [ExecutiveapiController::class, 'addPost']);
    Route::get('executive/getPost', [ExecutiveapiController::class, 'getPost']);
    Route::post('executive/addPostLike', [ExecutiveapiController::class, 'addPostLike']);
    //Route::post('executive/addPostDisLike', [ExecutiveapiController::class, 'addPostDisLike']);
    Route::post('executive/addReview', [ExecutiveapiController::class, 'addReview']);
    Route::get('executive/getReview', [ExecutiveapiController::class, 'getReview']);
    Route::post('executive/addReviewComment', [ExecutiveapiController::class, 'addReviewComment']);
    Route::post('executive/addPostComment', [ExecutiveapiController::class, 'addPostComment']);
    Route::get('executive/getPostComment', [ExecutiveapiController::class, 'getPostComment']);
    Route::post('setCoverImageDefault', [CommonapiController::class, 'setCoverImageDefault']);
    Route::post('deleteCoverImage', [CommonapiController::class, 'deleteCoverImage']);
    Route::post('feedbackForm', [MasterapiController::class, 'feedbackForm']);
    Route::post('executive/movetofinal', [ExecutiveapiController::class, 'movetofinal']);
    Route::post('executive/profileVerify', [ExecutiveapiController::class, 'profileVerify']);
    Route::post('executive/userPreferences', [ExecutiveapiController::class, 'userPreferences']);
    Route::get('executive/getMoveToFinal', [ExecutiveapiController::class, 'getMoveToFinal']);
    Route::post('executive/deletefinal', [ExecutiveapiController::class, 'deletefinal']);
    Route::post('executive/getLikedByPerson', [ExecutiveapiController::class, 'getLikedByPerson']);
    
    Route::get('executive/getMatchMakingByOther', [ExecutiveapiController::class, 'getMatchMakingByOther']);
    Route::get('executive/getMatchByMangal', [ExecutiveapiController::class, 'getMatchByMangal']);
    Route::get('executive/getLikedByUserExecutive', [ExecutiveapiController::class, 'getLikedByUserExecutive']);
    Route::get('executive/getInProgressInExecutive', [ExecutiveapiController::class, 'getInProgressInExecutive']);
    Route::post('executive/uploadPortfolioImg', [MasterapiController::class, 'uploadPortfolioImg']);
    Route::Post('executive/userFollow', [ExecutiveapiController::class, 'userFollow']);
    Route::get('executive/getPortfolioImg', [ExecutiveapiController::class, 'getPortfolioImg']);
    Route::get('bannerMeeting', [MasterapiController::class, 'bannerMeeting']);

    Route::get('getExecutiveList', [CandidateapiController::class, 'getExecutiveList']);
    Route::get('getExecutiveDetailUserSide', [CandidateapiController::class, 'getExecutiveDetailUserSide']);
    Route::get('getSocialCount', [CandidateapiController::class, 'getSocialCount']);
    Route::get('getMatchDetails', [CandidateapiController::class, 'getMatchDetails']);
    Route::Post('userSubscribe', [CandidateapiController::class, 'userSubscribe']);
    Route::get('getUserSubscribe', [CandidateapiController::class, 'getUserSubscribe']);
    Route::get('getRecommenedForYou', [CommonapiController::class, 'getRecommenedForYou']);
    Route::post('paymentUpdate', [CommonapiController::class, 'paymentUpdate']);
    Route::post('addKundaliData', [MasterapiController::class, 'kundaliData']);
    Route::get('getKundaliData', [MasterapiController::class, 'getKundaliData']);
    Route::post('sendNotification', [MasterapiController::class, 'sendNotification']);
    Route::get('getExecutiveUsersPlus', [CandidateapiController::class, 'getExecutiveUsersPlus']);
    Route::get('executive/getUserImageGallery', [ExecutiveapiController::class, 'getUserImageGallery']);
    Route::get('executive/getCurrentLocation', [ExecutiveapiController::class, 'getCurrentLocation']);
    Route::post('executive/updateCurrentLocation', [ExecutiveapiController::class, 'updateCurrentLocation']);

    Route::post('getMatchingOccupation', [CandidateapiController::class, 'getMatchingOccupation']);
    Route::post('getMatchingCaste', [CandidateapiController::class, 'getMatchingCaste']);
    Route::post('getMatchingFoodHabits', [CandidateapiController::class, 'getMatchingFoodHabits']);
});
