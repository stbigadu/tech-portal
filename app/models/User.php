<?php

namespace T4KModels;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * T4KModels\User class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    Model Controller managing users. 
 */

class User extends \Eloquent implements UserInterface, RemindableInterface
{

    /**
     * The set of rules to be validated when creating the initial administrator account.
     * @var array
     */
    public static $rulesInitialSetup = array(
            'password'                  =>'required|alpha_num|between:6,15|confirmed',
            'password_confirmation'     =>'required|alpha_num|between:6,15'
    );

    /**
     * The set of messages thrown after rules validation.
     * @var array
     */
    public static $msgInitialSetup = array(
            'required'  => 'Le champ :attribute est requis.',
            'alpha'     => 'Le champ :attribute ne peut contenir que des caractères alphabétiques.',
            'alpha_num' => 'Le champ :attribute ne peut contenir que des caractères alphanumériques.',
            'between'   => 'Entre 6 et 15 caractères autorisés seulement pour le champ :attribute.',
            'confirmed' => 'Le champ :attribute doit correspondre avec le champ :other.'
    );

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 't4kglo_users';
    
    /**
     * Enable model soft deleting functionality.
     */
    use \SoftDeletingTrait;

    /**
     * The attributes excluded from the model's JSON form.
     * @var array
     */
    protected $hidden = array('password');

    /**
     * Get the unique identifier for the user.
     * @return mixed
    */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Get the e-mail address where password reminders are sent.
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }
    
    /**
     * Accessor: user's full name
     * @param Collection Object $value
     * @return string
     */
    public function getFullNameAttribute($value)
    {
        return $this->first_name.' '.$this->last_name;
    }
    
    /**
     * Relationship to Nouvelle model.
     * @return Eloquent Relationship
     */
    public function nouvelles()
    {
        return $this->hasMany('\T4KModels\Nouvelle');
    }
    
    /**
     * Relationship to UserRole model.
     * @return Eloquent Relationship
     */
    public function role()
    {
        return $this->belongsTo('\T4KModels\UserRole', 'user_role_id', 'id');
    }
    
    /**
     * Attribute: is user a mentor? 
     * @return boolean
     */
    public function getIsMentorAttribute()
    {
        return ($this->role->title == "Mentor") ? true : false;
    }
    
    /**
     * Attribute: is user a student?
     * @return boolean
     */
    public function getIsStudentAttribute()
    {
        return ($this->role->title == "Élève") ? true : false;
    }
    
    /**
     * Attribute: is user a junior mentor?
     * @return boolean
     */
    public function getIsJuniorMentorAttribute()
    {
        return ($this->role->title == "Apprenti(e) mentor") ? true : false;
    }
    
    /**
     * Attribute: is user a parent?
     * @return boolean
     */
    public function getIsParentAttribute()
    {
        return ($this->role->title == "Parent") ? true : false;
    }
    
    /**
     * Attribute: is user an other type of user?
     * @return boolean
     */
    public function getIsOtherAttribute()
    {
        return ($this->role->title == "Autre") ? true : false;
    }

}
