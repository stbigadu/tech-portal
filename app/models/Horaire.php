<?php

namespace T4KModels;

/**
 * T4KModels\Horaire class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    Model Controller managing mentors horaire.
 */

class Horaire extends EventPresence
{
    
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 't4knet_event_presence';
    
    /**
     * Enable model soft deleting functionality.
     */
    use \SoftDeletingTrait;
    
    public function scopeGetMentorsOnly($query)
    {
        // Get mentors only
        
    }
    
}