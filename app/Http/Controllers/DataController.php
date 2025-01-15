<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building; 
use Illuminate\Http\JsonResponse; 

class DataController extends Controller
{
    // Return 3 builded buildings in random order 
    public function getTopBuildings(): JsonResponse 
    { 
        $buildings = Building::where('display', true) ->inRandomOrder() ->take(3) ->get(); 
        return response()->json($buildings); 
    } 
    
    // Return selected Building if it's builded 
    public function getBuilding(Building $building): JsonResponse 
    { 
        $selectedBuilding = Building::where([ 
            'id' => $building->id, 
            'display' => true, 
            ]) 
            ->firstOrFail(); 
        return response()->json($selectedBuilding); } 
        
    
    // Return 3 published Buildings in random order- except the selected building 
    public function getRelatedBuildings(Building $building): JsonResponse 
    { 
        $buildings = Building::where('display', true) 
        ->where('id', '<>', $building->id) 
        ->inRandomOrder() ->take(3) 
        ->get(); 
        
    return response()->json($buildings); } 
}
