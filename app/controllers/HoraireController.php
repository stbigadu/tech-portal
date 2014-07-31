<?php

namespace T4KControllers\Horaire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

/**
 * T4KControllers\Horaire\HoraireController class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    View Controller for the Horaire model.
 */

class HoraireController extends \BaseController { 
    
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
	    // Retrieve upcoming events items
	    $upcoming_events = \T4KModels\Event::upcoming()->get();
	    
	    // Retrieve current events items
	    $current_events = \T4KModels\Event::current()->get();
	    
	    // Retrieve past events items
	    $past_events = \T4KModels\Event::past()->paginate($this->ItemsPerPage*2);
	    
	    // Array of data to send to view
	    $data = array(
                'upcoming_events'   => $upcoming_events,
                'current_events'    => $current_events,
                'past_events'       => $past_events,
                'ItemsCount'        => \T4KModels\Event::count(),
                'currentRoute'      => \Route::currentRouteName(),
                'activeScreen'      => 'HoraireIndex'
	    );
	    
	    // Render view
	    $this->layout->content = \View::make('horaire.index', $data);
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
                'activeScreen'  => 'HoraireIndex'
	    );
	    
	    // Redirect to Dashboard
	    return Redirect::route('portal.events.index', $data);
	}

}
