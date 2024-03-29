<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
//    use RefreshDatabase;
    /**
     * A basic unit test example.
     */

    protected $userIsAdmin;
    protected $userNotAdmin;
    protected $userIsActive;
    protected $userNotActive;

    public function setUp(): void  // Уменьшаем количество запросов и созданий
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->userIsAdmin = User::factory()->admin()->create();  // Можно вместо параметров в create написать отдельную state функцию в фабрике
        $this->userNotAdmin = User::factory()->create(['is_admin' => 0]);
        $this->userIsActive = User::factory()->active()->create();
        $this->userNotActive = User::factory()->create(['is_active' => 0]);
    }

    public function testUserIsActiveTrue(): void  // Проверяем активный ли пользователь
    {
//        $user = User::factory()->create(['is_active' => 1]);  // Используя setUP() можно сократить всемя теста
        $this->assertTrue($this->userIsActive->isActive());
    }


    public function testUserIsActiveFalse(): void  // Проверяем активный ли пользователь
    {
        $this->assertFalse($this->userNotActive->isActive());
    }


    public function testUserSetActive(): void  // Проверяем активный ли пользователь
    {
        $this->userNotActive->setActive();                          // Активируем пользовалетя
        $this->assertTrue($this->userNotActive->isActive());
    }

    public function testUserDelActive(): void  // Проверяем активный ли пользователь
    {
        $this->userIsActive->delActive();                          // Деактивируем пользовалетя
        $this->assertFalse($this->userIsActive->isActive());
    }


    public function testUserIsAdminTrue(): void
    {
        $this->assertTrue($this->userIsAdmin->isAdmin());
    }

    public function testUserIsAdminFalse(): void
    {
        $this->assertFalse($this->userNotAdmin->isAdmin());
    }

    public function testUserSetAdmin(): void
    {
        $this->userNotAdmin->setAdmin();
        $this->assertTrue($this->userNotAdmin->isAdmin());
    }

    public function testUserDelAdmin(): void
    {
        $this->userIsAdmin->delAdmin();
        $this->assertFalse($this->userIsAdmin->isAdmin());
    }

}
