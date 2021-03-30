<?php

namespace Tests\Feature;

use App\Models\PairingRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RetrievePairingRequestsTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_user_can_retrieve_pairing_requests()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($user = User::factory()->create(), 'api');

        $pairingRequests = PairingRequest::factory(3)->create();


        $response = $this->get('/api/pairingRequest/');

        // dd(json_decode($response->content()));

        $response->assertStatus(200)
        ->assertJson([
            'data' => [
                ['data' => [
                    'type' => 'pairing_request',
                    'attributes' => [
                        'pairing_request_id' => $pairingRequests->first()->id,
                        'title' => $pairingRequests->first()->title,
                        'user_id' => $pairingRequests->first()->user->id,
                        ]
                ]],
                ['data' => [
                    'type' => 'pairing_request',
                    'attributes' => [
                        'pairing_request_id' => $pairingRequests->skip(1)->first()->id,
                        'title' => $pairingRequests->skip(1)->first()->title,
                        'user_id' => $pairingRequests->skip(1)->first()->user->id,
                    ]
                ]],
                ['data' => [
                    'type' => 'pairing_request',
                    'attributes' => [
                        'pairing_request_id' => $pairingRequests->last()->id,
                        'title' => $pairingRequests->last()->title,
                        'user_id' => $pairingRequests->last()->user->id,
                    ]
                ]]
            ],
            'links' => [
                'self' => url('pairingRequests')
            ]
        ]);
    }
}
