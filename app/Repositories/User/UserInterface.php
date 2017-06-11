<?php namespace App\Repositories\User;

/**
 * Interface defines the contract for the user repository
 *
 * @author Mauricio Aragón
 */
interface UserInterface 
{
    public function getAll();
    public function find($id);
    public function store(array $data);
    public function update(array $data, $id);
    public function delete($id);
}
