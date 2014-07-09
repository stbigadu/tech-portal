<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Module Users
 * @namespace T4KControllers\Users
 */
Route::group(array('prefix' => 'users'), function()
{
    // Login screen.
    Route::any('login',         array('as' => 'portal.users.login',         'uses' => 'T4KControllers\Users\UsersController@login'));
    Route::any('connection',    array('as' => 'portal.users.connection',    'uses' => 'T4KControllers\Users\UsersController@connection'));

    // Initial administrator setup page
    Route::any('setup',         array('as' => 'portal.users.setup',         'uses' => 'T4KControllers\Users\UsersController@setup'));
    Route::any('setup/install', array('as' => 'portal.users.install',       'uses' => 'T4KControllers\Users\UsersController@install'));

    // Logout screen.
    Route::any('logout',        array('as' => 'portal.users.logout',        'uses' => 'T4KControllers\Users\UsersController@logout'));
});

Route::group(array('before' => 'auth'), function()
{
    
    /**
     * Module Dashboard
     * @namespace T4KControllers\Dashboard
     */
    Route::any('/',             array('as' => 'portal.dashboard.index',     'uses' => 'T4KControllers\Dashboard\DashboardController@index'));
    Route::any('dashboard',     array('as' => 'portal.dashboard.index',     'uses' => 'T4KControllers\Dashboard\DashboardController@index'));
    
    /**
     * Module User
     * @namespace T4KControllers\Users
     */
    
});
