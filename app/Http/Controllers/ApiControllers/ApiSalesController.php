<?php

namespace App\Http\Controllers\ApiControllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ApiSalesController extends Controller
{
  public function apiShowSales()
  {
    $today = Carbon::today();
    $formattedDate = $today->format('F j, Y');
    $yesterday = Carbon::yesterday();
    $formattedDateYesterday = $yesterday->format('F j, Y');

    $lastWeekStart = Carbon::now()->startOfWeek()->subWeek(); // Last week's Monday
    $lastWeekEnd = Carbon::now()->startOfWeek()->subWeek()->addDays(4);

    $lastWeekRange = $lastWeekStart->format('F j, Y') . ' - ' . $lastWeekEnd->format('F j, Y');

    $lastMonthStart = Carbon::now()->startOfMonth()->subMonth(); // Start of last month
    $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth(); // End of last month
    $lastMonthName = $lastMonthStart->format('F Y');

    $totalSales = DB::table('student_reservation')
      ->where('status', 'completed')
      ->sum('total_price');

    $totalSalesToday = DB::table('student_reservation')
      ->where('status', 'completed')
      ->where('reservation_date', $today)
      ->sum('total_price');

    $totalSalesYesterday = DB::table('student_reservation')
      ->where('status', 'completed')
      ->where('reservation_date', $yesterday)
      ->sum('total_price');


    $totalSalesLastWeek = DB::table('student_reservation')
      ->where('status', 'completed')
      ->whereBetween('reservation_date', [$lastWeekStart, $lastWeekEnd])
      ->sum('total_price');

    // Query for total sales last month
    $totalSalesLastMonth = DB::table('student_reservation')
      ->where('status', 'completed')
      ->whereBetween('reservation_date', [$lastMonthStart, $lastMonthEnd])
      ->sum('total_price');

    $pendingTotalSales = DB::table('student_reservation')
      ->where('status', 'pending')
      ->sum('total_price');

    $pendingTotalSalesToday = DB::table('student_reservation')
      ->where('status', 'pending')
      ->where('reservation_date', $today)
      ->sum('total_price');
    $pendingTotalSalesYesterday = DB::table('student_reservation')
      ->where('status', 'pending')
      ->where('reservation_date', $yesterday)
      ->sum('total_price');
    $pendingTotalSalesLastWeek = DB::table('student_reservation')
      ->where('status', 'pending')
      ->where('reservation_date', [$lastWeekStart, $lastWeekEnd])
      ->sum('total_price');
    $pendingTotalSalesLastMonth = DB::table('student_reservation')
      ->where('status', 'pending')
      ->where('reservation_date', [$lastMonthStart, $lastMonthEnd])
      ->sum('total_price');

    $totalSalesFormatted = number_format($totalSales, 2);
    $totalSalesTodayFormatted = number_format($totalSalesToday, 2);
    $totalSalesYesterdayFormatted = number_format($totalSalesYesterday, 2);
    $totalSalesLastWeekFormatted = number_format($totalSalesLastWeek, 2);
    $totalSalesLastMonthFormatted = number_format($totalSalesLastMonth, 2);



    $pendingTotalSalesFormatted = number_format($pendingTotalSales, 2);
    $pendingTotalSalesTodayFormatted = number_format($pendingTotalSalesToday, 2);
    $pendingTotalSalesYesterdayFormatted = number_format($pendingTotalSalesYesterday, 2);
    $pendingTotalSalesLastWeekFormatted = number_format($pendingTotalSalesLastWeek, 2);
    $pendingTotalSalesLastMonthFormatted = number_format($pendingTotalSalesLastMonth, 2);

    $sales = DB::table('student_reservation')
      ->select('name', 'size', 'department', DB::raw('SUM(total_price) as total_sales'), DB::raw('SUM(qty) as total_quantity'))
      ->where('status', 'completed')
      ->groupBy('name', 'size', 'department')
      ->get();
    $salesToday = DB::table('student_reservation')
      ->select('name', 'size', 'department', DB::raw('SUM(total_price) as total_sales'), DB::raw('SUM(qty) as total_quantity'))
      ->where('status', 'completed')
      ->where('reservation_date', $today)
      ->groupBy('name', 'size', 'department')
      ->get();

    $salesYesterday = DB::table('student_reservation')
      ->select('name', 'size', 'department', DB::raw('SUM(total_price) as total_sales'), DB::raw('SUM(qty) as total_quantity'))
      ->where('status', 'completed')
      ->where('reservation_date', $yesterday)
      ->groupBy('name', 'size', 'department')
      ->get();
    $salesLastWeek = DB::table('student_reservation')
      ->select('name', 'size', 'department', DB::raw('SUM(total_price) as total_sales'), DB::raw('SUM(qty) as total_quantity'))
      ->where('status', 'completed')
      ->where('reservation_date', [$lastWeekStart, $lastWeekEnd])
      ->groupBy('name', 'size', 'department')
      ->get();
    $salesLastMonth = DB::table('student_reservation')
      ->select('name', 'size', 'department', DB::raw('SUM(total_price) as total_sales'), DB::raw('SUM(qty) as total_quantity'))
      ->where('status', 'completed')
      ->where('reservation_date', [$lastMonthStart, $lastMonthEnd])
      ->groupBy('name', 'size', 'department')
      ->get();

    return response()->json([
      'sales' => $sales,
      'formattedDate' => $formattedDate,
      'totalSalesFormatted' => $totalSalesFormatted,
      'totalSalesTodayFormatted' => $totalSalesTodayFormatted,
      'pendingTotalSalesTodayFormatted' => $pendingTotalSalesTodayFormatted,
      'pendingTotalSalesFormatted' => $pendingTotalSalesFormatted,
      'salesToday' => $salesToday,
      'totalSalesYesterday' => $totalSalesYesterday,
      'totalSalesLastWeek' => $totalSalesLastWeek,
      'totalSalesLastMonth' => $totalSalesLastMonth,
      'formattedDateYesterday' => $formattedDateYesterday,
      'yesterday' => $yesterday,
      'lastWeekRange' => $lastWeekRange,
      'lastMonthName' => $lastMonthName,
      'salesYesterday' => $salesYesterday,
      'totalSalesYesterdayFormatted' => $totalSalesYesterdayFormatted,
      'totalSalesLastWeekFormatted' => $totalSalesLastWeekFormatted,
      'totalSalesLastMonthFormatted' => $totalSalesLastMonthFormatted,
      'pendingTotalSalesYesterdayFormatted' => $pendingTotalSalesYesterdayFormatted,
      'pendingTotalSalesLastWeekFormatted' => $pendingTotalSalesLastWeekFormatted,
      'pendingTotalSalesLastMonthFormatted' => $pendingTotalSalesLastMonthFormatted,
      'salesLastWeek' => $salesLastWeek,
      'salesLastMonth' => $salesLastMonth,
    ]);
  }
}
