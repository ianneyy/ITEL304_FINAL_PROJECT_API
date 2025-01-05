<?php

namespace App\Http\Controllers\ApiControllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ApiMyReservationController extends Controller
{
    public function apiShowMyReservation($userId){
        
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

        return response()->json([
          'data' => $data,
          'pastData' => $pastData
        ]);
    }
}
