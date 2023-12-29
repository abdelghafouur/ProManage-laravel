<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Facture;
use App\Models\Devis;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function index()
    {
        $latestClients = Client::latest()->take(4)->get();
        $latestFactures = Facture::orderBy('date', 'desc')->take(4)->get();
        $latestDevis = Devis::orderBy('date', 'desc')->take(4)->get();
        $totalClients = Client::count();

            // Get the current year
        $currentYear = Carbon::now()->year;

        // Fetch the counts for each month in the current year
        $factureCounts = Facture::selectRaw('MONTH(date) as month, COUNT(*) as count')
            ->whereYear('date', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Fill in the counts for all months (0 if no records for a month)
        $factureCounts = array_replace(array_fill(1, 12, 0), $factureCounts);

        return view('dashboard', compact('latestClients', 'totalClients', 'latestFactures', 'latestDevis','factureCounts'));
    }
}
