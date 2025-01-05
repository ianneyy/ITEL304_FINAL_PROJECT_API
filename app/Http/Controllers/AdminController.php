<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiControllers\ApiAdminController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReplyToMessage;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Events\Announcement;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{

    public function __construct(private ApiAdminController $apiAdmin) {}

    public function showDashboard(Request $request)
    {
        $response = $this->apiAdmin->apiAdminDashoard($request);

        $data = $response->getData(true);

        return view('admin.dashboard', compact('data'));
    }

    public function showAdminAnnouncement()
    {
        $data = DB::table('announcement')->get();

        $data = $data->reverse();
        // Format the announcement_date for each entry
        $data = $data->map(function ($announcement) {
            $carbonDate = Carbon::parse($announcement->announcement_date);

            // Format date and time separately
            if ($carbonDate->isToday()) {
                $announcement->formatted_date = 'Today';
                $announcement->formatted_time = $carbonDate->format('g:i A');
            } elseif ($carbonDate->isYesterday()) {
                $announcement->formatted_date = 'Yesterday';
                $announcement->formatted_time = $carbonDate->format('g:i A');
            } else {
                $announcement->formatted_date = $carbonDate->format('l, F j, Y');
                $announcement->formatted_time = $carbonDate->format('g:i A');
            }

            return $announcement;
        });

        return view('admin.admin_announcement', compact('data'));


        // requesting info in the api
        // $response = Http::get('http://127.0.0.1:8000/api/requestAdminAnnouncement');   

        // $data_recieved = $response->json();

        // return view('admin.admin_announcement', compact('data_recieved'));
    }

    public function showAdminReservation()
    {


        $data = DB::table('student_reservation')
            ->where('status', 'pending')
            ->get();

        $completedData = DB::table('student_reservation')
            ->where('status', 'completed')
            ->get();
        $cancelledData = DB::table('student_reservation')
            ->where('status', 'cancelled')
            ->get();

        return view('admin.admin_reservation', compact('data', 'completedData', 'cancelledData'));


        // requesting info in the api
        // $response = Http::get('http://127.0.0.1:8000/api/requestAdminReservation');   

        // $data_recieved = $response->json();

        // return view('admin.admin_reservation', compact('data_recieved'));

    }

    public function showWishlist()
    {
        $data = DB::table('wishlist')
            ->get();

        return view('admin.wishlist', compact('data'));

        // requesting info in the api
        // $response = Http::get('http://127.0.0.1:8000/api/requestAdminReservation');   

        // $data_recieved = $response->json();

        // return view('admin.wishlist', compact('data_recieved'));
    }

    public function showQrScanner()
    {
        return view('admin.qrscanner');
    }

    public function paidReservation($id)
    {
        $query = DB::table('student_reservation')->where('id', $id)->update([
            'status' => 'completed',
            'created_at' => now()->setTimezone('Asia/Manila')

        ]);

        if ($query) {
            return redirect('/admin-reservation');
        }


        // requesting info in the api
        // $response = Http::get('http://127.0.0.1:8000/api/requestAdminPaidReservation/' . $id);   

        // $data_recieved = $response->json();

        // return redirect('/admin-reservation');
    }

    public function updateUniform(Request $request, $id)
    {
        Log::info($request->all());

        // Validate the input data



        $uniform = Product::findOrFail($id);
        $newStock = $request->input('stocks');
        $previousStock = $uniform->stock;

        if ($previousStock == 0 && $newStock > 0) {
            $wishlists = DB::table('user_wishlist')
                ->where('name', $uniform->name)
                ->where('notified', false)
                ->get();
            foreach ($wishlists as $wishlist) {

                $user = DB::table('students')->where('id', $wishlist->user_id)->first();

                Mail::raw(
                    "The item {$uniform->name} is back in stock! Visit: " . route('pages.view-details', $uniform->id),
                    function ($message) use ($user) {
                        $message->to($user->email)->subject('Product Restocked');
                    }
                );
                DB::table('user_wishlist')->where('id', $wishlist->id)->update([
                    'notified' => true,
                    'updated_at' => now(),
                ]);
            }
        }

        // Handle image upload if present
        $imagePath = null;
        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $filename = $file->getClientOriginalName();
            $path = 'img/';
            $file->move($path, $filename);

            $imagePath = $path . $filename;
        } else {
            // If no new image is uploaded, retain the old image from the hidden input
            $imagePath = $request->input('old_image_url'); // Use the old image URL
        }
        Log::info($imagePath);

        DB::table('products')
            ->where('id', $id)
            ->update([
                'image_url' => $imagePath,
                'name' => $request->input('product_name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'stock' => $request->input('stocks'),

            ]);
        // Update the main product details
        $uniform->update([
            'name' => $request->product_name,
            'price' => $request->price,
            'image_url' => $imagePath,
            'stock' => $request->stocks,
            'description' => $request->description,
        ]);
        $uniform->save();
        $variations = $request->input('variations', []);

        // Log the variations for debugging


        // Loop through each variation and update
        foreach ($variations as $variation) {
            // Check if variation has an ID for update or insert
            if (isset($variation['id']) && $variation['id']) {
                // Update the existing variation
                DB::table('product_variations')
                    ->where('id', $variation['id'])
                    ->update([
                        'variation_type' => $variation['variation-type'] ?? 'N/A',
                        'updated_at' => now(),
                    ]);

                // Update sizes for the existing variation
                if (isset($variation['sizes']) && is_array($variation['sizes'])) {
                    foreach ($variation['sizes'] as $size) {
                        // Ensure 'size' and 'stock' keys exist and are valid
                        if (isset($size['id']) && $size['id']) {
                            // Update the size record
                            DB::table('product_variation_sizes')
                                ->where('id', $size['id'])
                                ->update([
                                    'size' => $size['size'],
                                    'stock' => $size['stock'],
                                    'updated_at' => now(),
                                ]);
                        } else {
                            // Insert a new size record if no ID is provided
                            DB::table('product_variation_sizes')->insert([
                                'product_variation_id' => $variation['id'],
                                'size' => $size['size'],
                                'stock' => $size['stock'],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } else {
                // Insert a new variation
                $productVariationId = DB::table('product_variations')->insertGetId([
                    'product_id' => $id,
                    'variation_type' => $variation['variation-type'] ?? 'N/A',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Insert sizes for the new variation
                if (isset($variation['sizes']) && is_array($variation['sizes'])) {
                    foreach ($variation['sizes'] as $size) {
                        // Ensure 'size' and 'stock' are valid before inserting
                        if (isset($size['size']) && isset($size['stock'])) {
                            DB::table('product_variation_sizes')->insert([
                                'product_variation_id' => $productVariationId,
                                'size' => $size['size'],
                                'stock' => $size['stock'],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            }
        }


        // Redirect with success message
        return  redirect()->route('inventory')->with('success', 'Uniform updated successfully.');



        // requesting info in the api
        // $response = Http::get('http://127.0.0.1:8000/api/requestUpdateUniform/' . $id);   

        // $data_recieved = $response->json();

        // return  redirect()->route('inventory')->with('success', 'Uniform updated successfully.');
    }

    public function addAnnouncement(Request $request)
    {
        Log::info('validating');
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        $announcementDate = now()->setTimezone('Asia/Manila');
        $query = DB::table('announcement')
            ->insert([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'announcement_date' => $announcementDate,
                'created_at' => now()->setTimezone('Asia/Manila'),
                'updated_at' => now()->setTimezone('Asia/Manila'),

            ]);
        event(new Announcement($query));
        if ($query) {
            return redirect()->back()->with('success', 'Announcement added successfully!');
        };

        // requesting info in the api
        // $response = Http::get('http://127.0.0.1:8000/api/requestAdminAddAnnouncement');   

        // $data_recieved = $response->json();

        // return redirect()->back()->with('success', 'Announcement added successfully!');
    }

    public function paidQrReservation($id)
    {
        $query = DB::table('student_reservation')->where('id', $id)->update([
            'status' => 'completed'
        ]);
        return response()->json(['success' => true]);

        // requesting info in the api
        // $response = Http::get('http://127.0.0.1:8000/api/requestAdminQrPay/' . $id);   

        // return $data_recieved = $response->json();
    }

    public function getReservationDetails(Request $request)
    {
        $qrCodeData = $request->query('qrCodeData');
        $orderId = basename(parse_url($qrCodeData, PHP_URL_PATH)); // Extract order ID from QR code data

        $reservations = DB::table('student_reservation')
            ->where('order_id', $orderId)
            ->where('status', 'pending')
            ->get();

        if ($reservations->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No reservations found.']);
        }
        $totalAmount = $reservations->sum('subTotal');
        return response()->json([
            'success' => true,
            'reservations' => $reservations,
            'totalAmount' => $totalAmount,
        ]);
    }
    public function showMessages()
    {
        $data = DB::table('contact_us')
            ->get();
        $data = $data->reverse();

        return view('admin.messages', compact('data'));

        // requesting info in the api
        // $response = Http::get('http://127.0.0.1:8000/api/requestAdminMessages');   

        // $data_recieved = $response->json();

        // return view('admin.messages', compact('data_recieved'));
    }

    public function sendReply(Request $request, $id)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'message' => 'required|string',
        ]);
        $messageId = $request->input('message_id');

        $email = DB::table('contact_us')
            ->where('id', $messageId)
            ->value('email');

        // $replyMessage = DB::table('contact_us')
        // ->where('id', $messageId)
        //     ->value('reply');
        $senderName = DB::table('contact_us')
            ->where('id', $messageId)
            ->value('name');
        $userMessage = DB::table('contact_us')
            ->where('id', $messageId)
            ->value('message');

        $reply = $request->input('message');
        $reply = "LSPU BAO Replied: " . $reply;
        DB::table('contact_us')
            ->where('id', $messageId)
            ->update([
                'reply' => $reply
            ]);
        // $email = $request->input('email');
        $replyMessage = $request->input('message');
        // $senderName = $request->input('name');




        // Send the reply email
        Mail::to($email)->send(new ReplyToMessage($replyMessage, $senderName, $email, $userMessage));


        // Optionally, return a success response
        return back()->with('success', 'Reply sent successfully!');

        // requesting info in the api
        // $response = Http::get('http://127.0.0.1:8000/api/requestAdminReply/' . $id);   

        // $data_recieved = $response->json();

        // return back()->with('success', 'Reply sent successfully!');
    }
}
