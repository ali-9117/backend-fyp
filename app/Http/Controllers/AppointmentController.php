<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\Exception;

class AppointmentController extends Controller
{
    public  function store(Request $request)

        {
        $validated =    $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'nullable|string|min:0',
                'email' => 'nullable|string|email|max:255',
                'car_model' => 'nullable|string|max:255',
                'car_year' => 'nullable|string|max:255',
                'date' => 'nullable|date',
                'time' => 'nullable|date_format:H:i',
                'service_type' => 'nullable|string|max:255',
                'price' => 'nullable|integer',
                'service_package' => 'nullable|string',
            ]);

    $appointment = new Appointment([
        'user_id' => $request->user_id,
        'name' => $validated['name'],
        'phone' => $validated['phone'],
        'email' =>$request->email,
        'car_model' => $request->car_model,
        'car_year' => $request->car_year,
        'appointment_data' => $request->appointment_data,
        'appointment_time' => $request->appointment_time,
        'service_type' => $request->service_type,
        'price' => $request->price,
        'service_package' => $request->service_package,
    ]);


    $appointment->save();

            return response()->json(['message' => 'appointment booked successfully', 'appointment' => $appointment ],201);
        }

     public function GetAppointment($id)
     {
         try {

             $user = User::findOrFail($id);

             $appointments = $user->appointments;
             return response()->json(['appointments' => $appointments], 200);
         } catch (ModelNotFoundException  $e) {
             return response()->json(['message' => 'User not found'], 404);
         }


     }

     public function DeleteAppointment($id){


         $appointment = Appointment::findOrFail($id);
         $appointment->delete();
         return response()->json(['message' => 'Appointment deleted successfully'], 200);

     }

     public function UpdateAppointment(Request $request, $id)
     {

         $appointment = Appointment::findOrFail($id);


         $appointment->update([
             'name' => $request->name,
             'phone' => $request->phone,
             'email' => $request->email,
             'car_model' => $request->car_model,
             'car_year' => $request->car_year,
             'appointment_data' => $request->appointment_data,
             'appointment_time' => $request->appointment_time,
             'service_type' => $request->service_type,
             'service_package' => $request->service_package,
             'price' => $request->price,
         ]);


         return response()->json(['message' => 'Appointment updated successfully', 'appointment' => $appointment]);

     }
public function show(){

    try{

        $appointment = Appointment::all();



        return response()->json(['appointment' => $appointment], 200);
    }catch (\Exception $e){
        return response()->json(['message' => 'No appointment found'], 404);
    }



}


public function Updateprogress(Request $request, $id)
{


    $appointment = Appointment::findorFail($id);

    $appointment->update([
        'inspection'=>$request->has('inspection')? $request->inspection : false,
        'wash' => $request->has('wash')? $request->wash : false,
        'detailing'=>$request->has('detailing')? $request->detailing : false,
        'final_touches'=>$request->has('final_touches')? $request->final_touches : false,
        'completion'=>$request->has('completion')? $request->completion : false,
    ]);

    return response()->json(['message' => 'Appointment Progress updated successfully', 'appointment' => $appointment]);



}

}
