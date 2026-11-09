<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Utils\EnumLabel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Tests\TestCase;

class LocaleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_home_page_is_in_spanish_by_default(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Bienvenido a Gamesense');
    }

    public function test_a_visitor_can_switch_the_language_to_english(): void
    {
        $this->from('/')
            ->post(route('locale.update'), ['locale' => 'en'])
            ->assertRedirect('/')
            ->assertSessionHas('locale', 'en');

        $this->get('/')
            ->assertOk()
            ->assertSee('Welcome to GameSense')
            ->assertDontSee('Bienvenido a Gamesense');
    }

    public function test_the_chosen_language_can_be_changed_back_to_spanish(): void
    {
        $this->withSession(['locale' => 'en'])
            ->post(route('locale.update'), ['locale' => 'es'])
            ->assertSessionHas('locale', 'es');

        $this->get('/')->assertSee('Bienvenido a Gamesense');
    }

    public function test_an_unavailable_language_is_rejected(): void
    {
        $this->post(route('locale.update'), ['locale' => 'fr'])
            ->assertSessionHasErrors('locale');

        $this->assertNull(session('locale'));
    }

    public function test_values_stored_in_the_database_are_translated(): void
    {
        app()->setLocale('en');

        $this->assertSame('Paid', EnumLabel::for('models/Order.status', Order::STATUS_PAID));
        $this->assertSame('Something else', EnumLabel::for('models/Order.status', 'Something else'));

        app()->setLocale('es');

        $this->assertSame('Pagado', EnumLabel::for('models/Order.status', Order::STATUS_PAID));
    }

    public function test_every_spanish_translation_file_has_an_english_one_with_the_same_keys(): void
    {
        $spanish = glob(lang_path('es').'/{*,*/*,*/*/*}.php', GLOB_BRACE);

        foreach ($spanish as $file) {
            $english = str_replace(
                DIRECTORY_SEPARATOR.'es'.DIRECTORY_SEPARATOR,
                DIRECTORY_SEPARATOR.'en'.DIRECTORY_SEPARATOR,
                $file
            );

            $this->assertFileExists($english);
            $this->assertEqualsCanonicalizing(
                array_keys(Arr::dot(require $file)),
                array_keys(Arr::dot(require $english)),
                'Missing or extra keys in '.$english
            );
        }
    }
}
