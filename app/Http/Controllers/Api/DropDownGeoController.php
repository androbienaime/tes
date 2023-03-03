<?php

namespace App\Http\Controllers\Api;

use AndroLT\Countrypkg\Models\City;
use AndroLT\Countrypkg\Models\State;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DropDownGeoController extends Controller
{
    public function fetchcity(Request $request){
        $data['cities'] = City::where('state_id', $request->state_id)->get(['name', 'id']);

        return response()->json($data);
    }

    public function fetchstate(Request $request){
        $data['states'] = State::where('country_id', $request->country_id)->get(['name', 'id']);

        return response()->json($data);
    }
}
