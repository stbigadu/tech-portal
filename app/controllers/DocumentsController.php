<?php

namespace T4KControllers\Documents;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

/**
 * T4KControllers\Documents\DocumentsController class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    View Controller for the Documents functionality.
 */

class DocumentsController extends \BaseController { 
    
    protected $base_dir = '/files/documents/';
    
    /**
     * Constructor.
     */
    public function __construct() {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth');
        setlocale(LC_ALL, 'fr_CA.UTF-8');
        $this->base_dir = public_path().$this->base_dir;
    }
    
    /**
     * Display all documents.
     * @return View Response
     */
	public function index()
	{
	    // Get current directory
	    $current_dir = (Input::get('path') == NULL || Input::get('path') == '0') ? '' : Input::get('path').'/';
	    
	    // Instantiate new Filesystem object
	    $fs = new \Illuminate\Filesystem\Filesystem;
	    
	    // Get all directories for the current path
	    $path = $this->base_dir.$current_dir;
	    $dirs = $fs->directories($path);
	    sort($dirs, SORT_NATURAL | SORT_FLAG_CASE);
	    
	    // Get all files for the current path
	    $files = $fs->files($path);
	    sort($files, SORT_NATURAL | SORT_FLAG_CASE);
	    
	    // Get parent folder path
	    $parent_array = explode('/', substr($current_dir, 0, -1));
	    array_pop($parent_array);
	    $parent_dir = '';
	    foreach ($parent_array as $value)
	    {
	        $parent_dir .= $value.'/';
	    }
	    
	    // Array of data to send to view
	    $data = array(
                'fs'            => $fs,
                'dirs'          => $dirs,
                'files'         => $files,
                'path'          => $path,
	            'base_dir'      => $this->base_dir,
                'current_dir'   => $current_dir,
	            'parent_dir'    => (substr($parent_dir, 0, -1) == '0') ? '' : substr($parent_dir, 0, -1),
                'currentRoute'  => Route::currentRouteName(),
                'activeScreen'  => 'DocumentsIndex'
	    );
	    
	    // Render view
	    $this->layout->content = View::make('documents.index', $data);
	}
	
	/**
	 * Create directory
	 * @return Response
	 */
	public function createDir()
	{
	    // Get current directory
	    $current_dir = (Input::get('path') == NULL || Input::get('path') == '0') ? '' : Input::get('path').'/';
	    
	    // Instantiate new Filesystem object
	    $fs = new \Illuminate\Filesystem\Filesystem;
	    
	    // Create new directory
	    $new_dir = $this->base_dir.$current_dir.Input::get('create_dir');
	    $fs->makeDirectory($new_dir);
	    
	    // Redirect
	    Session::flash('action', 'create_dir');
	    Session::flash('create_dir', Input::get('create_dir'));
	    return Redirect::route('portal.docs.index', array('path' => substr(substr($this->base_dir.$current_dir, 0, -1), strlen($this->base_dir))));
	}
	
	/**
	 * Rename directory
	 * @return Response
	 */
	public function renameDir()
	{
	    // Get current directory
	    $current_dir = (Input::get('path') == NULL || Input::get('path') == '0') ? '' : Input::get('path').'/';
	     
	    // Instantiate new Filesystem object
	    $fs = new \Illuminate\Filesystem\Filesystem;
	     
	    // Create new directory
	    $old_dir = Input::get('old_dir');
	    $new_dir = $this->base_dir.$current_dir.Input::get('create_dir');
	    $fs->copyDirectory($old_dir, $new_dir);
	    $fs->deleteDirectory($old_dir);
	     
	    // Redirect
	    Session::flash('action', 'rename_dir');
	    Session::flash('old_dir', substr($old_dir, strlen($this->base_dir.$current_dir)));
	    Session::flash('create_dir', Input::get('create_dir'));
	    return Redirect::route('portal.docs.index', array('path' => substr(substr($this->base_dir.$current_dir, 0, -1), strlen($this->base_dir))));
	}
	
