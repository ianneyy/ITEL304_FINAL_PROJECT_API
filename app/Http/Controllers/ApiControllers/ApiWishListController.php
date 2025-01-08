<?php

namespace App\Http\Controllers\ApiControllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ApiWishlistController extends Controller
{
  public function apiDeleteWishlist($id)
  {

    DB::table('user_wishlist')->where('id', $id)->delete();

    return response()->json([
      'status' => 'success',
      'message' => 'Deleted Successfully'
    ]);
  }
}
