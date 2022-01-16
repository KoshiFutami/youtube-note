<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Note;
use App\Models\User;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function 認証済ユーザーのみメモ作成ページにアクセス可能()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/notes/create');
        $response->assertOk();
    }

    /**
     * @test
     */
    public function 新しいメモを投稿可能()
    {
        $note = Note::factory()->create();

        $response = $this->get('/notes/' . $note->id);
        $response->assertStatus(200);
        $response->assertSee($note->title);
    }

    /**
     * @test
     */
    public function メモを編集可能()
    {
        $note = Note::factory()->create();
        $note->title = 'メモ編集のテスト';
        $note->save();
        $response = $this->get('/notes/' . $note->id);
        $response->assertSee('メモ編集のテスト');
    }

    /**
     * @test
     */
    public function メモを削除可能()
    {
        $note = Note::factory()->create();
        $note_id = $note->id;
        $note->delete();

        $response = $this->get('/notes/' . $note_id);
        $response->assertStatus(404);
    }
}
