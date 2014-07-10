<?php

namespace T4KControllers\Nouvelles;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

/**
 * T4KControllers\Nouvelles\NouvellesController class
 * @author minhnhatbui
 * @copyright 2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract View Controller for the Nouvelles model.
 */

class NouvellesController extends \BaseController { 
    
    /**
     * Constructor.
     */
    public function __construct() {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth');
        setlocale(LC_ALL, 'fr_CA.UTF-8');
    }
    
    /**
     * Display all news.
     * @return View Response
     */
	public function index()
	{
	    // Retrieve all news
	    $articles = \T4KModels\Nouvelle::
	         orderBy('datetime', 'desc')
	       ->paginate($this->ItemsPerPage);
	    
	    // Array of data to send to view
	    $data = array(
            'articles'      => $articles,
            'ItemsCount'    => \T4KModels\Nouvelle::count(),
            'activeScreen'  => 'DashboardIndex'
	    );
	    
	    // Render view
	    $this->layout->content = \View::make('nouvelles.index', $data);
	}

}