	/**
	 * Delete directory
	 * @return Response
	 */
	public function deleteDir()
	{
	    // Get current directory
	    $current_dir = (Input::get('path') == NULL || Input::get('path') == '0') ? '' : Input::get('path').'/';
	
	    // Instantiate new Filesystem object
	    $fs = new \Illuminate\Filesystem\Filesystem;
	
	    // Create new directory
	    $delete_dir = Input::get('delete_dir');
	    $fs->deleteDirectory($delete_dir);
	
	    // Redirect
	    Session::flash('action', 'delete_dir');
	    Session::flash('delete_dir', substr($delete_dir, strlen($this->base_dir.$current_dir)));
	    return Redirect::route('portal.docs.index', array('path' => substr(substr($this->base_dir.$current_dir, 0, -1), strlen($this->base_dir))));
	}
	
	/**
	 * Add files.
	 * @return Response
	 */
	public function addFiles()
	{
	    // Get current directory
	    $current_dir = (Input::get('path') == NULL || Input::get('path') == '0') ? '' : Input::get('path').'/';
	    
	    // Instantiate new Filesystem object
	    $fs = new \Illuminate\Filesystem\Filesystem;
	    
	    // Upload files
	    $files = Input::file('file');
	    array_pop($files);
	     
        // Upload files
        if (!empty($files))
        {
            foreach ($files as $file)
            {
                // Move file to permanent location
                if (!empty($file)) $file->move($this->base_dir.$current_dir, $file->getClientOriginalName());
                Session::flash('action', 'add_files');
                Session::flash('count', count($files));
            }
        }
	
        // Redirect 
        return Redirect::route('portal.docs.index', array('path' => substr(substr($this->base_dir.$current_dir, 0, -1), strlen($this->base_dir))));
	}
	
	/**
	 * Rename file.
	 * @return Response
	 */
	public function renameFile()
	{
	    // Get current directory
	    $current_dir = (Input::get('path') == NULL || Input::get('path') == '0') ? '' : Input::get('path').'/';
	    
	    // Instantiate new Filesystem object
	    $fs = new \Illuminate\Filesystem\Filesystem;
	    
	    // Rename file
	    $old_file = Input::get('old_file');
	    $new_file = $this->base_dir.$current_dir.'/'.Input::get('new_file');
	    $fs->move($old_file, $new_file);
	    
	    // Redirect
	    Session::flash('action', 'rename_file');
	    Session::flash('old_file', substr($old_file, strlen($this->base_dir.$current_dir)));
	    Session::flash('new_file', Input::get('new_file'));
	    return Redirect::route('portal.docs.index', array('path' => substr(substr($this->base_dir.$current_dir, 0, -1), strlen($this->base_dir))));
	}
	
	/**
	 * Delete file.
	 * @return Response
	 */
	public function deleteFile()
	{
	    // Get current directory
	    $current_dir = (Input::get('path') == NULL || Input::get('path') == '0') ? '' : Input::get('path').'/';
	     
	    // Instantiate new Filesystem object
	    $fs = new \Illuminate\Filesystem\Filesystem;
	    
	    // Delete file
	    $delete_file = Input::get('delete_file');
	    $fs->delete($delete_file);
	    
	    // Redirect
	    Session::flash('action', 'delete_file');
	    Session::flash('delete_file', substr($delete_file, strlen($this->base_dir.$current_dir)+1));
	    return Redirect::route('portal.docs.index', array('path' => substr(substr($this->base_dir.$current_dir, 0, -1), strlen($this->base_dir))));
	}
	
	/**
	 * Catch-all method for handling missing methods.
	 * @return Redirect Response
	 */
	public function missingMethod($parameters = array())
	{
	    // Array of data to send to view
	    $data = array(
                'currentRoute'  => Route::currentRouteName(),
                'activeScreen'  => 'DocumentsIndex'
	    );
	    
	    // Redirect to Dashboard
	    return Redirect::route('portal.nouvelles.index', $data);
	}

}
