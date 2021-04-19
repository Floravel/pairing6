<?php

namespace App\Http\Controllers;

use App\Http\Resources\PairingRequestCollection;
use App\Http\Resources\PairingRequestResource;
use App\Models\PairingRequest;
use App\Models\TechnologyStack;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Util\Json;

class PairingRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return PairingRequestCollection
     */
    public function index()
    {
        return new PairingRequestCollection(request()->user()->pairingRequests);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PairingRequestResource
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
            'data.attributes.user_id' => 'required',
            'data.attributes.title' => 'required',
            'data.attributes.presentation' => 'required',
            'data.attributes.technology_stacks' => 'required',
            ]
        );

        $pairingRequest = $request->user()->pairingRequests()->create(
            [
            'user_id' => $data['data']['attributes']['user_id'],
            'title' => $data['data']['attributes']['title'],
            'presentation' => $data['data']['attributes']['presentation'],
            ]
        );

        $names = $data['data']['attributes']['technology_stacks'];

        foreach ($names as $name) {
            $stacks[] = $pairingRequest->technologyStacks()->firstOrcreate(
                [
                    'name' => $name,
                ]
            );
        }

        return new PairingRequestResource(
               $pairingRequest
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
