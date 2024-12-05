<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Uniforms;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Log;

class WishlistController extends Controller
{
    public function deleteWishlist($id)
    {

        DB::table('user_wishlist')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
