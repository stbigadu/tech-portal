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
    Route::any('connecting',    array('as' => 'portal.users.connecting',    'uses' => 'T4KControllers\Users\UsersController@connecting'));
    
    // Password reset
    Route::any('oubli',         array('as' => 'portal.users.getremind',     'uses' => 'T4KControllers\Users\RemindersController@getRemind'));
    Route::any('oubli/post',    array('as' => 'portal.users.postremind',    'uses' => 'T4KControllers\Users\RemindersController@postRemind'));
    Route::any('reset/{token}', array('as' => 'portal.users.getreset',      'uses' => 'T4KControllers\Users\RemindersController@getReset'));
    Route::any('save',          array('as' => 'portal.users.postreset',     'uses' => 'T4KControllers\Users\RemindersController@postReset'));

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
     * Module Events
     * @namespace T4KControllers\Events
     */
    Route::group(array('prefix' => 'calendrier'), function()
    {
        Route::any('/',                     array('as' => 'portal.events.index',        'uses' => 'T4KControllers\Events\EventsController@upcoming'));
        Route::any('avenir/{id?}',          array('as' => 'portal.events.upcoming',     'uses' => 'T4KControllers\Events\EventsController@upcoming'));
        Route::any('anterieur/{id?}',       array('as' => 'portal.events.past',         'uses' => 'T4KControllers\Events\EventsController@past'));
        Route::any('ajouter',               array('as' => 'portal.events.create',       'uses' => 'T4KControllers\Events\EventsController@create'));
        Route::any('ajouter/save',          array('as' => 'portal.events.store',        'uses' => 'T4KControllers\Events\EventsController@store'));  
        Route::any('modifier/{id}',         array('as' => 'portal.events.edit',         'uses' => 'T4KControllers\Events\EventsController@edit'));
        Route::any('modifier/save/{id}',    array('as' => 'portal.events.update',       'uses' => 'T4KControllers\Events\EventsController@update'));
        Route::any('supprimer/{id}',        array('as' => 'portal.events.destroy',      'uses' => 'T4KControllers\Events\EventsController@destroy'));
        Route::any('confirm/',              array('as' => 'portal.events.confirm',      'uses' => 'T4KControllers\Events\EventsController@confirm'));
    });
    
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
    
    /**
     * Module Documents
     * @namespace T4KControllers\Documents
     */
    Route::group(array('prefix' => 'documents'), function()
    {
        Route::any('/',                     array('as' => 'portal.docs.index',          'uses' => 'T4KControllers\Documents\DocumentsController@index'));
        Route::any('ajouter',               array('as' => 'portal.docs.create',         'uses' => 'T4KControllers\Documents\DocumentsController@create'));
        Route::any('ajouter/save',          array('as' => 'portal.docs.store',          'uses' => 'T4KControllers\Documents\DocumentsController@store'));
        Route::any('modifier/{id}',         array('as' => 'portal.docs.edit',           'uses' => 'T4KControllers\Documents\DocumentsController@edit'));
        Route::any('modifier/save/{id}',    array('as' => 'portal.docs.update',         'uses' => 'T4KControllers\Documents\DocumentsController@update'));
        Route::any('supprimer/{id}',        array('as' => 'portal.docs.destroy',        'uses' => 'T4KControllers\Documents\DocumentsController@destroy'));
    });
    
    /**
     * Module Horaire
     * @namespace T4KControllers\Horaire
     */
    Route::group(array('prefix' => 'horaire'), function()
    {
        Route::any('/',                     array('as' => 'portal.horaire.index',       'uses' => 'T4KControllers\Horaire\HoraireController@index'));
    });
    
    /**
     * Module Users
     * @namespace T4KControllers\Users
     */
    Route::group(array('prefix' => 'users'), function()
    {
        Route::any('/',                     array('as' => 'portal.users.index',             'uses' => 'T4KControllers\Users\UsersController@index'));
        Route::any('profile',               array('as' => 'portal.users.profile',           'uses' => 'T4KControllers\Users\UsersController@profile'));
        Route::any('export',                array('as' => 'portal.users.export',            'uses' => 'T4KControllers\Users\UsersController@export'));
        Route::any('modifier/password',     array('as' => 'portal.users.edit.password',     'uses' => 'T4KControllers\Users\UsersController@edit_password'));
        Route::any('modifier/infos',        array('as' => 'portal.users.edit.info',         'uses' => 'T4KControllers\Users\UsersController@edit_info'));
        Route::any('save/password',         array('as' => 'portal.users.update.password',   'uses' => 'T4KControllers\Users\UsersController@update_password'));
        Route::any('save/infos',            array('as' => 'portal.users.update.info',       'uses' => 'T4KControllers\Users\UsersController@update_info'));
    });
    
});
