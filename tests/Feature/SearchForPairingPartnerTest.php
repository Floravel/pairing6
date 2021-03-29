<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchForPairingPartnerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_post_a_pairing_request()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($user = User::factory()->create()->first(), 'api');

        $response = $this->post('api/pairingRequest', [
        'data' => [
        'type' => 'pairing_request',
        'attributes' => [
            'user_id' => $user->id,
            'title' => 'testtitle',
            'presentation' => 'Testing Body',
            'technology_stack' => ['PHP', 'Html', 'JavaScript'],
            ]
        ]
        ]);
        dd($response);

        $response->assertStatus(201);

    }
}
