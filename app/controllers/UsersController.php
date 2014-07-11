<?php

/**
 * T4KControllers\Users\UsersController class
 * @author minhnhatbui
 * @copyright 2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract View Controller managing users.
 */

namespace T4KControllers\Users;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UsersController extends \BaseController { 
    
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
	public function connection()
	{
	    if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))) 
	    {
	        return Redirect::route('portal.dashboard.index')->with('message', 'Connexion réussie.');
	    } 
	    else 
	    {
	        return Redirect::route('portal.users.login')->with('message', 'Le nom d\'utilisateur ou le mot de passe est incorrect. Veuillez réessayer à nouveau.')->withInput();
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
	 * Show the view displaying all users from the admin panel.
	 * @return View Response
	 */
	public function users()
	{
	    // Retrieve all news
	    $users = \T4KModels\User::
	         orderBy('last_name', 'asc')
	       ->orderBy('first_name', 'asc')
	       ->paginate($this->ItemsPerPage);
	    	    
	    // Array of data to send to view
	    $data = array(
	            'users'            => $users,
	            'TotalCount'       => \T4KModels\User::count(),
	            'activeScreen'     => 'UsersIndex'
	    );
	    
	    // Render view
	    $this->layout->content = \View::make('users.index', $data);
	}
	
	/**
	 * Show the user's dashboard screen if user is logged in.
	 * @return View Response
	 */
	public function profile()
	{
	    // Array of data to send to view
	    $data = array(
	            'activeScreen'     => 'MonCompteIndex'
	    );
	     
	    // Render view
	    $this->layout->content = \View::make('users.moncompte', $data);
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
