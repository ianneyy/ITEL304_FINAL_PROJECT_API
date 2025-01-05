<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Http\Request;

class MyReservationController extends Controller
{
    public function showMyReservation(){
        $userId = Auth::guard('student')->id();

        
        $orderId = DB::table('student_reservation')
        ->where('user_id', $userId)
        ->value('order_id');

        $getOrderId  = DB::table('student_reservation')
        ->where('order_id', $orderId)
        ->where('status', 'pending') // Filter by order_id
        ->get();


        $data = DB::table('student_reservation')
        ->where('user_id', $userId)
            ->where('status', 'pending')
            ->get();
        $data = $data->reverse();
        $pastData = DB::table('student_reservation')
        ->where('user_id', $userId)
        ->where('status', 'completed')
        ->get();

       
        $pastData = $pastData->reverse();
        return view('pages.reservation', compact('data', 'pastData'));
        
        // requesting info in the api
        // $response = Http::get('http://127.0.0.1:8000/api/requestStudentReservation/' . $userId);   
            
        // $data_recieved = $response->json();

        // return view('pages.reservation', compact('data_recieved'));
    }
}
