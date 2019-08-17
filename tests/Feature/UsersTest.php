<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

class UsersTest extends TestCase
{	
	//Nos permite que la crear un usuario con factory no se guarden en base de datos.
	//Si no que solo sirvan para el test
	use DatabaseTransactions;

	//Nos permite devisar si existen relaciones, lo usamos en el ultimo metodo.
	use InteractsWithDatabase;

	public function testCanSeeUserPage()
	{
		$user = factory(User::class)->create();

		$response = $this->get($user->username);
		$response->assertSee($user->name);
	}

	public function testCanLogin()
	{
		$user = factory(User::class)->create();

		$response = $this->post('/login', [
			'email' => $user->email,
			'password' => 'password',
		]);

		$this->assertAuthenticatedAs($user);
	}

	public function testCanFollow()
	{
		$user = factory(User::class)->create();
		$other = factory(User::class)->create();

		$response = $this->actingAs($user)->post($other->username.'/follow');

		$this->assertDatabaseHas('followers', [
			'user_id' => $user->id,
			'followed_id' => $other->id,
		]);
	}
}