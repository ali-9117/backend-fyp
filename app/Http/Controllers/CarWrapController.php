<?php

namespace App\Http\Controllers;

use App\Models\CarWrap;
use Illuminate\Http\Request;

class CarWrapController extends Controller
{
    public  function store(Request $request)

    {
        $validated =    $request->validate([
            'name' => 'required|string|max:255',
            'car_type' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
            'color_code' => 'nullable|string',
        ]);

        $carwrap = new CarWrap([
            'user_id' => $request->user_id,
            'name' => $validated['name'],
            'car_type' => $validated['car_type'],
            'image' => $request->image,
            'color_code' => $request->color_code,
        ]);


        $carwrap->save();

        return response()->json(['message' => 'carWrap booked successfully', 'Carwrap' => $carwrap ],201);
    }

    public function show(){

        try{

            $carwraps = CarWrap::with('user:id,email')->get();

            return response()->json(['carwrap' => $carwraps], 200);
        }catch (\Exception $e){
            return response()->json(['message' => 'No appointment found'], 404);
        }



    }
}
