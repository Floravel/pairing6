<?php

namespace Tests\Feature;

use App\Models\PairingRequest;
use App\Models\TechnologyStack;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PairingRequestTechnologyStackTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_example()
    {
        $user = User::factory()->create();
        $technologyStack1 = TechnologyStack::factory(1)->create();
        $technologyStack2 = TechnologyStack::factory()->create(['name' => 'Html']);
        $technologyStack3 = TechnologyStack::factory()->create(['name' => 'JavaScript']);

        $pairingRequests = PairingRequest::factory(3)->create();


        $pairingRequests->skip(1)->first()->technologyStacks()->attach($technologyStack2);

        $technologyStack3->pairingRequests()->attach($pairingRequests->skip(2)->first());


        $this->assertEquals('Html', $pairingRequests->skip(1)->first()->technologyStacks->first()->name);
        $this->assertEquals(3, $technologyStack3->pairingRequests()->first()->id);

        $this->assertTrue(true);
    }
}
