<?php

namespace T4KModels;

/**
 * T4KModels\Event class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    Model Controller managing events attendance.
 */

class EventPresence extends \Eloquent
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
     * Relationship to Event model.
     * @return Eloquent Scope
     */
    public function event()
    {
        return $this->belongsTo('\T4KModels\Event', 'id', 'event_id');
    }
    
    /**
     * Relationship to User model.
     * @return Eloquent Scope
     */
    public function user()
    {
        return $this->belongsTo('\T4KModels\User', 'user_id', 'id')->withTrashed();
    }
    
}