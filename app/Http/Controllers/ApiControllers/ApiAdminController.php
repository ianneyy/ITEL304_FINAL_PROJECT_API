<?php

namespace App\Http\Controllers\ApiControllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReplyToMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Events\Announcement;
use App\Http\Controllers\Controller;

class ApiAdminController extends Controller
{

    public function apiAdminDashoard(Request $request)
    {
        Log::info('API endpoint was called.');
        // 1. Get the product variations and sizes for the lowest stock
        $data = Product::with('variations.sizes')->get();

        $lowestStock = null;
        $lowestStockVariation = null;
        $lowestStockSize = null;

        foreach ($data as $product) {
            foreach ($product->variations as $variation) {
                foreach ($variation->sizes as $size) {
                    // Check if the size stock is lower than the current lowest stock
                    if (is_null($lowestStock) || $size->stock < $lowestStock) {
                        $lowestStock = $size->stock;
                        $lowestStockVariation = $variation; // Save the variation with the lowest stock
                        $lowestStockSize = $size->size; // Save the size with the lowest stock
                    }
                }
            }
        }

        // 2. Get counts and data from 'student_reservation' table
        $counts = DB::table('student_reservation')
            ->selectRaw('
            COUNT(*) as dataCount,
            SUM(CASE WHEN status = "pending" THEN 1 ELSE 0 END) as pendingDataCount,
            SUM(CASE WHEN status = "completed" THEN 1 ELSE 0 END) as completedDataCount,
            SUM(CASE WHEN status = "pending" AND DATE(created_at) = CURDATE() THEN 1 ELSE 0 END) as pendingDataCountToday,
            SUM(CASE WHEN status = "completed" AND DATE(created_at) = CURDATE() THEN 1 ELSE 0 END) as completedDataCountToday
        ')
            ->first();

        // 3. Get recent reservations with status 'pending'
        $recentData = DB::table('student_reservation')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // 4. Get payments grouped by day of the week
        $paymentsByDay = DB::table('student_reservation')
            ->where('status', 'completed')
            ->select(DB::raw('DAYOFWEEK(reservation_date) as day_of_week'), DB::raw('SUM(total_price) as total_payment'))
            ->groupBy(DB::raw('DAYOFWEEK(reservation_date)'))
            ->orderBy(DB::raw('DAYOFWEEK(reservation_date)'))
            ->get();

        // 5. Get payments grouped by month
        $paymentsByMonth = DB::table('student_reservation')
            ->select(DB::raw('MONTH(reservation_date) as month'), DB::raw('SUM(total_price) as total_payment'))
            ->groupBy(DB::raw('MONTH(reservation_date)'))
            ->orderBy(DB::raw('MONTH(reservation_date)'))
            ->get();

        // 6. Get the start of the week (for additional processing if needed)
        $today = Carbon::today();
        $startOfWeek = $today->copy()->startOfWeek();

        // Return JSON response
        return response()->json([
            'recentData' => $recentData ?? null,
            'dataCount' => $counts->dataCount ?? null,
            'pendingDataCount' => $counts->pendingDataCount ?? null,
            'completedDataCount' => $counts->completedDataCount ?? null,
            'lowestStock' => $lowestStock ?? null,
            'lowestStockVariation' => $lowestStockVariation ?? null,
            'lowestStockSize' => $lowestStockSize ?? null,
            'paymentsByDay' => $paymentsByDay ?? null,
            'paymentsByMonth' => $paymentsByMonth ?? null,
            'today' => $today ?? null,
            'startOfWeek' => $startOfWeek ?? null,
            'pendingDataCountToday' => $counts->pendingDataCountToday ?? null,
            'completedDataCountToday' => $counts->completedDataCountToday ?? null,
        ]);
    }

    public function apiShowAdminAnnouncement()
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

        return response()->json(['data' => $data]);
    }

    public function apiShowAdminReservation()
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

        return response()->json([
            'data' => $data,
            'completedData' => $completedData,
            'cancelledData' => $cancelledData
        ]);
    }

    public function apiShowWishlist()
    {

        $data = DB::table('wishlist')
            ->get();

        return response()->json(['data' => $data]);
    }

    public function apiShowMessages()
    {
        $data = DB::table('contact_us')
            ->get();
        $data = $data->reverse();

        return response()->json(['data' => $data]);
    }

    public function apiPaidReservation($id)
    {
        $query = DB::table('student_reservation')->where('id', $id)->update([
            'status' => 'completed',
            'created_at' => now()->setTimezone('Asia/Manila')

        ]);

        if ($query) {
            return response()->json([
                'status' => 'success',
                'message' => 'Reservation updated successfully',
            ]);
        }
    }

    public function apiUpdateUniform(Request $request, $id)
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

        $name = $request->input('');

        // Redirect with success message
        return response()->json([
            'status' => 'success',
            'message' => "The $name has been updated successfully"
        ]);
    }

    public function apiPaidQrReservation($id)
    {
        $query = DB::table('student_reservation')->where('id', $id)->update([
            'status' => 'completed'
        ]);

        if ($query) {
            return response()->json(['success' => true]);
        }
    }

    public function apiAddAnnouncement(Request $request)
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
            return response()->json([
                'message' => 'New announcement has been added successfully'
            ]);
        }
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

    public function apiSendReply(Request $request, $id)
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
        return response()->json([
            'messsage' => 'The reply to the student messagee has been sent successfully'
        ]);
    }
}
