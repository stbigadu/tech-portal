<?php

namespace T4KControllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

/**
 * T4KControllers\Admin\AdminController class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    View Controller for the Admin model.
 */

class UsersController extends \BaseController { 
    
    /**
     * Constructor.
     */
    public function __construct() {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth');
        setlocale(LC_ALL, 'fr_CA.UTF-8');
    }
    
    /**
     * Display all current and upcoming events items.
     * @param int $id = null
     * @return View Response
     */
	public function index()
	{
	    // Retrieve all users
        $users = \T4KModels\User::orderBy('last_name', 'asc')->orderBy('first_name', 'asc')->get();
	    	    
	    // Array of data to send to view
	    $data = array(
                'users'             => $users,
                'ItemsCount'        => \T4KModels\User::count(),
                'currentRoute'      => \Route::currentRouteName(),
                'activeScreen'      => 'AdminIndex'
	    );
	    
	    // Render view
	    $this->layout->content = \View::make('admin.users.index', $data);
	}
	
	/**
	 * Create a event item.
	 * @return View Response
	 */
	public function create()
	{
	    // Retrieve all user roles
	    $roles = \T4KModels\UserRole::get();
	    
	    // Build array for roles categories
	    $roles_select = array();
	    foreach ($roles as $role)
	    {
	        $roles_select[$role->id] = $role->title;
	    }
	    
	    // Array of data to send to view
	    $data = array(
                'roles'             => $roles,
                'roles_select'      => $roles_select,
                'currentRoute'      => \Route::currentRouteName(),
                'activeScreen'      => 'AdminIndex'
	    );
	     
	    // Render view
	    $this->layout->content = \View::make('admin.users.form', $data);
	}
	
	/**
	 * Post the new event item in DB.
	 * @return Response
	 */
	public function store()
	{
	    // Validation rules
	    $validator = Validator::make(Input::all(), \T4KModels\User::$rulesCreateUser, \T4KModels\User::$msgCreateUser);
	
	    // Validator check
	    if ($validator->fails())
	    {
	        // Throw error and redirect to previous screen
	        return Redirect::route('portal.admin.users.create')->withErrors($validator)->withInput();
	    }
	    else
	    {
	        // Create new object from model and save it
	        $user = new \T4KModels\User;
	        $user->first_name          = Input::get('first_name');
	        $user->last_name           = Input::get('last_name');
	        $user->professional_title  = Input::get('professional_title');
	        $user->user_role_id        = Input::get('user_role_id');
	        $user->groupe              = Input::get('groupe');
	        $user->email               = Input::get('email');
	        $user->cellphone_number    = Input::get('cellphone_number');
	        $user->home_number_1       = Input::get('home_number_1');
	        $user->home_number_2       = Input::get('home_number_2');
	        $user->other_number        = Input::get('other_number');
	        $user->save();
	        $user = \T4KModels\User::find($user->id);
	        
	        // Send email: preparing data
	        $mail_subject = 'Bienvenue chez Équipe Team 3990: Tech for Kids!';
	        
	        // Sending email to each user
            if ($user->is_student)
            {
	            // Array of data to send to email
	            $data = array(
	                    'user'         => $user
	            );
	            
	            // Sending mail
    	        Mail::send('emails.admin.new-user', $data, function($message) use ($user, $mail_subject)
    	        {
    	            $message->from('no-reply@team3990.com', 'Equipe Team 3990: Tech for Kids');
    	            $message->to($user->email);
    	            $message->subject($mail_subject);
    	        });
            }
	
	        // Redirect to view screen with success message
	        Session::flash('store', true);
	        Session::flash('object_name', $user->full_name);
	        return Redirect::route('portal.admin.users.index');
	    }
	}
	
	/**
	 * Modify an existing event item.
	 * @param int $id
	 * @return View Response
	 */
	public function edit($id)
	{
	    // Retrieve the event item with its id
	    $event = \T4KModels\Event::find($id);
	     
	    // Array of data to send to view
	    $data = array(
                'event'         => $event,
	            'currentRoute'  => \Route::currentRouteName(),
                'activeScreen'  => 'AdminIndex'
	    );
	     
	    // Render view
	    $this->layout->content = \View::make('events.form', $data);
	}
	
	/**
	 * Post the updated event item to the DB.
	 * @param int $id
	 * @return Response
	 */
	public function update($id)
	{
	    // Validation rules
	    $validator = Validator::make(Input::all(), \T4KModels\Event::$rules, \T4KModels\Event::$messages);
	
	    // Validator check
	    if ($validator->fails())
	    {
	        // Throw error and redirect to previous screen
	        return Redirect::route('portal.events.edit', $id)->withErrors($validator)->withInput();
	    }
	    else
	    {
	        // Retrieve object from model and update it
	        $event = \T4KModels\Event::find($id);
	        $event->datetime_start = Input::get('datetime_start');
	        $event->datetime_end   = Input::get('datetime_end');
	        $event->title          = Input::get('title');
	        $event->content        = Input::get('content');
	        $event->save();
	
	        // Redirect to view screen with success message
	        Session::flash('update', true);
            if (Input::get('datetime_end') >= date('Y-m-d H:i:s'))
            {
               return Redirect::route('portal.events.upcoming', $event->id);
            }
            else 
            {
                return Redirect::route('portal.events.past', $event->id);
            }
	    }
	}
	
	/**
	 * Soft destroy a event item.
	 * @param int $id
	 * @return Response
	 */
	public function destroy($id)
	{
	    // Retrieve object
	    $user = \T4KModels\User::where('id', $id)->first();
	    Session::flash('object_name', $user->full_name);
	    
	    // Delete object
	    $user->delete();
	
	    // Redirect to view screen with success message
	    Session::flash('destroy', true);
	    return Redirect::route('portal.admin.users.index');
	}
	
	/**
	 * Catch-all method for handling missing methods.
	 * @return Redirect Response
	 */
	public function missingMethod($parameters = array())
	{
	    // Array of data to send to view
	    $data = array(
                'currentRoute'  => \Route::currentRouteName(),
                'activeScreen'  => 'AdminIndex'
	    );
	    
	    // Redirect to Dashboard
	    return Redirect::route('portal.events.index', $data);
	}

}
