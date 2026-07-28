<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CategoryApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_cannot_access_categories(): void
    {
        $response = $this->getJson('/api/categories');
        $response->assertStatus(401);
    }

    public function test_user_can_list_own_categories_only(): void
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        $catA = Category::factory()->create(['user_id' => $userA->id, 'nama' => 'Gaji A']);
        $catB = Category::factory()->create(['user_id' => $userB->id, 'nama' => 'Gaji B']);

        Sanctum::actingAs($userA);

        $response = $this->getJson('/api/categories');
        $response->assertStatus(200)
            ->assertJsonFragment(['nama' => 'Gaji A'])
            ->assertJsonMissing(['nama' => 'Gaji B']);
    }

    public function test_user_can_create_category(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $payload = [
            'nama'  => 'Makanan & Minuman',
            'jenis' => 'expense',
        ];

        $response = $this->postJson('/api/categories', $payload);
        $response->assertStatus(201)
            ->assertJsonFragment(['nama' => 'Makanan & Minuman']);

        $this->assertDatabaseHas('categories', [
            'user_id' => $user->id,
            'nama'    => 'Makanan & Minuman',
        ]);
    }

    public function test_user_cannot_access_other_users_category_detail(): void
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        $catB = Category::factory()->create(['user_id' => $userB->id]);

        Sanctum::actingAs($userA);

        $response = $this->getJson("/api/categories/{$catB->id}");
        $response->assertStatus(403);
    }

    public function test_user_cannot_update_or_delete_other_users_category(): void
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        $catB = Category::factory()->create(['user_id' => $userB->id]);

        Sanctum::actingAs($userA);

        $updateResponse = $this->putJson("/api/categories/{$catB->id}", ['nama' => 'Hacked']);
        $updateResponse->assertStatus(403);

        $deleteResponse = $this->deleteJson("/api/categories/{$catB->id}");
        $deleteResponse->assertStatus(403);
    }
}
