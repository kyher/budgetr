<?php

namespace Tests\Feature\Budgets;

use App\Models\Budget;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BudgetsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_the_login_page()
    {
        $budget = Budget::factory()->create();
        $response = $this->get(route('budgets.show', ['budget' => $budget->getKey()]));
        $response->assertRedirect(route('login'));
    }

    public function test_budget_owner_can_view_their_budget()
    {
        $user = User::factory()->create();
        $budget = Budget::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);
        $response = $this->get(route('budgets.show', ['budget' => $budget->getKey()]));
        $response->assertOk();
    }

    public function test_different_user_cannot_view_budget()
    {
        $budget = Budget::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user);
        $response = $this->get(route('budgets.show', ['budget' => $budget->getKey()]));
        $response->assertForbidden();
    }
}
