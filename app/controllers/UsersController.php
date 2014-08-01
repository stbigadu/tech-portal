<?php

namespace T4KControllers\Users;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

/**
 * T4KControllers\Users\UsersController class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    View Controller managing users login, logout, and users section on the portal, i.e.
 *              user's profile, list of users, etc.
 */

class UsersController extends \BaseController 
{ 
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->beforeFilter('csrf', array('on'=>'post'));
    }
    
    /**
     * Show the login screen.
     * @return View Response
     */
	public function login()
	{
	    $this->layout->content = \View::make('users.login');
	}
	
	/**
	 * Verify the login credentials.
	 * @return Redirect Response
	 */
	public function connecting()
	{
	    if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))) 
	    {
	        return Redirect::intended('/');
	    } 
	    else 
	    {
	        return Redirect::route('portal.users.login')->with('authenticated', false)->withInput();
	    }
	}
	
	/**
	 * Handle logout requests.
	 * @return Redirect Response
	 */
	public function logout()
	{
	    Auth::logout();
	    return Redirect::route('portal.users.login');
	}
	
	/**
	 * Show the view displaying all users.
	 * @return View Response
	 */
	public function index()
	{
	    // Retrieve all users
        $users = \T4KModels\User::orderBy('last_name', 'asc')->orderBy('first_name', 'asc')->get();
	    	    
	    // Array of data to send to view
	    $data = array(
	            'users'            => $users,
	            'ItemsCount'       => \T4KModels\User::count(),
	            'currentRoute'     => \Route::currentRouteName(),
	            'activeScreen'     => 'UsersIndex'
	    );
	    
	    // Render view
	    $this->layout->content = \View::make('users.index', $data);
	}
	
	/**
	 * Export list of users for printing.
	 * @return View Response
	 */
	public function export()
	{
	    // Retrieve all users
        $users = \T4KModels\User::orderBy('last_name', 'asc')->orderBy('first_name', 'asc')->get();
        
        // Array of data to send to view
        $data = array(
                'users'            => $users,
                'ItemsCount'       => \T4KModels\User::count(),
                'currentRoute'     => \Route::currentRouteName(),
                'activeScreen'     => 'UsersIndex'
        );
         
        // Render view
        $this->layout->content = \View::make('users.export', $data);
	}
	
	/**
	 * Show the user's profile screen if user is logged in.
	 * @return View Response
	 */
	public function profile()
	{
	    // Retrieve current user
	    $user = \T4KModels\User::find(Auth::user()->id);
	    
	    // Array of data to send to view
	    $data = array(
	            'user'             => $user,
	            'currentRoute'     => \Route::currentRouteName(),
	            'activeScreen'     => 'ProfileIndex'
	    );
	     
	    // Render view
	    $this->layout->content = \View::make('users.moncompte', $data);
	}
	
	/**
	 * Edit user password.
	 * @return View Response
	 */
	public function edit_password()
	{
	    // Array of data to send to view
	    $data = array(
	            'currentRoute'     => \Route::currentRouteName(),
	            'activeScreen'     => 'ProfileIndex'
	    );
	    
	    // Render view
	    $this->layout->content = \View::make('users.edit-password', $data);
	}
	
	/**
	 * Edit user info.
	 * @return View Response
	 */
	public function edit_info()
	{
	    // Array of data to send to view
	    $data = array(
	            'currentRoute'     => \Route::currentRouteName(),
	            'activeScreen'     => 'ProfileIndex'
	    );
	     
	    // Render view
	    $this->layout->content = \View::make('users.edit-info', $data);
	}
	
	/**
	 * Update user password.
	 * @return View Response
	 */
	public function update_password()
	{
        // Validation rules
        $rules = array(
                'old_password'              => 'required|passcheck',
                'new_password'              => 'required|confirmed|between:6,25',
        );
        $messages = array(
                'old_password.required'     => 'Le mot de passe actuel est requis.',
                'new_password.required'     => 'Veuillez entrer un nouveau mot de passe.',
                'new_password.between'      => 'Le nouveau mot de passe doit contenir entre :min et :max caractères.',
                'new_password.confirmed'    => 'Le nouveau mot de passe a été mal indiqué. Veuillez essayer à nouveau.',
                'passcheck'                 => 'Le mot de passe actuel n\'est pas valide.'
        );
        // Password validation
        Validator::extend('passcheck', function ($attribute, $value, $parameters)
        {
            return Hash::check($value, Auth::user()->getAuthPassword());
        });
        
	    $validator = Validator::make(Input::all(), $rules, $messages);
	
	    // Validator check
	    if ($validator->fails())
	    {
	        // Throw error and redirect to previous screen
	        return Redirect::route('portal.users.edit.password')->withErrors($validator)->withInput();
	    }
	    else
	    {
	        // Update user information
	        $user = \T4KModels\User::find(Auth::user()->id);
	        $user->password = Hash::make(Input::get('new_password'));
	        $user->save();
	
	        // Redirect to view screen with success message
	        Session::flash('update_password', true);
            return Redirect::route('portal.users.profile');
	    }
	}
	
	/**
	 * Update user info.
	 * @return View Response
	 */
	public function update_info()
	{
        // Update user information
        $user = \T4KModels\User::find(Auth::user()->id);
        if (Auth::user()->is_mentor || Auth::user()->is_junior_mentor) $user->professional_title = Input::get('professional_title');
        $user->email            = Input::get('email');
        $user->cellphone_number = Input::get('cellphone_number');
        $user->home_number_1    = Input::get('home_number_1');
        $user->home_number_2    = Input::get('home_number_2');
        $user->other_number     = Input::get('other_number');
        $user->save();
    
        // Redirect to view screen with success message
        Session::flash('update_info', true);
        return Redirect::route('portal.users.profile');
	}

	/**
	 * Initial administrator setup screen.
	 * @return View Response
	 */
	public function setup()
	{
	    $this->layout->content = \View::make('users.admin-setup');
	}
	
	/**
	 * Initial administrator install screen.
	 * @return Redirect Response
	 */
	public function install()
	{
	    $validator = Validator::make(Input::all(), \T4KModels\User::$rulesInitialSetup, \T4KModels\User::$msgInitialSetup);
	
	    if ($validator->passes())
	    {
	        // Create initial admin user
	        $user = new \T4KModels\User();
	        $user->email = Input::get('email');
	        $user->password = Hash::make(Input::get('password'));
	        $user->is_first_connection = 1;
	        $user->is_admin = 1;
	        $user->save();
	
	        // Redirect to login screen
	        return Redirect::route('portal.users.login')->with('message', 'Compte administrateur initial créé avec succès.');
	    }
	    else
	    {
	        // Setup has failed; showing error
	        return Redirect::route('portal.users.setup')->with('message', 'Erreurs:')->withErrors($validator)->withInput();
	    }
	}

}
