<?php

namespace T4KModels;

/**
 * T4KModels\Event class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    Model Controller managing files.
 */

class File extends \Eloquent
{
    
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 't4knet_files';
    
    /**
     * Enable model soft deleting functionality.
     */
    use \SoftDeletingTrait;
    
    /**
     * The set of rules to be validated when creating an item.
     * @var array
     */
    public static $rules = array(
        'path'              => 'required',
    );
    
    /**
     * The set of messages thrown after rules validation.
     * @var array
     */
    public static $messages = array(
        'path.required'     => 'Un fichier est requis.',
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
     * Attribute: file information
     * @return string
     */
    public function getExtensionAttribute()
    {
    	return \File::extension(public_path().$this->path);
    }
    
    /**
     * Attribute: file type
     * @return string
     */
    public function getTypeAttribute()
    {
        return \File::type(public_path().$this->path);
    }
    
    /**
     * Attribute: file size
     * @return int
     */
    public function getSizeAttribute()
    {
        return \File::size(public_path().$this->path);
    }
    
}