<?php

namespace App\Http\Controllers;

use App\Models\Uniforms;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Student;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductVariationSize;


class UniformsController extends Controller
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

    public function showUniforms(){
        $data = DB::table('products')->get();
        return view('pages.uniforms', compact('data'));

        // requesting info in the api
        // $response = Http::get('http://127.0.0.1:8000/api/requestLandingPage');   
         
        // $data_recieved = $response->json();

        // return view('pages.uniforms', compact('data_recieved'));
    }
    
    public function showUniformsTable(){
      
        $data = Product::with('variations.sizes')->get();
       
        return view('admin.inventory', compact('data'));

        // requesting info in the api
        // $response = Http::get('http://127.0.0.1:8000/api/requestAdminInventory');   
         
        // $data_recieved = $response->json();

        // return view('admin.inventory', compact('data_recieved'));
    }
    
    public function showAddForm(){
        return view('admin.add_uniforms');
    }

    public function addUniform(Request $request)
    {
        Log::info($request);
        $imagePath = null;
        if ($request->has('image_url')) {
            $file = $request->file('image_url');
            $filename = $file->getClientOriginalName();
            $path = 'img/';
            $file->move($path, $filename);
          
            $imagePath = $path . $filename;
        }

        // Insert product
        $productId = DB::table('products')->insertGetId([
            'image_url' => $imagePath,
            'name' => $request->input('product_name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stocks'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $variations = $request->input('variations', []);

        Log::info($variations);
        Log::info($request->file('variations'));
        // Insert each variation with sizes
        foreach ($variations as $index => $variation) {
       
             $imageFilePath = null;

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

        return redirect(url('/inventory'));

        // requesting info in the api
        // $response = Http::post('http://127.0.0.1:8000/api/requestAdminAddUniform');   
         
        // $data_recieved = $response->json();

        // return redirect(url('/inventory'));
    }

    
    public function showEditForm($id){
        $data = Product::findOrFail($id);
        
        return view('admin.edit_uniforms', compact('data'));

        // requesting info in the api
        // $response = Http::post('http://127.0.0.1:8000/api/requestEditAdminUniformForm/' . $id);   
         
        // $data_recieved = $response->json();

        // return view('admin.edit_uniforms', compact('data_recieved'));
    }

    public function deleteUniforms($productId, $sizeId){
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


       
        
            return redirect(url('/inventory'));

        // requesting info in the api
        // $response = Http::get('http://127.0.0.1:8000/api/requestAdminDeleteUniform/' . $productId . '/' . $sizeId');   
         
        // $data_recieved = $response->json();

        // return redirect(url('/inventory'));
    }

    public function cancelReservation($id){
        DB::table('student_reservation')
        ->where('id', $id)
        ->update(['status' => 'cancelled']);

        return redirect()->back()->with('success','Reservation cancelled successfully');
    
        // requesting info in the api
        // $response = Http::get('http://127.0.0.1:8000/api/requestAdminDeleteUniform/' . $productId . '/' . $sizeId');   
         
        // $data_recieved = $response->json();

        // return redirect()->back()->with('success','Reservation cancelled successfully');
   }

    public function deleteProduct($productId)
    {
        $imagePath = Uniforms::where('id', $productId)->pluck('image_url')->first();
        File::delete($imagePath);

        DB::table('products')->where('id', $productId)->delete();

        // Optionally, delete the image if no variations or sizes are left for the product




        return redirect(url('/inventory'));
    }

    public function showDetails($id){
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
        
        return view('pages.view_details', compact('data','deptData','sizeData'));

        
        // requesting info in the api
        // $response = Http::get('http://127.0.0.1:8000/api/requestStudentShowUniformDetails/' . $id);   
         
        // $data_recieved = $response->json();

        // return view('pages.view_details', compact('data_recieved'));
    
    }
    
    public function showAnnouncement()
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

        return view('pages.announcement', compact('data'));

        // requesting info in the api
        // $response = Http::get('http://127.0.0.1:8000/api/requestStudentAnnouncement');   
         
        // $data_recieved = $response->json();

        // return view('pages.announcement', compact('data_recieved'));
    }
    public function showMessageForm(){
        $userId = Auth::guard('student')->id();

        $student = DB::table('students')
        ->where('id', $userId) // Match the ID with the authenticated user's ID
        ->get();

        return view('pages.contact_us', compact('student'));

        // requesting info in the api
        // $response = Http::get('http://127.0.0.1:8000/api/requestStudentShowMessageForm/' . $userId);   
         
        // $data_recieved = $response->json();

        // return view('pages.contact_us', compact('student'));

    }
    public function addMessage(Request $request){

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

        if($query){

        
            return redirect()->back()->with('success', 'Message sent successfully!');
        }
        else
        {
            Log::error('engk');
        }
       
    }

}
