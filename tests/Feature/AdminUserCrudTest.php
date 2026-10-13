<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminUserCrudTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    public function test_guests_cannot_access_admin_panel(): void
    {
        $this->get('/admin/users')->assertUnauthorized();
    }

    public function test_regular_users_are_forbidden(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)->get('/admin/users')->assertForbidden();
    }

    public function test_admin_can_list_users(): void
    {
        $other = User::factory()->create(['name' => 'Persona Visible']);

        $this->actingAs($this->admin())->get('/admin/users')
            ->assertOk()
            ->assertSee($other->name);
    }

    public function test_admin_can_create_user(): void
    {
        $this->actingAs($this->admin())->post('/admin/users', [
            'name' => 'Nuevo',
            'email' => 'nuevo@example.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'address' => 'Calle 1',
            'role' => 'user',
        ])->assertRedirect('/admin/users');

        $this->assertDatabaseHas('users', ['email' => 'nuevo@example.com', 'role' => 'user']);
    }

    public function test_create_validates_input(): void
    {
        $this->actingAs($this->admin())->post('/admin/users', ['role' => 'root'])
            ->assertSessionHasErrors(['name', 'email', 'password', 'role']);
    }

    public function test_admin_can_update_user_without_changing_password(): void
    {
        $target = User::factory()->create();
        $hash = $target->password;

        $this->actingAs($this->admin())->put("/admin/users/{$target->id}", [
            'name' => 'Cambiado',
            'email' => $target->email,
            'address' => 'Otra dirección',
            'role' => 'admin',
        ])->assertRedirect('/admin/users');

        $target->refresh();
        $this->assertSame('Cambiado', $target->name);
        $this->assertSame('admin', $target->role);
        $this->assertSame($hash, $target->password);
    }

    public function test_admin_can_delete_other_user_but_not_self(): void
    {
        $admin = $this->admin();
        $target = User::factory()->create();

        $this->actingAs($admin)->delete("/admin/users/{$target->id}")->assertRedirect('/admin/users');
        $this->assertDatabaseMissing('users', ['id' => $target->id]);

        $this->actingAs($admin)->delete("/admin/users/{$admin->id}")->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', ['id' => $admin->id]);
    }
}
