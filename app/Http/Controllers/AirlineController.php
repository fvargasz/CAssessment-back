<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\JsonResponse;

class AirlineController extends Controller
{
    /**
     * Display a listing of all airlines.
     *
     * @return JsonResponse
     */
    public function getALl()
    {
        $airlines = Airline::all();
        return response()->json(([
            'message' => 'Success',
            'airlines' => $airlines
        ]));
    }
}