<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NavbarTest extends TestCase
{
    use RefreshDatabase;

    // ──────────────────────────────────────────────
    // Navbar Consistency: Profile page uses same navbar as Home
    // ──────────────────────────────────────────────

    public function test_profile_page_has_same_navbar_branding_as_home(): void
    {
        $user = User::factory()->create(['usertype' => 'customer']);

        $response = $this->actingAs($user)->get('/profile');

        $response->assertOk();
        // The navbar-guest component has ITB.SpeedShop branding
        $response->assertSee('ITB');
        $response->assertSee('SpeedShop');
    }

    public function test_profile_page_navbar_has_home_link(): void
    {
        $user = User::factory()->create(['usertype' => 'customer']);

        $response = $this->actingAs($user)->get('/profile');

        $response->assertOk();
        $response->assertSee('Home');
    }

    public function test_profile_page_navbar_has_categories_link(): void
    {
        $user = User::factory()->create(['usertype' => 'customer']);

        $response = $this->actingAs($user)->get('/profile');

        $response->assertOk();
        $response->assertSee('Categories');
    }

    public function test_profile_page_navbar_has_workshop_link(): void
    {
        $user = User::factory()->create(['usertype' => 'customer']);

        $response = $this->actingAs($user)->get('/profile');

        $response->assertOk();
        $response->assertSee('Workshop');
    }

    public function test_profile_page_navbar_has_contact_link(): void
    {
        $user = User::factory()->create(['usertype' => 'customer']);

        $response = $this->actingAs($user)->get('/profile');

        $response->assertOk();
        $response->assertSee('Contact Us');
    }

    public function test_dashboard_page_has_same_navbar_branding_as_home(): void
    {
        $user = User::factory()->create(['usertype' => 'customer']);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertOk();
        $response->assertSee('ITB');
        $response->assertSee('SpeedShop');
    }

    // ──────────────────────────────────────────────
    // Profile Dropdown: Authenticated user sees dropdown menu
    // ──────────────────────────────────────────────

    public function test_authenticated_user_sees_profile_dropdown_trigger_on_profile_page(): void
    {
        $user = User::factory()->create(['usertype' => 'customer']);

        $response = $this->actingAs($user)->get('/profile');

        $response->assertOk();
        // The dropdown trigger should contain the user icon with x-data (Alpine.js dropdown)
        $response->assertSee('x-data', false);
        $response->assertSee('profile-dropdown', false);
    }

    public function test_authenticated_user_dropdown_has_view_profile_link(): void
    {
        $user = User::factory()->create(['usertype' => 'customer']);

        $response = $this->actingAs($user)->get('/profile');

        $response->assertOk();
        $response->assertSee('View Profile');
    }

    public function test_authenticated_user_dropdown_has_dashboard_link(): void
    {
        $user = User::factory()->create(['usertype' => 'customer']);

        $response = $this->actingAs($user)->get('/profile');

        $response->assertOk();
        $response->assertSee('Dashboard');
    }

    public function test_authenticated_user_dropdown_has_logout_option(): void
    {
        $user = User::factory()->create(['usertype' => 'customer']);

        $response = $this->actingAs($user)->get('/profile');

        $response->assertOk();
        $response->assertSee('Log Out');
    }

    public function test_authenticated_user_dropdown_shows_user_name(): void
    {
        $user = User::factory()->create([
            'usertype' => 'customer',
            'name' => 'John Doe',
        ]);

        $response = $this->actingAs($user)->get('/profile');

        $response->assertOk();
        $response->assertSee('John Doe');
    }

    // ──────────────────────────────────────────────
    // Guest behavior: no dropdown, user icon links to login
    // ──────────────────────────────────────────────

    public function test_guest_sees_user_icon_linking_to_login_on_home(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('login', false);
    }

    public function test_guest_does_not_see_profile_dropdown_on_home(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertDontSee('View Profile');
        $response->assertDontSee('Log Out');
    }

    // ──────────────────────────────────────────────
    // Authenticated navbar on home page too
    // ──────────────────────────────────────────────

    public function test_authenticated_user_sees_dropdown_on_home_page(): void
    {
        $user = User::factory()->create(['usertype' => 'customer']);

        $response = $this->actingAs($user)->get('/');

        $response->assertOk();
        $response->assertSee('View Profile');
        $response->assertSee('Log Out');
    }

    public function test_authenticated_user_home_page_dropdown_shows_name(): void
    {
        $user = User::factory()->create([
            'usertype' => 'customer',
            'name' => 'Jane Smith',
        ]);

        $response = $this->actingAs($user)->get('/');

        $response->assertOk();
        $response->assertSee('Jane Smith');
    }

    // ──────────────────────────────────────────────
    // Cart icon remains visible
    // ──────────────────────────────────────────────

    public function test_profile_page_navbar_has_cart_icon(): void
    {
        $user = User::factory()->create(['usertype' => 'customer']);

        $response = $this->actingAs($user)->get('/profile');

        $response->assertOk();
        // The cart link should be present
        $response->assertSee('cart', false);
    }

    // ──────────────────────────────────────────────
    // Admin user type also works
    // ──────────────────────────────────────────────

    public function test_admin_user_sees_dropdown_on_profile_page(): void
    {
        $user = User::factory()->create(['usertype' => 'admin']);

        $response = $this->actingAs($user)->get('/profile');

        $response->assertOk();
        $response->assertSee('View Profile');
        $response->assertSee('Log Out');
    }
}
