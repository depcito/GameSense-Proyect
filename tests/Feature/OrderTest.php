<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    private function product(float $price = 100000, int $stock = 10): Product
    {
        $category = Category::create([
            'name' => 'Categoria '.uniqid(),
            'description' => 'Descripcion',
        ]);

        return Product::create([
            'title' => 'Producto '.uniqid(),
            'description' => 'Descripcion',
            'price' => $price,
            'stock' => $stock,
            'format' => 'Digital',
            'type' => 'Juego',
            'platform' => 'PC',
            'category_id' => $category->id,
        ]);
    }

    private function placeOrder(User $user, Product $product, int $quantity = 2): Order
    {
        $this->actingAs($user)->post('/cart/'.$product->id.'/add', ['quantity' => $quantity]);
        $this->actingAs($user)->post('/orders/save');

        return Order::where('user_id', $user->id)->latest('id')->firstOrFail();
    }

    public function test_guests_are_redirected_to_login(): void
    {
        $this->get('/cart')->assertRedirect('/login');
        $this->get('/orders')->assertRedirect('/login');
        $this->post('/orders/save')->assertRedirect('/login');
    }

    public function test_user_can_add_a_product_to_the_cart(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $product = $this->product(stock: 5);

        $this->actingAs($user)
            ->post('/cart/'.$product->id.'/add', ['quantity' => 2])
            ->assertRedirect(route('cart.index'));

        $this->actingAs($user)->get('/cart')
            ->assertOk()
            ->assertSee($product->title);
    }

    public function test_cart_rejects_a_quantity_above_the_stock(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $product = $this->product(stock: 3);

        $this->actingAs($user)
            ->post('/cart/'.$product->id.'/add', ['quantity' => 4])
            ->assertSessionHasErrors('quantity');

        $this->actingAs($user)
            ->post('/cart/'.$product->id.'/add', ['quantity' => 0])
            ->assertSessionHasErrors('quantity');
    }

    public function test_user_can_remove_a_product_from_the_cart(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $product = $this->product();

        $this->actingAs($user)->post('/cart/'.$product->id.'/add', ['quantity' => 1]);
        $this->actingAs($user)->post('/cart/'.$product->id.'/remove');

        $this->actingAs($user)->get('/cart')
            ->assertOk()
            ->assertSee('Tu carrito está vacío');
    }

    public function test_checkout_creates_the_order_with_prices_taken_from_the_products(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $product = $this->product(price: 150000, stock: 10);

        $this->actingAs($user)->post('/cart/'.$product->id.'/add', ['quantity' => 2]);

        $response = $this->actingAs($user)->post('/orders/save', ['total' => 1]);

        $order = Order::first();

        $response->assertRedirect(route('order.show', ['id' => $order->id]));
        $this->assertSame($user->id, $order->user_id);
        $this->assertSame('Pendiente', $order->getStatus());
        $this->assertEquals(300000, $order->getTotal());
        $this->assertSame(1, $order->items()->count());

        $item = $order->items()->first();
        $this->assertSame(2, $item->getQuantity());
        $this->assertEquals(150000, $item->getUnitPrice());
        $this->assertEquals(300000, $item->getSubtotal());

        $this->assertSame(8, $product->fresh()->getStock());
        $this->assertNull(session('cart'));
    }

    public function test_checkout_with_an_empty_cart_is_rejected(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)->post('/orders/save')->assertSessionHasErrors('cart');

        $this->assertSame(0, Order::count());
    }

    public function test_checkout_fails_when_the_stock_changed_after_adding_to_the_cart(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $product = $this->product(stock: 5);

        $this->actingAs($user)->post('/cart/'.$product->id.'/add', ['quantity' => 4]);
        $product->update(['stock' => 1]);

        $this->actingAs($user)->post('/orders/save')->assertSessionHasErrors();

        $this->assertSame(0, Order::count());
        $this->assertSame(1, $product->fresh()->getStock());
    }

    public function test_user_only_sees_own_orders(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $other = User::factory()->create(['role' => 'user']);
        $product = $this->product();

        $mine = $this->placeOrder($user, $product, 1);
        $theirs = $this->placeOrder($other, $product, 1);

        $this->actingAs($user)->get('/orders')
            ->assertOk()
            ->assertSee($mine->code)
            ->assertDontSee($theirs->code);

        $this->actingAs($user)->get('/orders/'.$theirs->id)->assertForbidden();
        $this->actingAs($user)->post('/orders/'.$theirs->id.'/cancel')->assertForbidden();
    }

    public function test_user_can_cancel_a_pending_order_and_the_stock_is_restored(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $product = $this->product(stock: 10);
        $order = $this->placeOrder($user, $product, 3);

        $this->assertSame(7, $product->fresh()->getStock());

        $this->actingAs($user)
            ->post('/orders/'.$order->id.'/cancel')
            ->assertRedirect(route('order.show', ['id' => $order->id]));

        $this->assertSame('Cancelado', $order->fresh()->getStatus());
        $this->assertSame(10, $product->fresh()->getStock());
    }

    public function test_an_order_with_a_payment_in_progress_cannot_be_cancelled(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $product = $this->product(stock: 10);
        $order = $this->placeOrder($user, $product, 2);

        $this->actingAs($user)->post('/payments/save', ['order_id' => $order->id, 'method' => 'PSE']);

        $this->actingAs($user)
            ->post('/orders/'.$order->id.'/cancel')
            ->assertSessionHas('error');

        $this->assertSame('Pendiente', $order->fresh()->getStatus());
        $this->assertSame(8, $product->fresh()->getStock());
    }

    public function test_an_order_can_be_paid_through_the_payment_flow(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);
        $product = $this->product(price: 80000);
        $order = $this->placeOrder($user, $product, 2);

        $this->actingAs($user)->get('/orders/'.$order->id)
            ->assertOk()
            ->assertSee('Pagar pedido');

        $this->actingAs($user)->get('/payments/create?order_id='.$order->id)
            ->assertOk()
            ->assertSee($order->code);

        $this->actingAs($user)->post('/payments/save', ['order_id' => $order->id, 'method' => 'PSE']);
        $payment = Payment::first();

        $this->assertEquals(160000, $payment->getAmount());

        $this->actingAs($admin)->patch('/admin/payments/'.$payment->id.'/status', ['status' => 'Completado']);

        $this->assertSame('Pagado', $order->fresh()->getStatus());

        $this->actingAs($user)->get('/orders/'.$order->id)
            ->assertOk()
            ->assertDontSee('Pagar pedido');
    }

    public function test_admin_sees_all_orders_and_can_cancel_a_pending_one(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $first = User::factory()->create(['role' => 'user']);
        $second = User::factory()->create(['role' => 'user']);
        $product = $this->product(stock: 10);

        $orderOne = $this->placeOrder($first, $product, 1);
        $orderTwo = $this->placeOrder($second, $product, 2);

        $this->actingAs($admin)->get('/admin/orders')
            ->assertOk()
            ->assertSee($orderOne->code)
            ->assertSee($orderTwo->code);

        $this->actingAs($admin)->get('/admin/orders/'.$orderTwo->id)
            ->assertOk()
            ->assertSee($product->title);

        $this->actingAs($admin)
            ->post('/admin/orders/'.$orderTwo->id.'/cancel')
            ->assertRedirect(route('admin.order.show', ['id' => $orderTwo->id]));

        $this->assertSame('Cancelado', $orderTwo->fresh()->getStatus());
        $this->assertSame(9, $product->fresh()->getStock());
    }

    public function test_regular_users_cannot_access_the_admin_order_panel(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)->get('/admin/orders')->assertForbidden();
    }

    public function test_deleting_a_product_keeps_the_order_history(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $product = $this->product();
        $order = $this->placeOrder($user, $product, 1);

        $product->delete();

        $this->actingAs($user)->get('/orders/'.$order->id)
            ->assertOk()
            ->assertSee('Producto eliminado');
    }
}
