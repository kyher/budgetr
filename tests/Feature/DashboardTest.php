<?php

namespace Tests\Feature;

use App\Models\Budget;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_the_login_page()
    {
        $response = $this->get(route('dashboard'));
        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_users_can_visit_the_dashboard()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('dashboard'));
        $response->assertOk();
    }

    public function test_budgets_show_on_dashboard()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $budgets = Budget::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->get(route('dashboard'));
        $response->assertOk();
        $response->assertSee($budgets[0]->name);
        $response->assertSee($budgets[1]->name);
        $response->assertSee($budgets[2]->name);
    }
}
