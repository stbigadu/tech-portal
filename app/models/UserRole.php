<?php

namespace T4KModels;

/**
 * T4KModels\UserRole class
 * @author      minhnhatbui
 * @copyright   2014 Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC)
 * @abstract    Model Controller managing users' roles. 
 */

class UserRole extends \Eloquent
{

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 't4kglo_user_role';
    
    /**
     * Enable model soft deleting functionality.
     */
    use \SoftDeletingTrait;
    
    /**
     * Relationship to User model.
     * @return array
     */
    public function users()
    {
        return $this->hasMany('\T4KModels\User', 'user_role_id', 'id');
    }

}
