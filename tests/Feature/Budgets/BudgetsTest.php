<?php

namespace Tests\Feature\Budgets;

use App\Models\Budget;
use App\Models\Item;
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

    public function test_budget_owner_can_add_items()
    {
        $user = User::factory()->create();
        $budget = Budget::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);
        $response = $this->post(route('budgets.items.add', ['budget' => $budget->getKey()]), [
            'name' => 'New Item',
            'amount' => 100,
        ]);

        $response->assertRedirect(route('budgets.show', ['budget' => $budget->getKey()]));
        $this->assertDatabaseHas('items', [
            'name' => 'New Item',
            'amount' => 100,
            'budget_id' => $budget->getKey(),
        ]);
    }

    public function test_different_user_cannot_add_items()
    {
        $user = User::factory()->create();
        $budget = Budget::factory()->create();

        $this->actingAs($user);
        $response = $this->post(route('budgets.items.add', ['budget' => $budget->getKey()]), [
            'name' => 'New Item',
            'amount' => 100,
        ]);

        $response->assertForbidden();
    }

    public function test_budget_owner_can_remove_items()
    {
        $user = User::factory()->create();
        $budget = Budget::factory()->create(['user_id' => $user->id]);
        $item = Item::factory()->create(['budget_id' => $budget->id]);

        $this->actingAs($user);
        $response = $this->delete(route('budgets.items.remove', ['budget' => $budget->getKey(), 'item' => $item->getKey()]));

        $response->assertRedirect(route('budgets.show', ['budget' => $budget->getKey()]));
        $this->assertDatabaseMissing('items', [
            'id' => $item->id,
        ]);
    }

    public function test_different_user_cannot_remove_items()
    {
        $user = User::factory()->create();
        $budget = Budget::factory()->create();
        $item = Item::factory()->create(['budget_id' => $budget->id]);

        $this->actingAs($user);
        $response = $this->delete(route('budgets.items.remove', ['budget' => $budget->getKey(), 'item' => $item->getKey()]));

        $response->assertForbidden();
        $this->assertDatabaseHas('items', [
            'id' => $item->id,
        ]);
    }

    public function test_budget_owner_can_toggle_item_completion()
    {
        $user = User::factory()->create();
        $budget = Budget::factory()->create(['user_id' => $user->id]);
        $item = Item::factory()->create(['budget_id' => $budget->id, 'completed' => false]);

        $this->actingAs($user);
        $response = $this->patch(route('budgets.items.toggle-completion', ['budget' => $budget->getKey(), 'item' => $item->getKey()]));

        $response->assertRedirect(route('budgets.show', ['budget' => $budget->getKey()]));
        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'completed' => true,
        ]);
    }

    public function test_different_user_cannot_toggle_item_completion()
    {
        $user = User::factory()->create();
        $budget = Budget::factory()->create();
        $item = Item::factory()->create(['budget_id' => $budget->id, 'completed' => false]);

        $this->actingAs($user);
        $response = $this->patch(route('budgets.items.toggle-completion', ['budget' => $budget->getKey(), 'item' => $item->getKey()]));

        $response->assertForbidden();
        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'completed' => false,
        ]);
    }
}
