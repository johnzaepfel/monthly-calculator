<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_access_purchases(): void
    {
        $this->get('/purchases')->assertRedirect('/login');
    }

    public function test_monthly_report_only_includes_the_signed_in_users_purchases(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $category = Category::create(['name' => 'Groceries', 'order' => 1, 'budget_total' => 500]);
        foreach ([[$user, '2026-10-10', 'Visible purchase'], [$other, '2026-10-10', 'Other user purchase'], [$user, '2026-09-10', 'Previous month purchase']] as [$owner, $date, $store]) {
            Purchase::create(['user_id' => $owner->id, 'category_id' => $category->id, 'purchase_date' => $date, 'store_name' => $store, 'amount' => 25]);
        }

        $this->actingAs($user)->get('/purchases?selected_year=2026&selected_month=10')
            ->assertOk()
            ->assertSee('Visible purchase')
            ->assertDontSee('Other user purchase')
            ->assertDontSee('Previous month purchase');
    }

    public function test_purchase_owner_is_set_by_the_server(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $category = Category::create(['name' => 'Groceries', 'order' => 1, 'budget_total' => 500]);

        $this->actingAs($user)->post('/purchases', [
            'user_id' => $other->id,
            'category_id' => $category->id,
            'purchase_date' => '2026-10-10',
            'store_name' => 'Test store',
            'amount' => 25,
        ])->assertRedirect('/purchases')->assertSessionHasNoErrors();

        $this->assertDatabaseHas('purchases', ['store_name' => 'Test store', 'user_id' => $user->id]);
    }

    public function test_users_cannot_modify_another_users_purchase(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $category = Category::create(['name' => 'Groceries', 'order' => 1, 'budget_total' => 500]);
        $purchase = Purchase::create(['user_id' => $owner->id, 'category_id' => $category->id, 'purchase_date' => '2026-10-10', 'store_name' => 'Test store', 'amount' => 25]);

        $this->actingAs($other)->get('/purchases/'.$purchase->id.'/edit')->assertForbidden();
        $this->put('/purchases/'.$purchase->id, [
            'category_id' => $category->id,
            'purchase_date' => '2026-10-10',
            'store_name' => 'Changed store',
            'amount' => 50,
        ])->assertForbidden();
        $this->delete('/purchases/'.$purchase->id)->assertForbidden();
        $this->assertDatabaseHas('purchases', ['id' => $purchase->id, 'store_name' => 'Test store', 'amount' => 25]);
    }
}
