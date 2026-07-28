<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TransactionApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_cannot_access_transactions(): void
    {
        $response = $this->getJson('/api/transactions');
        $response->assertStatus(401);
    }

    public function test_user_can_create_transaction_with_own_category(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['user_id' => $user->id]);

        Sanctum::actingAs($user);

        $payload = [
            'category_id' => $category->id,
            'judul'       => 'Makan Siang',
            'jumlah'      => 25000,
            'jenis'       => 'expense',
            'tanggal'     => now()->format('Y-m-d'),
            'keterangan'  => 'Nasi padang',
        ];

        $response = $this->postJson('/api/transactions', $payload);
        $response->assertStatus(201)
            ->assertJsonFragment(['judul' => 'Makan Siang']);

        $this->assertDatabaseHas('transactions', [
            'user_id'     => $user->id,
            'category_id' => $category->id,
            'judul'       => 'Makan Siang',
        ]);
    }

    public function test_user_cannot_create_transaction_with_other_users_category(): void
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        $categoryB = Category::factory()->create(['user_id' => $userB->id]);

        Sanctum::actingAs($userA);

        $payload = [
            'category_id' => $categoryB->id,
            'judul'       => 'Coba Pake Kategori User B',
            'jumlah'      => 50000,
            'jenis'       => 'expense',
            'tanggal'     => now()->format('Y-m-d'),
        ];

        $response = $this->postJson('/api/transactions', $payload);
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['category_id']);
    }

    public function test_user_cannot_view_update_or_delete_other_users_transaction(): void
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        $catA = Category::factory()->create(['user_id' => $userA->id]);
        $txB = Transaction::factory()->create(['user_id' => $userB->id]);

        Sanctum::actingAs($userA);

        $getResponse = $this->getJson("/api/transactions/{$txB->id}");
        $getResponse->assertStatus(403);

        $updateResponse = $this->putJson("/api/transactions/{$txB->id}", [
            'category_id' => $catA->id,
            'judul'       => 'Update Judul',
            'jumlah'      => 100000,
            'jenis'       => 'expense',
            'tanggal'     => now()->format('Y-m-d'),
        ]);
        $updateResponse->assertStatus(403);

        $deleteResponse = $this->deleteJson("/api/transactions/{$txB->id}");
        $deleteResponse->assertStatus(403);
    }

    public function test_transaction_index_returns_own_transactions_with_category(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['user_id' => $user->id, 'nama' => 'Gaji Utama']);
        $transaction = Transaction::factory()->create([
            'user_id'     => $user->id,
            'category_id' => $category->id,
            'judul'       => 'Gaji Bulanan',
        ]);

        Sanctum::actingAs($user);

        $response = $this->getJson('/api/transactions');
        $response->assertStatus(200)
            ->assertJsonFragment(['judul' => 'Gaji Bulanan'])
            ->assertJsonFragment(['nama' => 'Gaji Utama']);
    }
}
