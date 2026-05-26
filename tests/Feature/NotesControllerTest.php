<?php

namespace Tests\Feature;

use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_edit_and_update_their_note(): void
    {
        $user = User::factory()->create();
        $note = Note::create([
            'user_id' => $user->id,
            'title' => 'Original title',
            'content' => 'Original content',
            'color' => '#6366f1',
            'is_pinned' => false,
        ]);

        $this->actingAs($user)
            ->get(route('notes.edit', $note))
            ->assertStatus(200)
            ->assertSee('Original title')
            ->assertSee('Original content');

        $this->actingAs($user)
            ->post(route('notes.update', $note), [
                'title' => 'Updated title',
                'content' => 'Updated content',
                'color' => '#10b981',
            ])
            ->assertRedirect(route('notes.index'));

        $this->assertDatabaseHas('notes', [
            'id' => $note->id,
            'title' => 'Updated title',
            'content' => 'Updated content',
            'color' => '#10b981',
        ]);
    }

    public function test_authenticated_user_can_delete_and_toggle_pin_on_their_note(): void
    {
        $user = User::factory()->create();
        $note = Note::create([
            'user_id' => $user->id,
            'title' => 'Pin me',
            'content' => 'Pin content',
            'color' => '#f59e0b',
            'is_pinned' => false,
        ]);

        $this->actingAs($user)
            ->post(route('notes.toggle-pin', $note))
            ->assertRedirect(route('notes.index'));

        $this->assertDatabaseHas('notes', [
            'id' => $note->id,
            'is_pinned' => true,
        ]);

        $this->actingAs($user)
            ->post(route('notes.destroy', $note))
            ->assertRedirect(route('notes.index'));

        $this->assertDatabaseMissing('notes', [
            'id' => $note->id,
        ]);
    }
}
