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

    private function checkoutData(array $overrides = []): array
    {
        return array_merge([
            'shipping_name' => 'Ana Torres',
            'shipping_phone' => '3001234567',
            'shipping_address' => 'Calle 10 # 5-20',
            'shipping_city' => 'Medellín',
            'method' => 'PSE',
        ], $overrides);
    }

    private function placeOrder(User $user, Product $product, int $quantity = 2): Order
    {
        $this->actingAs($user)->post('/cart/'.$product->id.'/add', ['quantity' => $quantity]);
        $this->actingAs($user)->post('/checkout/save', $this->checkoutData());

        return Order::where('user_id', $user->id)->latest('id')->firstOrFail();
    }

    public function test_guests_are_redirected_to_login(): void
    {
        $this->get('/cart')->assertRedirect('/login');
        $this->get('/checkout')->assertRedirect('/login');
        $this->post('/checkout/save')->assertRedirect('/login');
        $this->get('/orders')->assertRedirect('/login');
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
            ->assertSee($product->title)
            ->assertSee('Proceder al pago');
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

    public function test_checkout_page_shows_the_form_and_the_order_summary(): void
    {
        $user = User::factory()->create(['role' => 'user', 'address' => 'Carrera 7 # 1-1']);
        $product = $this->product(price: 90000);

        $this->actingAs($user)->post('/cart/'.$product->id.'/add', ['quantity' => 2]);

        $this->actingAs($user)->get('/checkout')
            ->assertOk()
            ->assertSee('Datos de envío')
            ->assertSee('Método de pago')
            ->assertSee($product->title)
            ->assertSee('180.000')
            ->assertSee('Carrera 7 # 1-1')
            ->assertSee('Pagar ahora');
    }

    public function test_checkout_with_an_empty_cart_goes_back_to_the_cart(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)->get('/checkout')->assertRedirect(route('cart.index'));
        $this->actingAs($user)->post('/checkout/save', $this->checkoutData())->assertSessionHasErrors('cart');

        $this->assertSame(0, Order::count());
    }

    public function test_checkout_creates_a_paid_order_and_the_payment_in_one_step(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $product = $this->product(price: 150000, stock: 10);

        $this->actingAs($user)->post('/cart/'.$product->id.'/add', ['quantity' => 2]);

        $response = $this->actingAs($user)->post('/checkout/save', $this->checkoutData(['total' => 1]));

        $order = Order::first();

        $response->assertRedirect(route('order.show', ['id' => $order->id]));
        $this->assertSame($user->id, $order->user_id);
        $this->assertSame('Pagado', $order->getStatus());
        $this->assertEquals(300000, $order->getTotal());
        $this->assertSame('Ana Torres', $order->getShippingName());
        $this->assertSame('3001234567', $order->getShippingPhone());
        $this->assertSame('Calle 10 # 5-20', $order->getShippingAddress());
        $this->assertSame('Medellín', $order->getShippingCity());

        $item = $order->items()->first();
        $this->assertSame(2, $item->getQuantity());
        $this->assertEquals(150000, $item->getUnitPrice());
        $this->assertEquals(300000, $item->getSubtotal());

        $payment = Payment::first();
        $this->assertSame($order->id, $payment->order_id);
        $this->assertSame($user->id, $payment->user_id);
        $this->assertSame('PSE', $payment->getMethod());
        $this->assertSame('Completado', $payment->getStatus());
        $this->assertEquals(300000, $payment->getAmount());

        $this->assertSame(8, $product->fresh()->getStock());
        $this->assertNull(session('cart'));
    }

    public function test_checkout_validates_the_delivery_data_and_the_payment_method(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $product = $this->product();

        $this->actingAs($user)->post('/cart/'.$product->id.'/add', ['quantity' => 1]);

        $this->actingAs($user)
            ->post('/checkout/save', $this->checkoutData([
                'shipping_name' => '',
                'shipping_phone' => 'abc',
                'shipping_address' => '',
                'shipping_city' => '',
                'method' => 'Bitcoin',
            ]))
            ->assertSessionHasErrors(['shipping_name', 'shipping_phone', 'shipping_address', 'shipping_city', 'method']);

        $this->assertSame(0, Order::count());
        $this->assertSame(0, Payment::count());
        $this->assertSame(10, $product->fresh()->getStock());
        $this->assertNotNull(session('cart'));
    }

    public function test_checkout_fails_when_the_stock_changed_after_adding_to_the_cart(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $product = $this->product(stock: 5);

        $this->actingAs($user)->post('/cart/'.$product->id.'/add', ['quantity' => 4]);
        $product->update(['stock' => 1]);

        $this->actingAs($user)->post('/checkout/save', $this->checkoutData())->assertSessionHasErrors();

        $this->assertSame(0, Order::count());
        $this->assertSame(0, Payment::count());
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

    public function test_order_detail_shows_the_delivery_data_and_the_payment(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $product = $this->product(price: 80000);
        $order = $this->placeOrder($user, $product, 2);

        $this->actingAs($user)->get('/orders/'.$order->id)
            ->assertOk()
            ->assertSee($order->code)
            ->assertSee('Pagado')
            ->assertSee('Ana Torres')
            ->assertSee('Calle 10 # 5-20')
            ->assertSee('PSE')
            ->assertSee('160.000')
            ->assertDontSee('Pagar pedido');
    }

    public function test_user_can_cancel_a_paid_order_and_the_payment_is_refunded(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $product = $this->product(stock: 10);
        $order = $this->placeOrder($user, $product, 3);

        $this->assertSame(7, $product->fresh()->getStock());

        $this->actingAs($user)
            ->post('/orders/'.$order->id.'/cancel')
            ->assertRedirect(route('order.show', ['id' => $order->id]));

        $this->assertSame('Cancelado', $order->fresh()->getStatus());
        $this->assertSame('Reembolsado', Payment::first()->getStatus());
        $this->assertSame(10, $product->fresh()->getStock());
    }

    public function test_a_cancelled_order_cannot_be_cancelled_again(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $product = $this->product(stock: 10);
        $order = $this->placeOrder($user, $product, 2);

        $this->actingAs($user)->post('/orders/'.$order->id.'/cancel');
        $this->actingAs($user)->post('/orders/'.$order->id.'/cancel')->assertSessionHas('error');

        $this->assertSame(10, $product->fresh()->getStock());
    }

    public function test_admin_sees_all_orders_and_can_cancel_one(): void
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
            ->assertSee($product->title)
            ->assertSee('Ana Torres');

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
