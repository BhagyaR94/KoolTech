<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'
 */
Route::get('/', 'FrontendController@index')->name('index');
Route::get('macros', 'FrontendController@macros')->name('macros');

//begin of invoice routes
Route::get('invoices', 'Invoices\InvoiceController@invoices');

Route::post('modifyinvoice', 'Invoices\InvoiceController@feed_records');

Route::post('clearinvoice', 'Invoices\InvoiceController@drop_records');

Route::post('saveinvoice', 'Invoices\InvoiceController@save_records');

Route::get('getsih/{code}', 'Invoices\InvoiceController@getsih');

Route::get('printin', 'Invoices\InvoiceController@print_invoice');

Route::get('cancelinvoice', 'Invoices\CancelInvoiceController@cancelinvoice');

Route::get('getinvoice/{code}/{code2}', 'Invoices\CancelInvoiceController@getInvoiceData');

Route::post('cancelinv', 'Invoices\CancelInvoiceController@savecancel');

//end of invoice routes


//begin of customer routes
Route::get('searchcustomer/{customercode}', 'Customers\CustomerController@search_customer');

Route::get('newcustomer', 'Customers\CustomerController@customer');

Route::post('addnewcustomer', 'Customers\CustomerController@addnewcustomer');

Route::get('getcustomer/{code}', 'Customers\CustomerController@getcustomer');

Route::post('upcustomer', 'Customers\CustomerController@updatecustomer');
//end of customer routes
//begin of quotation routes
Route::get('newquotation', 'Quotations\QuotationController@newquotation');

Route::post('addquotation', 'Quotations\QuotationController@addquotation');

Route::post('clearqt', 'Quotations\QuotationController@dropqtitem');
//end of quotation routes
//begin of receipt routes
Route::get('newreceipt', 'Receipts\ReceiptController@newreceipt');



Route::post('savereceipt', 'Receipts\ReceiptController@savereceipt');
//end of receipt routes
//begin of returnedcheques routes


Route::get('returnedcheques', 'ReturnedCheques\ReturnedChequesController@returnedcheques');

Route::get('returnedchequedetails/{code}', 'ReturnedCheques\ReturnedChequesController@getreturnedcheqedetails');

Route::post('reportchequesave', 'ReturnedCheques\ReturnedChequesController@reportchequesave');

//end of returnedcheques routes

//begin of credit settlement routes

Route::get('creditsettlement','CreditSet\CreditSetController@creditset');

Route::get('getcusname/{code}','CreditSet\CreditSetController@getcusname');

Route::get('getreceiptdata/{code}','CreditSet\CreditSetController@getreceiptdata');

//end of credit settlement routes


//begin of goods routes
Route::get('goodsreceived','Goods\GoodsReceivedController@goodsreceived');

Route::get('getproduct/{code}','Goods\GoodsReceivedController@getproduct');

Route::get('getsupplier/{code}','Goods\GoodsReceivedController@getsupplier');

Route::post('receivegood','Goods\GoodsReceivedController@receivegood');

Route::post('cleareceive','Goods\GoodsReceivedController@cleareceive');

Route::get('savereceived/{code}','Goods\GoodsReceivedController@savereceived');

Route::post('savereceivedgoods','Goods\GoodsReceivedController@savereceivedgoods');



Route::get('goodsreturn','Goods\GoodsReturnController@goodsreturn');

Route::post('returngood','Goods\GoodsReturnController@returngood');

Route::post('cleareturn','Goods\GoodsReturnController@cleareturn');

Route::get('savereturn/{code}','Goods\GoodsReturnController@savereturn');

Route::post('savereturngoods','Goods\GoodsReturnController@savereturngoods');



//end of goods routes

/**
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function() {
        /**
         * User Dashboard Specific
         */
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        /**
         * User Account Specific
         */
        Route::get('account', 'AccountController@index')->name('account');

        /**
         * User Profile Specific
         */
        Route::patch('profile/update', 'ProfileController@update')->name('profile.update');
    });
});
