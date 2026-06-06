<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
    public function index(): JsonResponse
    {
        $cities = City::select('id', 'name', 'name_en', 'lat', 'lng', 'country', 'country_code', 'population')
            ->orderBy('population', 'desc')
            ->get();

        return response()->json($cities);
    }
}
