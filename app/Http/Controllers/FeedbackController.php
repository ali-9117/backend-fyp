<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)

    {


        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'required|string',
        ]);

        Feedback::create($validatedData);

        return response()->json(['message' => 'Feedback submitted successfully']);
    }

    public function show(){

        try{

            $feedback= Feedback::all();

        return response()->json(['feedback' => $feedback], 200);
}catch (\Exception $e){
    return response()->json(['message' => 'No feedback found'], 404);
}


    }
}
