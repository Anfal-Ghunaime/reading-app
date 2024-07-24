<?php

use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\Authentication\ResetPasswordController;
use App\Http\Controllers\Authentication\SocialiteController;
use App\Http\Controllers\Cafes\BookController;
use App\Http\Controllers\Cafes\CafeController;
use App\Http\Controllers\Communications\ContactUsController;
use App\Http\Controllers\Communications\FeedbackController;
use App\Http\Controllers\Communications\RatingController;
use App\Http\Controllers\Users\FavouriteController;
use App\Http\Controllers\Users\MasterAdminController;
use App\Http\Controllers\Users\ProfileController;
use App\Http\Controllers\Users\ProgressController;
use App\Http\Controllers\Users\QuotebookController;
use App\Http\Controllers\Users\QuotesController;
use App\Http\Controllers\Users\ReadLaterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//send a verification code
Route::post('verifyCode', [AuthController::class, 'sendVerifyCode']);
//check if the verification code is valid
Route::post('checkVerify', [AuthController::class, 'checkVerifyCode']);
//register
Route::post('register', [AuthController::class, 'register']);
//login
Route::post('login', [AuthController::class, 'login']);

//send a reset code to the email
Route::post('forgotCode', [ResetPasswordController::class, 'sendForgotPasswordCode']);
//check if the reset code is valid
Route::post('checkReset', [ResetPasswordController::class, 'checkForgotPasswordCode']);
//update the password
Route::post('newPass', [ResetPasswordController::class, 'newPassword']);

//Route::post('requestToken', [SocialiteController::class, 'requestToken']);
//Route::post('requestTokenGoogle', [SocialiteController::class, 'requestTokenGoogle']);

//get the books list for user
Route::get('allBooks', [BookController::class, 'listAllBooks']);
//get book details by book id
Route::get('bookDetails/{book_id}', [BookController::class, 'bookDetails']);
//get all shelf book
Route::get('shelfBooks/{shelf_id}', [BookController::class, 'allShelfBooks']);
//get book file
Route::get('getBook/{book_id}',[BookController::class, 'getBookFile']);

//get all cafes list
Route::get('allCafe', [CafeController::class, 'listAllCafes']);
//get all cafe's shelves
Route::get('cafeShelves/{cafe_id}', [CafeController::class, 'cafeShelves']);
//get all shelves list
Route::get('allShelves', [CafeController::class, 'listAllShelves']);

//to use the apis in this group you need to send a bearer token!
Route::middleware('auth:sanctum')->group(function (){
    //logout
    Route::get('logout', [AuthController::class, 'logout']);

    //update the password when enter the old password
    Route::post('resetPassword', [ResetPasswordController::class, 'resetPassword']);

    //add new book according to role
    Route::post('addBook', [BookController::class, 'addBook']);

    //update profile info
    Route::post('updateProfile', [ProfileController::class, 'updateProfile']);
    //get all profile info
    Route::get('profile', [ProfileController::class, 'getProfile']);

    //like or dislike a feedback
    Route::get('like/{what_to_do}/{feedback_id}', [FeedbackController::class, 'like']);
    //check if this feedback has like
    Route::get('likeCheck/{feedback_id}', [FeedbackController::class, 'checkIfHasLike']);

    //add book to read later list
    Route::get('readLater/{book_id}/{priority}', [ReadLaterController::class, 'readLater']);
    //my read later list
    Route::get('myRLL/{order}', [ReadLaterController::class, 'myReadLater']);

    //book progress
    Route::post('progress/{book_id}', [ProgressController::class, 'progress']);
    //my read history list
    Route::get('myRH', [ProgressController::class, 'myRH']);
    //manually add a book to read history
    Route::post('addToBh/{book_id}', [ProgressController::class, 'addToHistory']);
    //my read list
    Route::get('myRL', [ProgressController::class, 'myRL']);

    //only user can do these actions
    Route::middleware('user')->group(function (){
        //rate or update book rate
        Route::get('rate/{book_id}/{stars}', [RatingController::class, 'rate']);

        //add feedback
        Route::post('feedback/{book_id}', [FeedbackController::class, 'feedback']);
        //edit or delete feedback
        Route::post('editFeed/{what_to_do}/{feedback_id}', [FeedbackController::class, 'editOrDeleteFeedback']);

        //add book to favorite
        Route::get('addToFav/{book_id}', [FavouriteController::class, 'addToFav']);
        //check if book is in favorite
        Route::get('fav/check/{book_id}', [FavouriteController::class, 'checkIfInFav']);
        //get favourite books list
        Route::get('myFav', [FavouriteController::class, 'myFavourite']);

        //contact us
        Route::post('contact', [ContactUsController::class, 'contact_us']);

        //get user's recommendations
        Route::get('recommend', [BookController::class, 'recommendations']);
        //get list of book existing list in user lists
        Route::get('bookL/{book_id}', [BookController::class, 'bookInUserLists']);

        //add a quote
        Route::post('quote', [QuotesController::class, 'addQuote']);
        //add or remove quote from fav action
        Route::get('favQuote/{quote_id}', [QuotesController::class, 'favOrNot']);
        //delete a quote
        Route::delete('deleteQuote/{quote_id}', [QuotesController::class, 'deleteQuote']);
        //get my quotes list
        Route::get('myQL', [QuotesController::class, 'myQuotesList']);
        //update quote info
        Route::post('updateQuote/{quote_id}', [QuotesController::class, 'updateQuote']);

        //create new quotebook
        Route::post('newQuotebook', [QuotebookController::class, 'newQuotebook']);
        //add quote to quotebook
        Route::get('addToQb/{quote_id}/{quotebook_id}', [QuotebookController::class, 'addToQuotebook']);
        //delete quotebook :
            //either with it's all quotes
            //or just delete it!
        Route::delete('deleteQb/{what_to_do}/{quotebook_id}', [QuotebookController::class, 'deleteQuotebook']);
        //get quotebook quote list
        Route::get('quotebookQL/{quotebook_id}', [QuotebookController::class, 'quotebookQuotes']);
        //my quotebooks list
        Route::get('myQbs', [QuotebookController::class, 'myQuotebooks']);
        //remove quotes from quotebook
        Route::post('removeQb/{quotebook_id}', [QuotebookController::class , 'removeFromQb']);
        //update quotebook info
        Route::post('updateQb/{quotebook_id}', [QuotebookController::class , 'updateQb']);
    });

    //only master admin can access this api group!
    Route::middleware('master_admin')->group(function (){
        //create account for new admin
        Route::post('addAdmin', [MasterAdminController::class, 'addAdmin']);
        //delete admin
        Route::delete('removeAdmin/{admin_id}', [MasterAdminController::class, 'deleteAdmin']);
        //get Admins list
        Route::get('adminsList', [MasterAdminController::class, 'getAdminsList']);
    });

    //only admin or master admin can access this api group!
    Route::middleware('admin')->group(function (){
        //update book info
        Route::post('updateBook/{book_id}', [BookController::class, 'updateBook']);
        //delete book
        Route::delete('deleteBook/{book_id}', [BookController::class, 'deleteBook']);
        //accept or delete book add request
        Route::get('approve/{book_id}/{what_to_do}', [BookController::class, 'editApproved']);
        //get books request list
        Route::get('requestL', [BookController::class, 'requestList']);

        //reply contact
        Route::post('replyContact/{contact_id}', [ContactUsController::class, 'reply']);
    });
});
