<?php

namespace T4KModels;

/**
 * T4KModels\Nouvelle class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    Model Controller managing nouvelles.
 */

class Nouvelle extends \Eloquent
{
    
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 't4knet_nouvelles';
    
    /**
     * Enable model soft deleting functionality.
     */
    use \SoftDeletingTrait;
    
    /**
     * The set of rules to be validated when creating the initial administrator account.
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
     * @return Eloquent Relationship
     */
    public function user()
    {
        return $this->belongsTo('\T4KModels\User')->withTrashed();
    }
    
    /**
     * Relationship to File model.
     * @return Eloquent Relationship
     */
    public function files()
    {
        return $this->hasMany('\T4KModels\File');
    }
    
}