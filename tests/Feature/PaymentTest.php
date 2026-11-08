<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    private function orderFor(User $user, float $total = 150000): Order
    {
        return Order::create([
            'code' => 'ORD-'.uniqid(),
            'date' => now()->toDateString(),
            'status' => 'Pendiente',
            'total' => $total,
            'user_id' => $user->id,
        ]);
    }

    public function test_guests_are_redirected_to_login(): void
    {
        $this->get('/payments')->assertRedirect('/login');
        $this->post('/payments/save', [])->assertRedirect('/login');
    }

    public function test_user_pays_an_order_immediately_with_the_order_total(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $order = $this->orderFor($user, 150000);

        $response = $this->actingAs($user)->post('/payments/save', [
            'order_id' => $order->id,
            'method' => 'PSE',
            'amount' => 1,
        ]);

        $payment = Payment::first();

        $response->assertRedirect(route('payment.show', ['id' => $payment->id]));
        $this->assertEquals(150000, $payment->getAmount());
        $this->assertSame('PSE', $payment->getMethod());
        $this->assertSame('Completado', $payment->getStatus());
        $this->assertSame($user->id, $payment->user_id);
        $this->assertSame('Pagado', $order->fresh()->getStatus());
    }

    public function test_validation_rejects_invalid_input(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $order = $this->orderFor($user);

        $this->actingAs($user)
            ->post('/payments/save', ['order_id' => $order->id, 'method' => 'Bitcoin'])
            ->assertSessionHasErrors('method');

        $this->actingAs($user)
            ->post('/payments/save', ['order_id' => 9999, 'method' => 'PSE'])
            ->assertSessionHasErrors('order_id');

        $this->assertSame(0, Payment::count());
    }

    public function test_user_cannot_pay_someone_elses_order(): void
    {
        $owner = User::factory()->create(['role' => 'user']);
        $intruder = User::factory()->create(['role' => 'user']);
        $order = $this->orderFor($owner);

        $this->actingAs($intruder)
            ->post('/payments/save', ['order_id' => $order->id, 'method' => 'PSE'])
            ->assertForbidden();

        $this->assertSame(0, Payment::count());
        $this->assertSame('Pendiente', $order->fresh()->getStatus());
    }

    public function test_an_order_cannot_be_paid_twice(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $order = $this->orderFor($user);
        $data = ['order_id' => $order->id, 'method' => 'PSE'];

        $this->actingAs($user)->post('/payments/save', $data);
        $this->actingAs($user)->post('/payments/save', $data)->assertSessionHasErrors('order_id');

        $this->assertSame(1, Payment::count());
    }

    public function test_user_only_sees_own_payments(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $other = User::factory()->create(['role' => 'user']);
        $mine = $this->orderFor($user);
        $theirs = $this->orderFor($other);

        $this->actingAs($user)->post('/payments/save', ['order_id' => $mine->id, 'method' => 'PSE']);
        $this->actingAs($other)->post('/payments/save', ['order_id' => $theirs->id, 'method' => 'PSE']);

        $this->actingAs($user)->get('/payments')
            ->assertOk()
            ->assertSee($mine->code)
            ->assertDontSee($theirs->code);

        $otherPayment = Payment::where('user_id', $other->id)->first();

        $this->actingAs($user)->get('/payments/'.$otherPayment->id)->assertForbidden();
    }

    public function test_admin_sees_all_payments_in_the_admin_panel(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $first = User::factory()->create(['role' => 'user']);
        $second = User::factory()->create(['role' => 'user']);
        $orderOne = $this->orderFor($first);
        $orderTwo = $this->orderFor($second);

        $this->actingAs($first)->post('/payments/save', ['order_id' => $orderOne->id, 'method' => 'PSE']);
        $this->actingAs($second)->post('/payments/save', ['order_id' => $orderTwo->id, 'method' => 'PSE']);

        $this->actingAs($admin)->get('/admin/payments')
            ->assertOk()
            ->assertSee($orderOne->code)
            ->assertSee($orderTwo->code);

        $payment = Payment::first();

        $this->actingAs($admin)->get('/admin/payments/'.$payment->id)
            ->assertOk()
            ->assertSee('Completado');
    }

    public function test_payments_do_not_need_admin_approval(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);
        $order = $this->orderFor($user);

        $this->actingAs($user)->post('/payments/save', ['order_id' => $order->id, 'method' => 'PSE']);
        $payment = Payment::first();

        $this->actingAs($admin)
            ->patch('/admin/payments/'.$payment->id.'/status', ['status' => 'Fallido'])
            ->assertNotFound();

        $this->assertSame('Completado', $payment->fresh()->getStatus());
    }

    public function test_regular_users_cannot_access_the_admin_payment_panel(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)->get('/admin/payments')->assertForbidden();
    }
}
