<?php

/**
 * BaseController class
 * @author minhnhatbui
 * @copyright 2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract BaseController parent class.
 */

class BaseController extends Controller {
    
    /**
     * Master Admin layout
     * @var string
     */
    protected $layout = 'layout.master';
    
    /**
     * GLOBAL / Number of items per page
     * @var int
     */
    protected $ItemsPerPage = 5;

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if (!is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
