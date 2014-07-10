<?php

/**
 * T4KModels\Nouvelle class
 * @author minhnhatbui
 * @copyright 2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract Model Controller managing nouvelles.
 */

namespace T4KModels;

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
            'datetime'         => 'required|date',
            'date_activation'  => 'date',
            'date_expiration'  => 'date',
            'external_link'    => 'url',
            'title_FR'         => 'required',
            'title_EN'         => 'required',
            'groupe'           => 'required'
    );
    
    /**
     * The set of messages thrown after rules validation.
     * @var array
     */
    public static $messages = array(
            'datetime.required'    => 'La date de la nouvelle est requise.',
            'title_FR.required'    => 'Le titre de la nouvelle en français est requis.',
            'title_EN.required'    => 'Le titre de la nouvelle en anglais est requis.',
            'groupe.required'      => 'Au moins un thème de recherche est requis.',
            'date'                 => 'Le ou les dates sont mal indiquées.',
            'external_link.url'    => 'Le lien externe est mal indiqué.'
    );
    
    /**
     * Relationship to User model.
     * @return array
     */
    public function user()
    {
        return $this->belongsTo('\T4KModels\User');
    }
    
}