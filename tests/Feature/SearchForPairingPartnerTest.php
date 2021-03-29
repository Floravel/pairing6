<?php

namespace Tests\Feature;

use App\Models\PairingRequest;
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

        $this->actingAs($user = User::factory(5)->create()->first(), 'api');

        $response = $this->post('api/pairingRequest', [
            'data' => [
                'type' => 'pairing_request',
                'attributes' => [
                    'user_id' => $user->id,
                    'title' => 'testtitle',
                    'presentation' => 'The presentation for my cool pairing request',
                    'technology_stacks' => ['PHP', 'Html', 'JavaScript'],
                ]
            ]
        ]);

        $pairingRequest = PairingRequest::all()->first();


        $this->assertCount(1, PairingRequest::all());
        $this->assertEquals($user->id, $pairingRequest->user_id);
        $this->assertEquals('The presentation for my cool pairing request', $pairingRequest->presentation);


        $techStacks = [];
        foreach ($pairingRequest->technologyStacks as $technologyStack) {
            $techStacks[] = $technologyStack['name'];
        }


        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'type' => 'pairing_request',
                    'attributes' => [
                        'user_id' => $pairingRequest->user->id,
                        'title' => $pairingRequest->title,
                        'presentation' => $pairingRequest->presentation,
                        'technology_stacks' => $techStacks,
                    ]
                ],
                'links' => [
                    'self' => url('/pairingRequests/' . $pairingRequest->id)
                ]
            ]);
    }
}