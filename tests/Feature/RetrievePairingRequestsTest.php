<?php

namespace Tests\Feature;

use App\Models\PairingRequest;
use App\Models\TechnologyStack;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use MongoDB\BSON\Javascript;
use Tests\TestCase;

class RetrievePairingRequestsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_retrieve_pairing_requests()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($user = User::factory()->create(), 'api');

        $pairingRequests = PairingRequest::factory(3)->create(['user_id' => $user->id]);



        $technologyStacks = ['PHP', 'JavaScript', 'Html5', 'Delphi', 'Vue'];

        $z = 5;
        for ($i=0; $i<=2; $i++) {
            $randomInt = random_int(0, $z);
            $k[$i] = $randomInt;
            $z -= $randomInt;
        }

        for ($i=1; $i <= $k[0]; $i++) {
            $pairingRequests->first()->TechnologyStacks()->create([
                'name' => $technologyStacks[$random_int = random_int(0, count($technologyStacks)-1)]
            ]);
            array_splice($technologyStacks, $random_int, 1);
        }

        for ($i=1; $i <= $k[1]; $i++) {
            $pairingRequests->skip(1)->first()->TechnologyStacks()->create([
                'name' => $technologyStacks[$random_int = random_int(0, count($technologyStacks) - 1)]
            ]);
            array_splice($technologyStacks, $random_int, 1);
        }

        for ($i=1; $i <= $k[2]; $i++) {
            $pairingRequests->last()->TechnologyStacks()->create([
                'name' => $technologyStacks[$random_int = random_int(0, count($technologyStacks)-1)]
            ]);
            array_splice($technologyStacks, $random_int, 1);
        }

        $response = $this->get('/api/pairingRequest/');

/*       dd(json_decode($response->content()));*/

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'data' => [
                            'type' => 'pairing_request',
                            'attributes' => [
                                'pairing_request_id' => $pairingRequests->first()->id,
                                'title' => $pairingRequests->first()->title,
                                'user_id' => $pairingRequests->first()->user->id,
                            ]
                        ]
                    ],
                    [
                        'data' => [
                            'type' => 'pairing_request',
                            'attributes' => [
                                'pairing_request_id' => $pairingRequests->skip(1)->first()->id,
                                'title' => $pairingRequests->skip(1)->first()->title,
                                'user_id' => $pairingRequests->skip(1)->first()->user->id,
                            ]
                        ]
                    ],
                    [
                        'data' => [
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

    /** @test */
    public function a_user_can_only_retrieve_their_pairing_requests()
    {
        $this->actingAs($user = User::factory()->create(), 'api');

        $pairingRequests = PairingRequest::factory()->create();

        $response = $this->get('/api/pairingRequest');

        $response->assertStatus(200)
            ->assertExactJson([
                'data' => [],
                'links' => [
                    'self' => url('/pairingRequests')
                ]
            ]);
    }
}
