<?php

/**
 * T4KModels\Event class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    Model Controller managing events.
 */

namespace T4KModels;

class Event extends \Eloquent
{
    
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 't4knet_events';
    
    /**
     * Enable model soft deleting functionality.
     */
    use \SoftDeletingTrait;
    
    /**
     * The set of rules to be validated when creating an item.
     * @var array
     */
    public static $rules = array(
        'title'             => 'required'
    );
    
    /**
     * The set of messages thrown after rules validation.
     * @var array
     */
    public static $messages = array(
        'title.required'    => 'Le titre de la nouvelle est requise.',
    );
    
    /**
     * Relationship to User model.
     * @return Eloquent Scope
     */
    public function user()
    {
        return $this->belongsTo('\T4KModels\User');
    }
    
    /**
     * Relationship to EventPresence model.
     * @return Eloquent Scope
     */
    public function presences()
    {
        return $this->hasMany('\T4KModels\EventPresence', 'event_id', 'id');
    }
    
}