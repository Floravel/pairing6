<?php

namespace Tests\Feature;

use App\Models\PairingRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use phpseclib3\File\ASN1\Maps\Attributes;
use Tests\TestCase;

class UserCanViewProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_user_profiles()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = User::factory()->create(), 'api');

        $pairingRequests = PairingRequest::factory()->create(['user_id' => $user->id]);

        $response = $this->get('/api/pairingRequest');

        $response = $this->get('/api/users/'.$user->id);

        $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'type' => 'users',
                'user_id' => $user->id,
                'attributes' => [
                    'name' => $user->name,
                ]
            ],
            'links' => [
                'self' => url('/users/'.$user->id)
            ]
        ]);
    }

    /** @test */
    public function a_user_can_fetch_post_for_a_profile()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = User::factory()->create(), 'api');
        $pairingRequest = PairingRequest::factory()->create([
                'user_id' => $user->id
            ]
        );

        $response = $this->get('/api/users/'. $user->id.'/pairingRequests');

        // dd(json_decode($response->content()));

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'data' => [
                            'type' => 'pairing_request',
                            'attributes' => [
                                'pairing_request_id' => $pairingRequest->id,
                                'title' => $pairingRequest->title,
                                'user_id' => $pairingRequest->user_id,
                                'requested_by' => [
                                    'data' => [
                                        'type' => 'users',
                                        'user_id' => $user->id,
                                        'attributes' => [
                                            'name' => $user->name,
                                            'email' => $user->email,
                                            'varified_at' => $user->varified_at
                                        ]
                                    ]
                                ],
                                'requested_at' => $pairingRequest->created_at->DiffForHumans(),
                                'presentation' => $pairingRequest->presentation,
                                'image' => $pairingRequest->image,
                                'used_technology_stack' => [
                                    'data' => [

                                    ],
                                    'links' => [
                                        'self' => url('/technologyStack'),
                                    ]
                                ]
                            ],
                        ]
                    ],
                ],
                'links' => [
                    'self' => url('/pairingRequests'),
                ]
            ]);
    }
}
