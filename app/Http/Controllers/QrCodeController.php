<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\QrCodeModel;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class QrCodeController extends Controller
{
   public function showQrCode(){
        $userId = Auth::guard('student')->id();

       
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
        return view('pages.success', compact('data', 'getOrderId', 'qrCodePath'));

      // requesting info in the api
      // $response = Http::get('http://127.0.0.1:8000/api/requestStudentShowQr/' . $userId);   
        
      // $data_recieved = $response->json();

      // return view('pages.success', compact('data_recieved'));
   }
   public function showQrCodebyID($id)
   {
      $userId = Auth::guard('student')->id();


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
      return view('pages.success', compact('data', 'getOrderId', 'qrCodePath'));

      // requesting info in the api
      // $response = Http::get('http://127.0.0.1:8000/api/requestStudentViewQr/' . $userId . '/' . $id);   
        
      // $data_recieved = $response->json();

      // return view('pages.success', compact('data_recieved'));
   }
      public function show(Request $request){

      }
}
