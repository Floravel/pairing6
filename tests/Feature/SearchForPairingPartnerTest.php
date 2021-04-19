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
    public function string_test()
    {
        $response = $this->get('/aaa');

        echo"fefef";

        $response->assertStatus(200);
    }

    /** @test */
    public function a_user_can_post_a_pairing_request()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($user = User::factory(5)->create()->first(), 'api');

        $response = $this->post('api/pairingRequest', [
            'data' => [
                'type' => 'pairing_request',
                'attributes' => [
                    'title' => 'testtitle',
                    'user_id' => $user->id,
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
                        'pairing_request_id' => $pairingRequest->id,
                        'user_id' => $pairingRequest->user->id,
                        'title' => $pairingRequest->title,
                        'presentation' => $pairingRequest->presentation,
                        'used_technology_stack' => [
                            'data' => [
                                ['data' => [
                                    'attributes' => [
                                        'name' => $techStacks[0]
                                    ]
                                ]],
                                ['data' => [
                                    'attributes' => [
                                        'name' => $techStacks[1]
                                    ]
                                ]],
                                ['data' => [
                                    'attributes' => [
                                        'name' => $techStacks[2]
                                    ]
                                ]]
                            ]
                        ],
                    ]
                ],
                'links' => [
                    'self' => url('/pairingRequests/' . $pairingRequest->id)
                ]
            ]);

    }
}
