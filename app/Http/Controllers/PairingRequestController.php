<?php

namespace App\Http\Controllers;

use App\Models\PairingRequest;
use App\Models\TechnologyStack;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PairingRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //    dd($request);
        $data = $request->validate([
            'data.attributes.user_id' => 'required',
            'data.attributes.title' => 'required',
            'data.attributes.presentation' => 'required',
            'data.attributes.technology_stacks' => 'required',
        ]);

/*        dd($request->user());*/

        $pairingRequest = $request->user()->pairingRequests()->create([
            'user_id' => $data['data']['attributes']['user_id'],
            'title' => $data['data']['attributes']['title'],
            'presentation' => $data['data']['attributes']['presentation'],
            ]);

    //    dd($data['data']['attributes']['technology_stack']);

        $names = $data['data']['attributes']['technology_stacks'];

        // $stacks = [];

       // $pairing->technologyStacks()->attach($names);


        foreach ($names as $name) {
            $stacks[] = $pairingRequest->technologyStacks()->firstOrcreate(
                [
                    'name' => $name,
                ]
            );
        }

        $pairingRequest = PairingRequest::all()->first();

        return response(
            [
                'data' => array_merge(['type' => 'pairing_request'] , $data['data']),
                'links' => ['self' => url('/pairingRequests/'.$pairingRequest->id)]
            ], 201);
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
