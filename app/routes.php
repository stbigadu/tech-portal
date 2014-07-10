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
    
    /**
     * Module Nouvelles
     * @namespace T4KControllers\Nouvelles
     */
    Route::group(array('prefix' => 'nouvelles'), function()
    {
        Route::any('/',                     array('as' => 'portal.nouvelles.index',     'uses' => 'T4KControllers\Nouvelles\NouvellesController@index'));
        Route::any('afficher/{id}',         array('as' => 'portal.nouvelles.view',      'uses' => 'T4KControllers\Nouvelles\NouvellesController@view'));
        Route::any('ajouter',               array('as' => 'portal.nouvelles.create',    'uses' => 'T4KControllers\Nouvelles\NouvellesController@create'));
        Route::any('ajouter/save',          array('as' => 'portal.nouvelles.store',     'uses' => 'T4KControllers\Nouvelles\NouvellesController@store'));  
        Route::any('modifier/{id}',         array('as' => 'portal.nouvelles.edit',      'uses' => 'T4KControllers\Nouvelles\NouvellesController@edit'));
        Route::any('modifier/save/{id}',    array('as' => 'portal.nouvelles.update',    'uses' => 'T4KControllers\Nouvelles\NouvellesController@update'));
        Route::any('supprimer/{id}',        array('as' => 'portal.nouvelles.destroy',   'uses' => 'T4KControllers\Nouvelles\NouvellesController@destroy'));
    });
    
});