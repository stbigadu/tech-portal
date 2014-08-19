<?php

namespace T4KModels;

/**
 * T4KModels\Event class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    Model Controller managing events.
 */

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
        'title'             => 'required',
        'datetime_start'    => 'required',
        'datetime_end'      => 'required'
    );
    
    /**
     * The set of messages thrown after rules validation.
     * @var array
     */
    public static $messages = array(
        'title.required'            => 'Le titre de la nouvelle est requise.',
        'datetime_start.required'   => 'La date et l\'heure de début de l\'évènement sont requises.',
        'datetime_end.required'     => 'La date et l\'heure de fin de l\'évènement sont requises.'
    );
    
    /**
     * Scope: retrieve upcoming events
     * @return Eloquent Scope
     */
    public function scopeUpcoming($query)
    {
        return $query->where('datetime_start', '>', date('Y-m-d H:i:s'))->orderBy('datetime_start', 'asc');
    }
    
    /**
     * Scope: retrieve past events
     * @return Eloquent Scope
     */
    public function scopePast($query)
    {
        return $query->where('datetime_end', '<', date('Y-m-d H:i:s'))->orderBy('datetime_start', 'desc');
    }
    
    /**
     * Scope: retrieve current events
     * @return Eloquent Scope
     */
    public function scopeCurrent($query)
    {
        return $query->where('datetime_start', '<', date('Y-m-d H:i:s'))->where('datetime_end', '>', date('Y-m-d H:i:s'))->orderBy('datetime_start', 'desc');
    }
    
    /**
     * Relationship to User model.
     * @return Eloquent Relationship
     */
    public function user()
    {
        return $this->belongsTo('\T4KModels\User')->withTrashed();
    }
    
    /**
     * Relationship to EventPresence model.
     * @return Eloquent Relationship
     */
    public function attendances()
    {
        return $this->hasMany('\T4KModels\EventPresence');
    }
    
    /**
     * Attribute: is current user attending the current event?
     * @return boolean|NULL
     */
    public function getIsUserAttendingAttribute()
    {
        $attending = \T4KModels\EventPresence::where('event_id', $this->id)->where('user_id', \Auth::user()->id)->orderBy('id', 'desc')->first();
            if (isset($attending) && $attending->is_attending == 1)
            {
                return true;
            }
            elseif (isset($attending) && $attending->is_attending == 0)
            {
                return 0;
            }
            else
            {
                return null;
            }
    }
    
}