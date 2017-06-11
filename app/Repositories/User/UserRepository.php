<?php namespace App\Repositories\User;

use App\Repositories\User\UserInterface as UserInterface;
use App\User;

/**
 * User repository allows to query and write on the user table.
 *
 * @author mauricio
 */
class UserRepository implements UserInterface 
{
    /**
     *
     * @var User model 
     */
    protected $user;
    
    /**
     * 
     * @param User $user
     */
    public function __construct(User $user) 
    {
        $this->user = $user;
    }
    
    /**
     * Delete a record in the user table
     * @param int $id Id of the row to delete 
     * @return boolean Returns true if you delete the row, otherwise returns false
     */
    public function delete($id) 
    {
        if ($this->user->destroy($id)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Find a user by their ID.
     * @param int $id
     * @return boolean Returns the user if it finds it, otherwise returns false
     */
    public function find($id) 
    {
        $user = $this->user->find($id);
        if (!is_null($user)) {
            return $user;
        } else {
            return false;
        }
    }
    
    /**
     * Get all users
     * @return array Returns an array of all stored users
     */
    public function getAll() 
    {
        return $this->user->all();
    }

    /**
     * Stored user to the database
     * @param array $data
     * @return boolean Returns true if stored the user otherwise returns false 
     */
    public function store(array $data) {
        $user = new User();
        $user->id = $data['id'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->image = $data['image'];
        
        return $user->save();
    }

    /**
     * Save user to the database
     * @param array $data
     * @param int $id
     * @return boolean Returns true if save the user otherwise returns false 
     */
    public function update(array $data, $id) {
        $user = $this->user->find($id);
        
        if (!is_null($user)) {
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->image = $data['image'];
            return $user->save();
        }
        return false;
    }

}
