<?php

namespace App\Http\Controllers\ApiControllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\QrCodeModel;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Controller;

class ApiQrCodeController extends Controller
{
   public function apiShowQrCode($userId){
       
        $orderId = DB::table('student_reservation')
        ->where('user_id', $userId)
        ->orderBy('id', 'desc')
        ->value('order_id');

        $data = DB::table('student_reservation')
        ->where('user_id', $userId)
        ->get();

        $getOrderId  = DB::table('student_reservation')
        ->where('order_id', $orderId)
        
        ->get();

        $qrCodePath = DB::table('qr_code')
        ->where('order_id', $orderId)
        ->get();

        return response()->json([
         'data' => $data,
         'getOrderId' => $getOrderId,
         'qrCodePath' => $qrCodePath
        ]);
   }
   public function apiShowQrCodebyID($userId, $id)
   {

      $orderId = DB::table('student_reservation')
      ->where('user_id', $userId)
         ->where('qrcode_id', $id)
         ->orderBy('id', 'desc')
         ->value('order_id');

      $data = DB::table('student_reservation')
      ->where('user_id', $userId)
         ->where('qrcode_id', $id)
         ->get();

      $getOrderId  = DB::table('student_reservation')
      ->where('order_id', $orderId)
         ->where('user_id', $userId)
         ->where('qrcode_id', $id)
         ->get();

      $qrCodePath = DB::table('qr_code')
      ->where('id', $id)
      ->get();

      return response()->json([
        'data' => $data,
        'getOrderId' => $getOrderId,
        'qrCodePath' => $qrCodePath,
      ]);
   }

   public function apiShow(Request $request){

   }
}
