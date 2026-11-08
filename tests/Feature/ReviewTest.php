<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    private function product(string $title = 'Producto de prueba'): Product
    {
        $category = Category::create([
            'name' => 'Categoria '.uniqid(),
            'description' => 'Descripcion',
        ]);

        return Product::create([
            'title' => $title,
            'description' => 'Descripcion',
            'price' => 100000,
            'stock' => 10,
            'format' => 'Digital',
            'type' => 'Juego',
            'platform' => 'PC',
            'category_id' => $category->id,
        ]);
    }

    private function review(User $user, Product $product, int $rating = 4, string $comment = 'Muy buen juego'): Review
    {
        return Review::create([
            'rating' => $rating,
            'comment' => $comment,
            'date' => now()->toDateString(),
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
    }

    public function test_anyone_can_list_and_see_reviews(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $product = $this->product();
        $review = $this->review($user, $product, 5, 'Aventura increible');

        $this->get('/reviews')->assertOk()->assertSee('Aventura increible');
        $this->get('/reviews/'.$review->id)->assertOk()->assertSee('Aventura increible');
        $this->get('/reviews/999')->assertNotFound();
    }

    public function test_reviews_can_be_filtered_by_product(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $first = $this->product('Primero');
        $second = $this->product('Segundo');
        $this->review($user, $first, 5, 'Comentario del primero');
        $this->review($user, $second, 3, 'Comentario del segundo');

        $this->get('/reviews?product_id='.$second->id)
            ->assertOk()
            ->assertSee('Comentario del segundo')
            ->assertDontSee('Comentario del primero');

        $this->get('/reviews?product_id=999')->assertNotFound();
    }

    public function test_guests_cannot_create_or_delete_reviews(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $review = $this->review($user, $this->product());

        $this->get('/reviews/create')->assertRedirect('/login');
        $this->post('/reviews/save', [])->assertRedirect('/login');
        $this->delete('/reviews/'.$review->id)->assertRedirect('/login');

        $this->assertSame(1, Review::count());
    }

    public function test_user_can_write_a_review(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $product = $this->product();

        $this->actingAs($user)->get('/reviews/create?product_id='.$product->id)->assertOk();

        $this->actingAs($user)
            ->post('/reviews/save', ['rating' => 5, 'comment' => 'Excelente', 'product_id' => $product->id, 'user_id' => 999])
            ->assertRedirect(route('review.index', ['product_id' => $product->id]));

        $review = Review::first();
        $this->assertSame($user->id, $review->user_id);
        $this->assertSame(5, $review->getRating());
        $this->assertSame('Excelente', $review->getComment());
    }

    public function test_review_validation_rejects_invalid_input(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $product = $this->product();

        $this->actingAs($user)
            ->post('/reviews/save', ['rating' => 6, 'comment' => '', 'product_id' => 999])
            ->assertSessionHasErrors(['rating', 'comment', 'product_id']);

        $this->assertSame(0, Review::count());
    }

    public function test_only_the_author_can_delete_a_review_from_the_public_pages(): void
    {
        $author = User::factory()->create(['role' => 'user']);
        $other = User::factory()->create(['role' => 'user']);
        $review = $this->review($author, $this->product());

        $this->actingAs($other)->delete('/reviews/'.$review->id)->assertForbidden();
        $this->assertSame(1, Review::count());

        $this->actingAs($author)->delete('/reviews/'.$review->id)->assertRedirect();
        $this->assertSame(0, Review::count());
    }

    public function test_the_delete_button_is_only_shown_to_the_author(): void
    {
        $author = User::factory()->create(['role' => 'user']);
        $other = User::factory()->create(['role' => 'user']);
        $review = $this->review($author, $this->product());

        $this->actingAs($author)->get('/reviews/'.$review->id)->assertSee('Eliminar reseña');
        $this->actingAs($other)->get('/reviews/'.$review->id)->assertDontSee('Eliminar reseña');
    }

    public function test_the_product_page_shows_its_reviews_and_the_average(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $product = $this->product();
        $this->review($user, $product, 5, 'Comentario cinco');
        $this->review($user, $product, 3, 'Comentario tres');

        $this->get('/products/'.$product->id)
            ->assertOk()
            ->assertSee('Comentario cinco')
            ->assertSee('Comentario tres')
            ->assertSee('4.0/5');

        $empty = $this->product('Sin resenas');
        $this->get('/products/'.$empty->id)->assertOk()->assertSee('todavía no tiene reseñas');
    }

    public function test_the_menu_links_to_the_reviews(): void
    {
        $this->get('/products')->assertOk()->assertSee('Reseñas');
    }

    public function test_admin_moderates_reviews_from_the_admin_panel(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);
        $review = $this->review($user, $this->product(), 4, 'Comentario a moderar');

        $this->actingAs($admin)->get('/admin/reviews')
            ->assertOk()
            ->assertSee('Comentario a moderar');

        $this->actingAs($admin)->get('/admin/reviews?search=moderar')->assertOk()->assertSee('Comentario a moderar');
        $this->actingAs($admin)->get('/admin/reviews?search=zzz')->assertOk()->assertDontSee('Comentario a moderar');

        $this->actingAs($admin)
            ->delete('/admin/reviews/'.$review->id)
            ->assertRedirect(route('admin.review.index'));

        $this->assertSame(0, Review::count());
    }

    public function test_regular_users_cannot_access_the_admin_review_panel(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $review = $this->review($user, $this->product());

        $this->actingAs($user)->get('/admin/reviews')->assertForbidden();
        $this->actingAs($user)->delete('/admin/reviews/'.$review->id)->assertForbidden();
        $this->assertSame(1, Review::count());
    }

    public function test_deleting_a_product_removes_its_reviews(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $product = $this->product();
        $this->review($user, $product);

        $product->delete();

        $this->assertSame(0, Review::count());
    }
}
