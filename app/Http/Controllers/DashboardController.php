<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Facture;
use App\Models\Devis;

class DashboardController extends Controller
{
    public function index()
    {
        $latestClients = Client::latest()->take(4)->get();
        $latestFactures = Facture::orderBy('date', 'desc')->take(4)->get();
        $latestDevis = Devis::orderBy('date', 'desc')->take(4)->get();
        $totalClients = Client::count();
        // Example data to be passed to the view
        $chartData = [
            'series' => [
                ['name' => '2023', 'data' => [18, 7, 15, 11, 18, 12, 9, 5, 17, 15, 7, 10]],
                ['name' => '2022', 'data' => [-13, -10, -9, -14, -5, -12, -15, -5, -10, -8, -13, -12]],
            ],
        ];
        return view('dashboard', compact('latestClients', 'totalClients', 'latestFactures', 'latestDevis','chartData'));
    }
}
