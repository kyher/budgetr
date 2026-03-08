<?php

namespace Tests\Feature\Items;

use App\Models\Budget;
use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BudgetItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_budget_owner_can_add_items()
    {
        $user = User::factory()->create();
        $budget = Budget::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);
        $itemName = fake()->lexify('?????');
        $response = $this->post(route('budgets.items.add', ['budget' => $budget->getKey()]), [
            'name' => $itemName,
            'amount' => 100,
        ]);

        $response->assertRedirect(route('budgets.show', ['budget' => $budget->getKey()]));
        $this->assertDatabaseHas('items', [
            'name' => $itemName,
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
            'name' => fake()->lexify('?????'),
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
        Carbon::setTestNow();
        $user = User::factory()->create();
        $budget = Budget::factory()->create(['user_id' => $user->id]);
        $item = Item::factory()->create(['budget_id' => $budget->id, 'paid_at' => null]);

        $this->actingAs($user);
        $response = $this->patch(route('budgets.items.toggle-paid', ['budget' => $budget->getKey(), 'item' => $item->getKey()]));

        $response->assertRedirect(route('budgets.show', ['budget' => $budget->getKey()]));
        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'paid_at' => now(),
        ]);
    }

    public function test_different_user_cannot_toggle_item_completion()
    {
        $user = User::factory()->create();
        $budget = Budget::factory()->create();
        $item = Item::factory()->create(['budget_id' => $budget->id, 'paid_at' => null]);

        $this->actingAs($user);
        $response = $this->patch(route('budgets.items.toggle-paid', ['budget' => $budget->getKey(), 'item' => $item->getKey()]));

        $response->assertForbidden();
        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'paid_at' => null,
        ]);
    }

    public function test_a_user_can_edit_a_budget_item()
    {
        $user = User::factory()->create();
        $budget = Budget::factory()->create(['user_id' => $user->id]);
        $item = Item::factory()->create(['budget_id' => $budget->id]);

        $this->actingAs($user);
        $itemName = fake()->lexify('?????');
        $response = $this->patch(route('budgets.items.update', ['budget' => $budget->getKey(), 'item' => $item->getKey()]), [
            'name' => $itemName,
            'amount' => 150,
            'remaining' => 100,
        ]);

        $response->assertRedirect(route('budgets.show', ['budget' => $budget->getKey()]));
        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'name' => $itemName,
            'amount' => 150,
            'remaining' => 100,
        ]);
    }

    public function test_a_different_user_cannot_edit_a_budget_item()
    {
        $user = User::factory()->create();
        $budget = Budget::factory()->create();
        $item = Item::factory()->create(['budget_id' => $budget->id]);

        $this->actingAs($user);
        $itemName = fake()->lexify('?????');
        $response = $this->patch(route('budgets.items.update', ['budget' => $budget->getKey(), 'item' => $item->getKey()]), [
            'name' => $itemName,
            'amount' => 150,
            'remaining' => 100,
        ]);

        $response->assertForbidden();
        $this->assertDatabaseMissing('items', [
            'id' => $item->id,
            'name' => $itemName,
            'amount' => 150,
            'remaining' => 100,
        ]);
    }
}
