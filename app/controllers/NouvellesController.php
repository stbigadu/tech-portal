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
                'currentRoute'  => \Route::currentRouteName(),
                'activeScreen'  => 'NouvellesIndex'
	    );
	    
	    // Render view
	    $this->layout->content = \View::make('nouvelles.index', $data);
	}
	
	/**
	 * View a news item.
	 * @param int $id
	 */
	public function view($id)
	{
	    // Retrieve all news
	    $articles = \T4KModels\Nouvelle::
    	      orderBy('datetime', 'desc')
    	    ->paginate($this->ItemsPerPage);
	    
	    // Retrieve the news item with its id
	    $article = \T4KModels\Nouvelle::find($id);
	     
	    // Array of data to send to view
	    $data = array(
                'article'       => $article,
                'articles'      => $articles,
                'ItemsCount'    => \T4KModels\Nouvelle::count(),
                'currentRoute'  => \Route::currentRouteName(),
                'activeScreen'  => 'NouvellesIndex'
	    );
	     
	    // Render view
	    $this->layout->content = \View::make('nouvelles.index', $data);
	}
	
	/**
	 * Create a news item.
	 * @return View Response
	 */
	public function create()
	{
	    // Array of data to send to view
	    $data = array(
                'currentRoute'  => \Route::currentRouteName(),
                'activeScreen'  => 'NouvellesIndex'
	    );
	     
	    // Render view
	    $this->layout->content = \View::make('nouvelles.form', $data);
	}
	
	/**
	 * Post the new news item in DB.
	 * @return Response
	 */
	public function store()
	{
	    // Validation rules
	    $validator = Validator::make(Input::all(), \T4KModels\Nouvelle::$rules, \T4KModels\Nouvelle::$messages);
	
	    // Validator check
	    if ($validator->fails())
	    {
	        // Throw error and redirect to previous screen
	        return Redirect::route('admin.nouvelles.create')->withErrors($validator)->withInput();
	    }
	    else
	    {
	        // Create new object from model and save it
	        $article = new \T4KModels\Nouvelle;
	        $article->user_id      = Auth::user()->id;
	        $article->datetime     = date('Y-m-d H:i:s');
	        $article->title        = Input::get('title');
	        $article->content      = Input::get('content');
	        $article->save();
	
	        // Redirect to view screen with success message
	        Session::flash('store', true);
	        return Redirect::route('admin.nouvelles.view', $article->id);
	    }
	}
	
	/**
	 * Modify an existing news item.
	 * @param int $id
	 * @return View Response
	 */
	public function edit($id)
	{
	    // Retrieve the news item with its id
	    $article = \T4KModels\Nouvelle::find($id);
	     
	    // Array of data to send to view
	    $data = array(
                'article'       => $article,
	            'currentRoute'  => \Route::currentRouteName(),
                'activeScreen'  => 'NouvellesIndex'
	    );
	     
	    // Render view
	    $this->layout->content = \View::make('nouvelles.form', $data);
	}
	
	/**
	 * Post the updated news item to the DB.
	 * @param int $id
	 * @return Response
	 */
	public function update($id)
	{
	    // Validation rules
	    $validator = Validator::make(Input::all(), \T4KModels\Nouvelle::$rules, \T4KModels\Nouvelle::$messages);
	
	    // Validator check
	    if ($validator->fails())
	    {
	        // Throw error and redirect to previous screen
	        return Redirect::route('portal.nouvelles.edit', $id)->withErrors($validator)->withInput();
	    }
	    else
	    {
	        // Retrieve object from model and update it
	        $article = \T4KModels\Nouvelle::find($id);
	        $article->title        = Input::get('title');
	        $article->content      = Input::get('content');
	        $article->save();
	
	        // Redirect to view screen with success message
	        Session::flash('update', true);
	        return Redirect::route('portal.nouvelles.view', $article->id);
	    }
	}
	
	/**
	 * Soft destroy a news item.
	 * @param int $id
	 * @return Response
	 */
	public function destroy($id)
	{
	    // Retrieve object
	    $article = \T4KModels\Nouvelle::where('id', $id)->first();
	    Session::flash('object_name', $article->title_FR);
	    
	    // Delete object
	    $article->delete();
	
	    // Redirect to view screen with success message
	    Session::flash('destroy', true);
	    return Redirect::route('admin.nouvelles.index');
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
                'activeScreen'  => 'NouvellesIndex'
	    );
	    
	    // Redirect to Dashboard
	    return Redirect::route('admin.nouvelles.index', $data);
	}

}
