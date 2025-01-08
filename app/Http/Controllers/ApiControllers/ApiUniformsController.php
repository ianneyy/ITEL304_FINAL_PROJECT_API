<?php

namespace App\Http\Controllers\ApiControllers;

use App\Models\Uniforms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Error;

class ApiUniformsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \App\Http\Requests\StoreUniformsRequest  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(StoreUniformsRequest $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Uniforms  $uniforms
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Uniforms $uniforms)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \App\Http\Requests\UpdateUniformsRequest  $request
    //  * @param  \App\Models\Uniforms  $uniforms
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(UpdateUniformsRequest $request, Uniforms $uniforms)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Uniforms  $uniforms
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Uniforms $uniforms)
    // {
    //     //
    // }

    public function apiShowUniforms()
    {
        $data = DB::table('products')->get();
        return response()->json(['data' => $data]);
    }

    public function apiShowUniformTable()
    {

        $data = Product::with('variations.sizes')->get();

        return response()->json(['data' => $data]);
    }

    public function showAddForm()
    {
        return view('pages.add_uniforms');
    }

    // gotta fix this
    public function apiAddUniform(Request $request)
    {
        // Insert product
        $productId = DB::table('products')->insertGetId([
            'image_url' => $request->input('image_url'),
            'name' => $request->input('product_name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stocks'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $variations = $request->input('variations', []);

        Log::info($request->input('image_url'));
        Log::info($request->file('variations'));
        // Insert each variation with sizes
        foreach ($variations as $index => $variation) {

            $imageFilePath = $request->input('imagePath');

            if ($request->hasFile('variations.' . $index . '.sub_image_url')) {
                $subfile = $request->file('variations.' . $index . '.sub_image_url');

                if ($subfile->isValid()) {
                    $subfilename = time() . '_' . $subfile->getClientOriginalName();
                    $filepath = 'img/';

                    $subfile->move(public_path($filepath), $subfilename);
                    $imageFilePath = $filepath . $subfilename;
                } else {
                    Log::warning('Invalid file uploaded for variation ' . $index);
                }
            }

            $productVariationId = DB::table('product_variations')->insertGetId([
                'product_id' => $productId,
                'variation_type' => $variation['variation-type'] ?? 'N/A',
                'sub_image_url' => $imageFilePath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);



            foreach ($variation['sizes'] as $key => $size) {

                DB::table('product_variation_sizes')->insert([
                    'product_variation_id' => $productVariationId,
                    'size' => $size ?? 'N/A',
                    'stock' => $variation['stock'][$key] ?? null, // Now the stock is guaranteed to be an integer
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function apiShowEditForm($id)
    {
        $data = Product::findOrFail($id);

        return response()->json(['data' => $data]);
    }

    public function apiDeleteUniforms($productId, $sizeId)
    {
        // $imagePath = Uniforms::where('id', $id)->pluck('image_url')->first();
        // File::delete($imagePath);

        DB::table('product_variation_sizes')->where('id', $sizeId)->delete();

        // Optionally, delete the image if no variations or sizes are left for the product
        $remainingSizes = DB::table('product_variation_sizes')->where('product_variation_id', $productId)->count();
        if ($remainingSizes == 0) {
            // $imagePath = DB::table('products')->where('id', $productId)->pluck('image_url')->first();
            // if ($imagePath && file_exists(public_path($imagePath))) {
            //     File::delete(public_path($imagePath));
            // }
            // You may want to delete the entire product if no sizes remain
            DB::table('products')->where('id', $productId)->delete();
        }




        return response()->json([
            'message' => 'Available uniform has been deleted successfully',
        ]);
    }

    public function deleteProduct($productId)
    {
        $imagePath = Uniforms::where('id', $productId)->pluck('image_url')->first();
        File::delete($imagePath);

        DB::table('products')->where('id', $productId)->delete();

        // Optionally, delete the image if no variations or sizes are left for the product

        return response()->json([
            'status' => 'success',
            'message' => 'The product has been deleted successfully'
        ]);
    }

    public function apiShowDetails($id)
    {
        $data = DB::table('products')
            ->where('id', $id)
            ->get();

        $deptData = DB::table('product_variations')
            ->where('product_id', $id)
            ->get();
        $variationIds = $deptData->pluck('id');
        $sizeData = DB::table('product_variation_sizes')
            ->whereIn('product_variation_id', $variationIds) // Match against variation IDs
            ->get();  // Get both 'id' and 'size'

        $sizeData = $sizeData->unique('size');

        return response()->json([
            'data' => $data,
            'deptData' => $deptData,
            'sizeData' => $sizeData
        ]);
    }
    public function apiShowAnnouncement()
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

        return response()->json([
            'data' => $data
        ]);
    }
    public function apiShowMessageForm($userId)
    {
        $student = DB::table('students')
            ->where('id', $userId) // Match the ID with the authenticated user's ID
            ->get();

        return response()->json([
            'student' => $student
        ]);
    }
    public function apiAddMessage(Request $request)
    {

        Log::info('Incoming request to addMessage', $request->all());

        // Validate input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);
        $query = DB::table('contact_us')->insert([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($query) {
            return response()->json([
                'messsage' => 'The message has been sent successfully'
            ]);
        } else {
            Log::error('engk');
        }
    }
    public function apiCancelReservation($id)
    {
        DB::table('student_reservation')
            ->where('id', $id)
            ->update(['status' => 'cancelled']);

        return response()->json([
            'message' => 'The Item reservation has been cancel'
        ]);
    }
}
