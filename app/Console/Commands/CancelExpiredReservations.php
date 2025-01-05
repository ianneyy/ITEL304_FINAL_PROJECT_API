<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Log;
class CancelExpiredReservations extends Command
{
   
    protected $signature = 'reservations:reschedule-expired';

   
    protected $description = 'Reschedule reservations where the reservation date has passed';


       public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        // Get today's date
        $today = Carbon::today()->toDateString();

        // Find reservations that have passed the current date and are still "pending"
        $expiredReservations = DB::table('student_reservation')
            ->where('reservation_date', '<', $today)
            ->where('status', 'pending')
            ->get();

        foreach ($expiredReservations as $reservation) {
            // Logic to find the next available date (this can be custom depending on your needs)
            $nextAvailableDate = $this->findNextAvailableDate($reservation);

            // Update the reservation with the next available date
            DB::table('student_reservation')
                ->where('id', $reservation->id)
                ->update(['reservation_date' => $nextAvailableDate]);

            $this->info("Reservation {$reservation->id} rescheduled to $nextAvailableDate.");
        }
        Log::info("Change Date");
        
    }
     protected function findNextAvailableDate($reservation)
    {
        // Example logic: find the next day (you can customize this)
        $nextDate = Carbon::parse($reservation->reservation_date)->addDay();
        if ($nextDate->isSaturday()) {
            $nextDate->addDays(2); // Move to Monday
        } elseif ($nextDate->isSunday()) {
            $nextDate->addDay(); // Move to Monday
        }
        // Optionally, check if the next date is available (not already taken)
        while (DB::table('student_reservation')
                ->where('reservation_date', $nextDate->toDateString())
                ->exists()) {
            // If the date is already taken, move to the next day
            $nextDate->addDay();
             if ($nextDate->isSaturday()) {
                $nextDate->addDays(2); // Move to Monday
            } elseif ($nextDate->isSunday()) {
                $nextDate->addDay(); // Move to Monday
            }
        }

        return $nextDate->toDateString();
    }
}
