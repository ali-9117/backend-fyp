<?php

namespace App\Http\Controllers;


use App\Models\Contactus;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public  function store(Request $request)

    {

        $ContactUS = new Contactus([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' =>$request->email,
            'message' => $request->message,
        ]);


        $ContactUS->save();

        return response()->json(['message' => 'contactus  form submitted successfully', 'appointment' => $ContactUS ],201);
    }

    public function show()
    {
        try {

            $contact = Contactus::all();
            return response()->json(['contact' => $contact], 200);
        } catch (ModelNotFoundException  $e) {
            return response()->json(['message' => 'nothing to show'], 404);
        }


    }

}
