<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class ChirpTest extends TestCase
{
    use RefreshDatabase;

    public function test_chirp_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/chirps');

        $response
            ->assertOk()
            ->assertSee('Chirps')
            ->assertStatus(200);
    }

    public function test_chirp_can_be_created(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $component = Volt::test('components.chirps.create')
            ->set('message', 'Hello, world!')
            ->call('store');

        $component
            ->assertHasNoErrors()
            ->assertNoRedirect();

        $this->assertDatabaseHas('chirps', [
            'user_id' => $user->id,
            'message' => 'Hello, world!',
        ]);
    }

    public function test_chirp_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $chirp = $user->chirps()->create(['message' => 'Hello, world!']);

        $this->actingAs($user);

        $component = Volt::test('components.chirps.list')
            ->call('delete', $chirp);

        $component
            ->assertHasNoErrors()
            ->assertNoRedirect();

        $this->assertDatabaseMissing('chirps', [
            'id' => $chirp->id,
        ]);
    }

    public function test_chirp_can_be_updated(): void
    {
        $user = User::factory()->create();
        $chirp = $user->chirps()->create(['message' => 'Hello, world!']);

        $this->actingAs($user);

        $component = Volt::test('components.chirps.edit', [
            'chirp' => $chirp,
        ])
            ->set('message', 'Updated message')
            ->call('update');

        $component
            ->assertHasNoErrors()
            ->assertNoRedirect();

        $this->assertDatabaseHas('chirps', [
            'id' => $chirp->id,
            'message' => 'Updated message',
        ]);
    }
}
