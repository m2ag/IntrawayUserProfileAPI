<?php namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Repositories\User\UserRepository as UserRepository;
use App\User as User;

class UserRepositoryTest extends TestCase
{
    public function testStoreUser()
    {
        $user = new User();
        $userRepo = new UserRepository($user);
        
        $data = [
            'id' => rand(200, 500),
            'name' => 'Michael',
            'email' => 'mchael@gmail.com',
            'image' => 'michael.png'
        ];
        
        $this->assertTrue($userRepo->store($data));
    }
}
