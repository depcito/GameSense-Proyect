<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    private function product(float $price = 100000): Product
    {
        $category = Category::create([
            'name' => 'Categoria '.uniqid(),
            'description' => 'Descripcion',
        ]);

        return Product::create([
            'title' => 'Producto '.uniqid(),
            'description' => 'Descripcion',
            'price' => $price,
            'stock' => 10,
            'format' => 'Digital',
            'type' => 'Juego',
            'platform' => 'PC',
            'category_id' => $category->id,
        ]);
    }

    private function pay(User $user, float $price = 100000, string $method = 'PSE'): Payment
    {
        $product = $this->product($price);

        $this->actingAs($user)->post('/cart/'.$product->id.'/add', ['quantity' => 1]);
        $this->actingAs($user)->post('/checkout/save', [
            'shipping_name' => 'Ana Torres',
            'shipping_phone' => '3001234567',
            'shipping_address' => 'Calle 10 # 5-20',
            'shipping_city' => 'Medellín',
            'method' => $method,
        ]);

        return Payment::where('user_id', $user->id)->latest('id')->firstOrFail();
    }

    public function test_the_payment_is_made_in_the_checkout_and_it_is_immediate(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $payment = $this->pay($user, 150000, 'Tarjeta');

        $this->assertSame('Tarjeta', $payment->getMethod());
        $this->assertSame('Completado', $payment->getStatus());
        $this->assertEquals(150000, $payment->getAmount());
        $this->assertSame($user->id, $payment->user_id);
        $this->assertSame('Pagado', Order::first()->getStatus());
    }

    public function test_users_have_no_separate_payment_pages(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $payment = $this->pay($user);

        $this->actingAs($user)->get('/payments')->assertNotFound();
        $this->actingAs($user)->get('/payments/'.$payment->id)->assertNotFound();
        $this->actingAs($user)->get('/payments/create')->assertNotFound();
        $this->actingAs($user)->post('/payments/save', [])->assertNotFound();
    }

    public function test_the_payment_is_shown_in_the_order_detail(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $payment = $this->pay($user, 80000, 'Efectivo');

        $this->actingAs($user)->get('/orders/'.$payment->order_id)
            ->assertOk()
            ->assertSee('Efectivo')
            ->assertSee('80.000')
            ->assertSee('Completado');
    }

    public function test_the_navigation_has_no_payments_link(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)->get('/orders')
            ->assertOk()
            ->assertSee('Carrito')
            ->assertSee('Pedidos')
            ->assertDontSee('Pagos');
    }

    public function test_payments_cannot_be_changed(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);
        $payment = $this->pay($user);

        $this->actingAs($admin)
            ->patch('/admin/payments/'.$payment->id.'/status', ['status' => 'Fallido'])
            ->assertNotFound();

        $this->assertSame('Completado', $payment->fresh()->getStatus());
    }

    public function test_admin_sees_all_payments_in_the_admin_panel(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $first = $this->pay(User::factory()->create(['role' => 'user']));
        $second = $this->pay(User::factory()->create(['role' => 'user']));

        $this->actingAs($admin)->get('/admin/payments')
            ->assertOk()
            ->assertSee($first->order->code)
            ->assertSee($second->order->code);

        $this->actingAs($admin)->get('/admin/payments/'.$first->id)
            ->assertOk()
            ->assertSee('Completado');
    }

    public function test_regular_users_cannot_access_the_admin_payment_panel(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)->get('/admin/payments')->assertForbidden();
    }
}
