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

    public function test_user_can_register_a_payment_with_the_order_total(): void
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
        $this->assertSame(150000.0, $payment->getAmount());
        $this->assertSame('Pendiente', $payment->getStatus());
        $this->assertSame($user->id, $payment->user_id);
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
    }

    public function test_duplicate_payment_for_the_same_order_is_rejected(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $order = $this->orderFor($user);
        $data = ['order_id' => $order->id, 'method' => 'Tarjeta'];

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

    public function test_admin_can_confirm_a_payment_and_the_order_becomes_paid(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);
        $order = $this->orderFor($user);

        $this->actingAs($user)->post('/payments/save', ['order_id' => $order->id, 'method' => 'PSE']);
        $payment = Payment::first();

        $this->actingAs($admin)
            ->patch('/payments/'.$payment->id.'/status', ['status' => 'Completado'])
            ->assertRedirect(route('payment.show', ['id' => $payment->id]));

        $this->assertSame('Completado', $payment->fresh()->getStatus());
        $this->assertSame('Pagado', $order->fresh()->getStatus());
    }

    public function test_failed_payment_allows_a_new_attempt(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);
        $order = $this->orderFor($user);
        $data = ['order_id' => $order->id, 'method' => 'PSE'];

        $this->actingAs($user)->post('/payments/save', $data);
        $this->actingAs($admin)->patch('/payments/'.Payment::first()->id.'/status', ['status' => 'Fallido']);
        $this->actingAs($user)->post('/payments/save', $data)->assertSessionHasNoErrors();

        $this->assertSame(2, Payment::count());
    }

    public function test_regular_users_cannot_change_payment_status(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $order = $this->orderFor($user);

        $this->actingAs($user)->post('/payments/save', ['order_id' => $order->id, 'method' => 'PSE']);
        $payment = Payment::first();

        $this->actingAs($user)
            ->patch('/payments/'.$payment->id.'/status', ['status' => 'Completado'])
            ->assertForbidden();

        $this->assertSame('Pendiente', $payment->fresh()->getStatus());
    }

    public function test_confirmed_payment_status_cannot_be_changed_again(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);
        $order = $this->orderFor($user);

        $this->actingAs($user)->post('/payments/save', ['order_id' => $order->id, 'method' => 'PSE']);
        $payment = Payment::first();

        $this->actingAs($admin)->patch('/payments/'.$payment->id.'/status', ['status' => 'Completado']);
        $this->actingAs($admin)
            ->patch('/payments/'.$payment->id.'/status', ['status' => 'Fallido'])
            ->assertSessionHasErrors('status');

        $this->assertSame('Completado', $payment->fresh()->getStatus());
    }
}
